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
}
