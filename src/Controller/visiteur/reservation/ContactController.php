<?php

namespace App\Controller\visiteur\reservation;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création d'une nouvelle instance de l'entité Contact
        $contact = new Contact();

        // Création et configuration du formulaire
        $form = $this->createForm(ContactType::class, $contact);

        // Traitement des données de requête (POST) par le formulaire
        $form->handleRequest($request);

        // Vérifie si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Utilisation de l'EntityManager pour persister et enregistrer les données
            $entityManager->persist($contact);
            $entityManager->flush();

            // Ajout d'un message flash pour informer l'utilisateur
            $this->addFlash('success', 'Votre message a bien été envoyé.');

            return $this->redirectToRoute('app_contact');
        }

        // Rendu du formulaire dans le template Twig
        return $this->render('pages/visiteur/contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
