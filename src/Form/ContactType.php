<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Construction du formulaire avec différents champs
        $builder
            // Champ 'nom' avec des contraintes pour la validation
            ->add('nom', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre nom.']),
                    new Length(['max' => 255])
                ],
                'label' => 'Nom'
            ])
            // Champ 'prenom' avec des contraintes pour la validation
            ->add('prenom', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre prénom.']),
                    new Length(['max' => 255])
                ],
                'label' => 'Prénom'
            ])
            // Champ 'email' avec des contraintes pour la validation
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre adresse email.']),
                    new Email(['message' => 'Veuillez saisir une adresse email valide.'])
                ],
                'label' => 'Email'
            ])
            // Champ 'message' avec des contraintes pour la validation
            ->add('message', TextareaType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez saisir votre message.'])
                ],
                'label' => 'Message'
            ])
            // Champ 'numeroDeTel' optionnel
            ->add('telephone', TelType::class, [
                'required' => false,
                'constraints' => [
                    new Length(['max' => 20])
                ],
                'label' => 'Numéro de Téléphone (optionnel)'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Configuration des options par défaut du formulaire
        $resolver->setDefaults([
            'data_class' => Contact::class, // Liaison avec l'entité Contact
        ]);
    }
}
