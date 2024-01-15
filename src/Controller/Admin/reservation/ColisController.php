<?php

namespace App\Controller\Admin\reservation;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reservation;
use App\Form\ReservationColisType;
use Doctrine\ORM\EntityManagerInterface;

class ColisController extends AbstractDashboardController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/colis', name: 'app_colis')]
    public function index(): Response
    {
        $reservationRepository = $this->entityManager->getRepository(Reservation::class);
        $reservations = $reservationRepository->findAll();

        return $this->render('pages/administrateur/colis/index.html.twig', [
            'reservations' => $reservations, // Correction ici : 'reservation' remplacé par 'reservations'
        ]);
    }

    #[Route('/colis/nouveau', name: 'app_colis_nouveau')]
    public function create(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationColisType::class, $reservation);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Assigner la date de réservation si elle n'est pas fournie
            if (!$reservation->getReservationDate()) {
                $reservation->setReservationDate(new \DateTime());
            }
    
            $this->entityManager->persist($reservation);
            $this->entityManager->flush();
    
            return $this->redirectToRoute('app_colis');
        }
    
        return $this->render('app_colis', ['form' => $form->createView()]);
    
    
        return $this->render('pages/administrateur/colis/nouveau.html.twig', [
            'form' => $form->createView(),
            'reservation' => $reservation, // Ajouter cette ligne pour passer la variable au template
        ]);
    }
    
    #[Route('/colis/{id}/modifier', name: 'app_colis_modifier')]
    public function edit(Request $request, Reservation $reservation): Response
    {
        $form = $this->createForm(ReservationColisType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('app_colis');
        }

        return $this->render('pages/administrateur/colis/modifier.html.twig', [
            'form' => $form->createView(),
            'reservation' => $reservation,
        ]);
    }

    #[Route('/colis/{id}/supprimer', name: 'app_colis_supprimer')]
    public function delete(Reservation $reservation): Response
    {
        $this->entityManager->remove($reservation);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_colis');
    }
}
