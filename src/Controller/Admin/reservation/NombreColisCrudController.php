<?php

namespace App\Controller\Admin\reservation;

use App\Entity\Colis;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NombreColisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Colis::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id', 'ID')->onlyOnIndex(),
            IntegerField::new('deliveryCost', 'Coût de livraison'),
            IntegerField::new('weight', 'Poids'),
            IntegerField::new('reservation.id', 'ID de réservation'),
            TextField::new('numeroSuivi', 'Numéro de suivi'),
        ];
    }


}

