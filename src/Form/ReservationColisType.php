<?php

namespace App\Form;

use App\Entity\TypeEmballage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class ReservationColisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Première étape : Expéditeur
            ->add('nom', TextType::class, [
                'label' => 'Nom de l\'expéditeur',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ "Nom de l\'expéditeur" ne doit pas être vide.']),
                    new Assert\Length([
                        'max' => 255,
                        'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom de l\'expéditeur',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ "Prénom de l\'expéditeur" ne doit pas être vide.']),
                    new Assert\Length([
                        'max' => 255,
                        'maxMessage' => 'Le prénom ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('numero', TelType::class, [
                'label' => 'Numéro de téléphone de l\'expéditeur',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ "Numéro de téléphone" ne doit pas être vide.']),
                ],
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse de l\'expéditeur',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ "Adresse de l\'expéditeur" ne doit pas être vide.']),
                ],
            ])
            ->add('pays', ChoiceType::class, [
                'choices' => [
                    'Mauritanie' => 'Mauritanie',
                    'France' => 'France',
                    'Sénégal' => 'Sénégal',
                ],
                'label' => 'Pays de l\'expéditeur',
                'required' => true,
            ])

            // Deuxième étape : Destinataire et Moyen de paiement
            ->add('nomDest', TextType::class, [
                'label' => 'Nom du destinataire',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ "Nom du destinataire" ne doit pas être vide.']),
                    new Assert\Length([
                        'max' => 255,
                        'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('prenomDest', TextType::class, [
                'label' => 'Prénom du destinataire',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ "Prénom du destinataire" ne doit pas être vide.']),
                    new Assert\Length([
                        'max' => 255,
                        'maxMessage' => 'Le prénom ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('numeroDest', TelType::class, [
                'label' => 'Numéro de téléphone du destinataire',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ "Numéro de téléphone" ne doit pas être vide.']),
                ],
            ])
            ->add('adresseDest', TextType::class, [
                'label' => 'Adresse du destinataire',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ "Adresse du destinataire" ne doit pas être vide.']),
                ],
            ])
            ->add('paysDest', ChoiceType::class, [
                'choices' => [
                    'Mauritanie' => 'Mauritanie',
                    'France' => 'France',
                    'Sénégal' => 'Sénégal',
                ],
                'label' => 'Pays du destinataire',
                'required' => true,
            ])
            ->add('typeEmballage', EntityType::class, [
                'class' => TypeEmballage::class,
                'label' => 'Type d\'emballage',
                'required' => true,
                'placeholder' => 'Sélectionnez le type d\'emballage',
                'choice_label' => function (TypeEmballage $typeEmballage) {
                    return $typeEmballage->getNom();
                },
            ])

            
            ->add('weight', NumberType::class, [
                'label' => 'Poids du colis (en kg)',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ "Poids du colis" ne doit pas être vide.']),
                    new Assert\Range([
                        'min' => 0.01, // Poids minimum
                        'max' => 100, // Poids maximum
                        'minMessage' => 'Le poids doit être supérieur à {{ limit }} kg.',
                        'maxMessage' => 'Le poids ne peut pas dépasser {{ limit }} kg.',
                    ]),
                ],
            ])
            // ->add('tarifEstime', NumberType::class, [
            //     'label' => 'Tarif estimé (€)',
            //     'mapped' => false,
            //     'disabled' => true,
            // ])
            ->add('moyenPaiement', ChoiceType::class, [
                'choices' => [
                    'En espèces à la livraison' => 'En espèces à la livraison',
                    'En ligne (PayPal)' => 'En ligne (PayPal)',
                    'En ligne (Carte bancaire)' => 'En ligne (Carte bancaire)',
                ],
                'label' => 'Moyen de paiement',
                'required' => true,
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Le champ "Moyen de paiement" ne doit pas être vide.']),
                ],
            ])
            
            
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configurez vos options de formulaire ici
        ]);
    }
}
