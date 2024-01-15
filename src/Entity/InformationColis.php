<?php

namespace App\Entity;

use App\Repository\InformationColisRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity(repositoryClass: InformationColisRepository::class)]
class InformationColis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ManyToOne(targetEntity: SuiviColis::class, inversedBy: "informationsColis")]
    private ?SuiviColis $suiviColis = null;
    

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $statut = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $dateHeureChangement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSuiviColis(): ?SuiviColis
    {
        return $this->suiviColis;
    }

    public function setSuiviColis(?SuiviColis $suiviColis): self
    {
        $this->suiviColis = $suiviColis;
        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;
        return $this;
    }

    public function getDateHeureChangement(): ?\DateTimeImmutable
    {
        return $this->dateHeureChangement;
    }

    public function setDateHeureChangement(?\DateTimeImmutable $dateHeureChangement): self
    {
        $this->dateHeureChangement = $dateHeureChangement;
        return $this;
    }
}
