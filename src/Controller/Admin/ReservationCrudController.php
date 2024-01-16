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
        return Reservation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), 
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
        // : Récupérer toutes les réservations
        $reservations = $this->reservationRepository->findAll();

        return new Response('Nombre de réservations : ' . count($reservations));
    }
}
