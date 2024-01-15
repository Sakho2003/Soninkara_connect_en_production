<?php

namespace App\Controller\visiteur\accueil;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AProposController extends AbstractController
{
    #[Route('/A-propos', name: 'a_propos')]
    public function index(): Response
    {
        return $this->render('pages/visiteur/a_propos/index.html.twig', [
            'controller_name' => 'AProposController',
        ]);
    }
}
