<?php

namespace App\Controller\visiteur\accueil;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pages/visiteur/accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    #[Route('/espace-prive', name: 'espace_prive', methods: ['GET'])]
    public function espacePrive(): Response
    {
        return $this->render('pages/visiteur/accueil/espace_prive.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    #[Route('/presentation', name: 'presentation', methods: ['GET'])]
    public function presentation(): Response
    {
        return $this->render('pages/presentation/presentation.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

}
