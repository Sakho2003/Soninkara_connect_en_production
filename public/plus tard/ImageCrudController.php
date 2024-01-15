<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ImageCrudController extends AbstractCrudController
{
    /**
     * Spécifie l'entité que ce CRUD contrôleur gère.
     * 
     * @return string La classe de l'entité
     */
    public static function getEntityFqcn(): string
    {
        return Image::class;
    }

    /**
     * Configure les champs à afficher dans l'interface CRUD.
     * 
     * @param string $pageName Le nom de la page
     * @return iterable Les champs à afficher
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            // Champ pour le nom de l'image
            TextField::new('name', 'Nom de l\'image'),

            // Champ pour le chemin de l'image, gère aussi le téléversement
            ImageField::new('path', 'Chemin de l\'image')
                ->setUploadDir('public/uploads/images') // Définit le répertoire de téléversement
                ->setBasePath('uploads/images') // Définit le chemin de base pour l'affichage
        ];
    }

    /**
     * Configuration générale du CRUD pour l'entité Image.
     * 
     * @param Crud $crud L'objet de configuration CRUD
     * @return Crud La configuration CRUD modifiée
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // Définit les libellés pour l'entité dans l'interface
            ->setEntityLabelInPlural('Images')
            ->setEntityLabelInSingular('Image');
    }
}
