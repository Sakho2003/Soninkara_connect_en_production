<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        // Indique à EasyAdmin l'entité à gérer
        return Reservation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // Configure les champs à afficher dans l'interface CRUD
        return [
            IdField::new('id')->hideOnForm(), // L'ID est caché dans le formulaire
            TextField::new('nom', 'Nom du client'),
            TextField::new('prenom', 'Prénom du client'),
            TextField::new('numero', 'Numéro de téléphone'),
            TextField::new('adresse', 'Adresse du client'),
            TextField::new('pays', 'Pays du client'),
            // Champs pour les informations du destinataire
            TextField::new('nomDest', 'Nom du destinataire'),
            TextField::new('prenomDest', 'Prénom du destinataire'),
            TextField::new('numeroDest', 'Numéro de téléphone du destinataire'),
            TextField::new('adresseDest', 'Adresse du destinataire'),
            TextField::new('paysDest', 'Pays du destinataire'),
            // Champs pour les informations de paiement
            TextField::new('moyenPaiement', 'Moyen de paiement'),
            NumberField::new('deliveryCost', 'Coût de livraison'),
            NumberField::new('weight', 'Poids du colis'),
            TextField::new('numeroSuivi', 'Numéro de suivi'),
            DateTimeField::new('reservationDate', 'Date de réservation')->setFormat('dd/MM/yyyy HH:mm'),
        ];
    }

    #[Route('/admin/special-reservation-action', name: 'special_reservation_action')]
    public function specialReservationAction(): Response
    {
        // Logique personnalisée pour une action spécifique
        // Exemple : Récupérer toutes les réservations
        $reservations = $this->reservationRepository->findAll();

        // Vous pouvez ensuite traiter ces données et les renvoyer dans une vue
        // Ici, un exemple simple renvoyant une réponse textuelle
        return new Response('Nombre de réservations : ' . count($reservations));
    }
}
