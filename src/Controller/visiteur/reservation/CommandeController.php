<?php

namespace App\Controller\visiteur\reservation;

use App\Entity\Reservation;
use App\Entity\Colis;
use App\Entity\SuiviColis;
use App\Entity\TypeEmballage;
use App\Form\ReservationColisType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Mailer\ValidationMailer;

class CommandeController extends AbstractController
{
    private $entityManager;
    private $validationMailer;

    public function __construct(
        EntityManagerInterface $entityManager,
        ValidationMailer $validationMailer
    ) {
        $this->entityManager = $entityManager;
        $this->validationMailer = $validationMailer;
    }

    #[Route('/commande', name: 'envoie.commande')]
    #[IsGranted('ROLE_USER')]
    public function index(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationColisType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérez les données du formulaire
            $weight = $reservation->getWeight();

            // Calcul des frais de livraison pour la réservation
            $deliveryCost = $this->calculateDeliveryCost($reservation);

            // Génération du numéro de suivi unique
            $trackingNumber = $this->generateTrackingNumber();

            // Enregistrement de la réservation
            $reservation->setDeliveryCost($deliveryCost)
                ->setNumeroSuivi($trackingNumber)
                ->setReservationDate(new \DateTimeImmutable());
            $this->entityManager->persist($reservation);

            // Création et association d'un Colis pour chaque réservation
            $colis = new Colis();
            $colis->setReservation($reservation);
            $colis->setDeliveryCost($deliveryCost);
            $colis->setWeight($weight);
            $colis->setMoyenPaiement($reservation->getMoyenPaiement());
            $colis->setNumeroSuivi($trackingNumber);
            $this->entityManager->persist($colis);

            // Création d'une entrée de suivi pour chaque colis
            $suiviColis = new SuiviColis();
            $suiviColis->setStatut('Réservation effectuée')
                ->setDateHeureSuivi(new \DateTimeImmutable())
                ->setNumeroSuivi($trackingNumber)
                ->setColis($colis);
            $this->entityManager->persist($suiviColis);

            $this->entityManager->flush();

            // Envoi de l'e-mail de validation si un client est associé à la réservation
            
            $client = $reservation->getClient();
            if ($client !== null) {
                $this->validationMailer->sendValidationEmail($client->getEmail());
            }

            return $this->processPayment($reservation);
        }


        // Calculer les tarifs pour l'affichage
        $deliveryCost = null;
        if ($form->isSubmitted() && !$form->isValid()) {
            $deliveryCost = $this->calculateDeliveryCost($reservation);
        }

        return $this->render('pages/visiteur/commande/index.html.twig', [
            'form' => $form->createView(),
            'reservation' => $reservation,
            'deliveryCost' => $deliveryCost,
        ]);
    }
    

    #[Route('/confirmation', name: 'confirmation_payment')]
    public function confirmation(): Response
    {
        return $this->render('pages/visiteur/payment/confirmation_payment.html.twig');
    }

    #[Route('/confirmation-livraison', name: 'confirmation_livraison')]
    public function confirmationLivraison(): Response
    {
        return $this->render('pages/visiteur/payment/confirmation_livraison.html.twig');
    }

    private function calculateDeliveryCost(Reservation $reservation): float
    {
        // Définir le coût par kilogramme
        $costPerKilogram = 10; // 10 € par kilogramme
    
        // Récupérer le poids de la réservation
        $weight = $reservation->getWeight();
    
        // Calculer le coût total basé sur le poids
        $weightCost = $weight * $costPerKilogram;
    
        // Définir un coût fixe pour la livraison, indépendant du pays de destination
        $fixedDeliveryCost = 5; // 5 € pour chaque livraison
    
        // Retourner le coût total de la livraison
        // C'est la somme du coût basé sur le poids et du coût fixe de la livraison
        return $weightCost + $fixedDeliveryCost;
    }
    

    private function generateTrackingNumber(): string
    {
        // Utiliser la date et l'heure actuelles comme base
        $datePart = date('Ymd'); // Format: année, mois, jour
        $timePart = date('His'); // Format: heure, minute, seconde
    
        // Générer une partie aléatoire
        $randomPart = bin2hex(random_bytes(4)); // Génère une chaîne hexadécimale aléatoire
    
        // Ajouter un identifiant unique basé sur le micro-temps pour plus d'unicité
        $microTimePart = substr(md5(microtime()), 0, 5);
    
        // Combiner toutes les parties pour créer un numéro de suivi unique
        return $datePart . $timePart . $randomPart . $microTimePart;
    }
    

    private function createReservationEntity(Reservation $reservation, float $deliveryCost, string $trackingNumber): void
    {
        // Définit les coûts de livraison, le numéro de suivi et la date de réservation pour l'objet de réservation
        $reservation->setDeliveryCost($deliveryCost)
                    ->setNumeroSuivi($trackingNumber)
                    ->setReservationDate(new \DateTimeImmutable());
    
        // Associe chaque colis lié à la réservation
        foreach ($reservation->getColisRelation() as $colis) {
            $colis->setReservation($reservation); // Lien du colis à la réservation
            $this->entityManager->persist($colis); // Enregistrement du colis dans la base de données
        }
    
        // Persiste l'objet de réservation dans la base de données
        $this->entityManager->persist($reservation);
    
        // Applique les opérations de persistances en base de données
        $this->entityManager->flush();
    }
    

    private function createTrackingEntry(Reservation $reservation, string $statut): void
    {
        // Création d'une nouvelle instance de SuiviColis
        $suiviColis = new SuiviColis();
    
        // Configuration du statut, de la date et heure du suivi, et du numéro de suivi
        $suiviColis->setStatut($statut)
                   ->setDateHeureSuivi(new \DateTimeImmutable())
                   ->setNumeroSuivi($reservation->getNumeroSuivi());
    
        // Obtention du premier colis lié à la réservation (si existant)
        $colisPremier = $reservation->getColisRelation()->first();
    
        // Si un colis est associé, on le lie à l'entrée de suivi
        if ($colisPremier instanceof Colis) {
            $suiviColis->setColis($colisPremier);
        }
    
        // Enregistrement de l'entrée de suivi dans la base de données
        $this->entityManager->persist($suiviColis);
    
        // Applique les changements dans la base de données
        $this->entityManager->flush();
    }
    

    private function handleCashOnDelivery(Reservation $reservation): void
    {
        // Marquer la réservation comme payée à la livraison
        $reservation->setStatutPaiement('Payé à la livraison');
    
        // Enregistrer la modification dans la base de données
        $this->entityManager->persist($reservation);
        $this->entityManager->flush();
    }
    
    private function processPayment(Reservation $reservation): Response
    {
        // Obtention du moyen de paiement choisi pour la réservation
        $moyenPaiement = $reservation->getMoyenPaiement();
    
        // Traitement en fonction du moyen de paiement
        switch ($moyenPaiement) {
            case 'En ligne (PayPal)':
            case 'En ligne (Carte bancaire)':
                // Redirection vers la page de confirmation de paiement
                return $this->redirectToRoute('payer');
            case 'En espèces à la livraison':
                // Traitement pour le paiement à la livraison
                $this->handleCashOnDelivery($reservation);
                // Redirection vers une autre page de confirmation spécifique pour la livraison
                return $this->redirectToRoute('confirmation_livraison');
            default:
                // Gestion des cas où le moyen de paiement n'est pas pris en charge
                throw new \Exception("Méthode de paiement non prise en charge.");
        }
    }
    
}
