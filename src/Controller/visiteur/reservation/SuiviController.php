<?php

namespace App\Controller\visiteur\reservation;

use App\Repository\ColisRepository;
use App\Repository\SuiviColisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SuiviController extends AbstractController
{
    private $colisRepository;
    private $suiviColisRepository;

    public function __construct(ColisRepository $colisRepository, SuiviColisRepository $suiviColisRepository)
    {
        $this->colisRepository = $colisRepository;
        $this->suiviColisRepository = $suiviColisRepository;
    }

    #[Route('/suivi-colis', name: 'suivi.colis', methods: ['GET', 'POST'])]
    public function suiviColis(Request $request): Response
    {
        // Récupération du numéro de suivi depuis la requête
        $numeroSuivi = $request->request->get('numero_suivi');
        $historiqueStatuts = [];

        // Si un numéro de suivi est fourni
        if ($numeroSuivi) {
            // Recherche du colis correspondant au numéro de suivi
            $colis = $this->colisRepository->findOneBy(['numeroSuivi' => $numeroSuivi]);

            // Si le colis est trouvé
            if ($colis) {
                // Récupération des suivis associés au colis
                $suivis = $this->suiviColisRepository->findBy(['colis' => $colis]);

                // Construction de l'historique des statuts
                foreach ($suivis as $suivi) {
                    $historiqueStatuts[] = [
                        'statut' => $suivi->getStatut(),
                        'date' => $suivi->getDateHeureSuivi(),
                    ];
                }
            } else {
                // Aucun colis correspondant au numéro de suivi saisi
                $this->addFlash('error', 'Aucun colis correspondant au numéro de suivi saisi.');
            }
        }

        return $this->render('pages/visiteur/suivi/index.html.twig', [
            'historiqueStatuts' => $historiqueStatuts,
            'numeroSuivi' => $numeroSuivi,
        ]);
    }

    // Route pour fournir les données de suivi au format JSON
    #[Route('/api/suivi-data', name: 'api_suivi_data', methods: ['GET'])]
    public function apiSuiviData(Request $request): JsonResponse
    {
        $numeroSuivi = $request->query->get('numero_suivi');
        $historiqueStatuts = [];

        // Même logique que la méthode suiviColis pour récupérer les données
        if ($numeroSuivi) {
            $colis = $this->colisRepository->findOneBy(['numeroSuivi' => $numeroSuivi]);

            if ($colis) {
                $suivis = $this->suiviColisRepository->findBy(['colis' => $colis]);

                foreach ($suivis as $suivi) {
                    $historiqueStatuts[] = [
                        'statut' => $suivi->getStatut(),
                        'date' => $suivi->getDateHeureSuivi()->format('Y-m-d H:i:s'),
                // la localisation a mettre plus tard 
                    ];
                }
            }
        }

        return $this->json($historiqueStatuts);
    }
}
