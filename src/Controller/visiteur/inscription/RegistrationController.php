<?php

namespace App\Controller\visiteur\inscription;

use App\Entity\Client;
use App\Form\RegistrationFormType;
use App\Repository\ClientRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'register', methods: ['GET', 'POST'])]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        // Création d'une nouvelle instance de l'entité Client
        $client = new Client();
    
        // Création du formulaire d'inscription
        $form = $this->createForm(RegistrationFormType::class, $client);
    
        // Gestion de la soumission du formulaire
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Hachage du mot de passe
            $client->setPassword(
                $userPasswordHasher->hashPassword(
                    $client,
                    $form->get('password')->getData()
                )
            );
    
            // Persiste l'utilisateur dans la base de données
            $entityManager->persist($client);
            $entityManager->flush();
    
            // Envoie de l'e-mail de confirmation
            $this->emailVerifier->sendEmailConfirmation(
                'verify_email',
                $client,
                (new TemplatedEmail())
                    ->from(new Address('envoicolis@soninkaraconnect.com', 'Sakho Abdarahmane'))
                    ->to($client->getEmail())
                    ->subject('Veuillez confirmer votre adresse e-mail')
                    ->htmlTemplate('pages/email/confirmation_email.html.twig')
            );
    
            // Redirection vers la page de vérification
            return $this->redirectToRoute('registration_verification');
        }
    
        // Affichage du formulaire d'inscription
        return $this->render('pages/visiteur/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }    

    #[Route('/register/en_attente_de_verification', name: 'registration_verification', methods: ['GET'])]
    public function emailVerification(): Response
    {
        // Affichage de la page de vérification
        return $this->render('pages/visiteur/registration/verification.html.twig');
    }

    #[Route('/verify/email', name: 'verify_email', methods: ['GET'])]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator, ClientRepository $clientRepository): Response
    {
        // Récupération de l'ID depuis la requête
        $id = $request->query->get('id');

        if (null === $id) {
            // Redirection si l'ID est manquant
            return $this->redirectToRoute('register');
        }

        $user = $clientRepository->find($id);

        if (null === $user) {
            // Redirection si l'utilisateur n'est pas trouvé
            return $this->redirectToRoute('register');
        }

        // Validation du lien de confirmation par e-mail
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            // Gestion des erreurs de confirmation par e-mail
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('accueil');
        }

        // Redirection en cas de succès
        $this->addFlash('success', 'Votre compte a bien été confirmé.');

        return $this->redirectToRoute('login');
    }
}
