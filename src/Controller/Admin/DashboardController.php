<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Contact;
use App\Entity\Colis;
use App\Entity\Client;
use App\Entity\Reservation;
use App\Form\AjouterImageType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('pages/administrateur/dashbord/dashbord.html.twig');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de bord', 'fa fa-home');




        yield MenuItem::section('Gestion des Colis', 'fa fa-truck');

        yield MenuItem::linkToRoute('Réservations', 'fa fa-list', 'app_colis');
        yield MenuItem::linkToCrud('Réservations', 'fa fa-calendar', Reservation::class);
        yield MenuItem::linkToCrud('Liste des Colis', 'fa fa-list', Colis::class);


        yield MenuItem::section('Gestion des Contact', 'fa fa-envelope');        
        yield MenuItem::linkToCrud('Liste des Messages', 'fa fa-list', Contact::class);


        yield MenuItem::section('Gestion des Clients', 'fa fa-user');
        yield MenuItem::linkToCrud('Liste des Clients', 'fa fa-list', Client::class);
        
        yield MenuItem::section('navigation', 'fa fa-arrow-left');        
        yield MenuItem::linkToUrl('Retourner au site', 'fa fa-arrow-left', '/');

        // yield MenuItem::linkToCrud('Liste des Clients', 'fa fa-list', 'nouveau.client');

        // yield MenuItem::linkToRoute('Produits', 'fa fa-box', 'admin.produit.liste');
        // yield MenuItem::linkToRoute('Ajouter un produit', 'fa fa-plus', 'admin.boutique');
        // yield MenuItem::linkToRoute('Ajouter une Image à un Produit', 'fa fa-plus', 'admin.produit.ajouter_image', ['id' => 1]); // Remplacez '1' par le paramètre approprié

        // // Ajout de la gestion des images
        // yield MenuItem::section('Gestion des Images', 'fa fa-image');
        // yield MenuItem::linkToCrud('Liste des Images', 'fa fa-image', 'App\Entity\Image');
        // // yield MenuItem::linkToCrud('Ajouter une Image', 'fa fa-plus', 'App\Entity\Image', 'admin_upload_image');

        // Ajout de la gestion des paiements PayPal
        // yield MenuItem::section('Gestion des Paiements', 'fa fa-credit-card');
        // yield MenuItem::linkToRoute('Paiements PayPal', 'fa fa-paypal', 'admin_paiements');


    }
}
