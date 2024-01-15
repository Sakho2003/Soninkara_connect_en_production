<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    /**
     * Affiche la liste des images.
     * 
     * @Route('/image', name: 'app_image')
     */
    #[Route('/image', name: 'app_image')]
    public function index(ImageRepository $imageRepository): Response
    {
        // Récupère toutes les images depuis le repository
        $images = $imageRepository->findAll();

        // Affiche la vue avec la liste des images
        return $this->render('pages/administrateur/image/index.html.twig', [
            'images' => $images,
        ]);
    }

    /**
     * Gère le téléversement d'une nouvelle image et l'associe au produit.
     * 
     * @Route('/image/upload', name: 'app_image_upload')
     */
    #[Route('/image/upload', name: 'app_image_upload')]
    public function upload(Request $request): Response
    {
        // Crée une nouvelle instance de l'entité Image
        $image = new Image();

        // Crée un formulaire pour téléverser l'image
        $form = $this->createForm(ImageType::class, $image);

        // Gère la soumission du formulaire
        $form->handleRequest($request);

        // Vérifie si le formulaire a été soumis et s'il est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Obtient l'EntityManager
            $entityManager = $this->getDoctrine()->getManager();

            // Persiste l'entité image
            $entityManager->persist($image);

            // Enregistre les changements en base de données
            $entityManager->flush();

            // Ajoute un message flash pour informer de la réussite du téléversement
            $this->addFlash('success', 'Image téléversée avec succès.');

            // Redirige vers la page d'affichage des images
            return $this->redirectToRoute('app_image');
        }

        // Affiche le formulaire de téléversement d'image
        return $this->render('pages/administrateur/image/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Supprime une image spécifiée par son ID.
     * 
     * @Route('/image/delete/{id}', name: 'app_image_delete')
     */
    #[Route('/image/delete/{id}', name: 'app_image_delete')]
    public function delete(Image $image): Response
    {
        // Obtient l'EntityManager
        $entityManager = $this->getDoctrine()->getManager();

        // Supprime l'entité image
        $entityManager->remove($image);

        // Enregistre les changements en base de données
        $entityManager->flush();

        // Ajoute un message flash pour informer de la réussite de la suppression
        $this->addFlash('success', 'Image supprimée avec succès.');

        // Redirige vers la page d'affichage des images
        return $this->redirectToRoute('app_image');
    }
}
