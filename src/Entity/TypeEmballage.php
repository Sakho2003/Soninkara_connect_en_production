<?php

namespace App\Entity;

use App\Repository\TypeEmballageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TypeEmballageRepository::class)]
class TypeEmballage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Champ pour le nom du type d'emballage
    #[ORM\Column(nullable: true)]
    #[Assert\NotBlank(message: 'Le champ nom ne doit pas être vide.')]
    private ?string $nom = null;

    // Champ pour la description du type d'emballage
    #[ORM\Column(nullable: true)]
    #[Assert\NotBlank(message: 'Le champ description ne doit pas être vide.')]
    private ?string $description = null;

    // Champ pour les recommandations spécifiques au type d'emballage
    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $recommandations = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->nom ?? '';
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setRecommandations(?string $recommandations): self
    {
        $this->recommandations = $recommandations;
        return $this;
    }

    public function getRecommandations(): ?string
    {
        return $this->recommandations;
    }
}
