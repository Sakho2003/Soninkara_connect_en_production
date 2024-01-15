<?php

namespace App\Entity;

use App\Entity\Colis;
use App\Entity\InformationColis;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: SuiviColisRepository::class)]
class SuiviColis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Colis::class, inversedBy: "suivisColis")]
    #[ORM\JoinColumn(nullable: true, referencedColumnName: 'id')]
    private ?Colis $colis;

    #[ORM\Column(nullable: true)]
    #[Assert\NotBlank(message: 'Le champ statut ne doit pas être vide.')]
    private ?string $statut = null;

    #[ORM\Column(nullable: true, type: 'datetime_immutable')]
    #[Assert\NotBlank(message: 'Le champ dateHeureSuivi ne doit pas être vide.')]
    private ?\DateTimeImmutable $dateHeureSuivi = null;

    #[ORM\Column(nullable: true)]
    private ?string $numeroSuivi = null;

    #[ORM\OneToMany(mappedBy: 'suiviColis', targetEntity: InformationColis::class, orphanRemoval: true)]
    private Collection $informationsColis;
    

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $localisationActuelle = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $itinerairePrevu = null;

    public function __construct()
    {
        $this->informationsColis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColis(): ?Colis
    {
        return $this->colis;
    }

    public function setColis(?Colis $colis): self
    {
        $this->colis = $colis;
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

    public function getDateHeureSuivi(): ?\DateTimeImmutable
    {
        return $this->dateHeureSuivi;
    }

    public function setDateHeureSuivi(?\DateTimeImmutable $dateHeureSuivi): self
    {
        $this->dateHeureSuivi = $dateHeureSuivi;
        return $this;
    }

    public function getNumeroSuivi(): ?string
    {
        return $this->numeroSuivi;
    }

    public function setNumeroSuivi(?string $numeroSuivi): self
    {
        $this->numeroSuivi = $numeroSuivi;
        return $this;
    }

    public function getInformationsColis(): Collection
    {
        return $this->informationsColis;
    }

    public function addInformationColis(InformationColis $informationColis): self
    {
        if (!$this->informationsColis->contains($informationColis)) {
            $this->informationsColis[] = $informationColis;
            $informationColis->setSuiviColis($this);
        }

        return $this;
    }

    public function removeInformationColis(InformationColis $informationColis): self
    {
        if ($this->informationsColis->removeElement($informationColis)) {
            if ($informationColis->getSuiviColis() === $this) {
                $informationColis->setSuiviColis(null);
            }
        }

        return $this;
    }

    public function getLocalisationActuelle(): ?string
    {
        return $this->localisationActuelle;
    }

    public function setLocalisationActuelle(?string $localisationActuelle): self
    {
        $this->localisationActuelle = $localisationActuelle;
        return $this;
    }

    public function getItinerairePrevu(): ?string
    {
        return $this->itinerairePrevu;
    }

    public function setItinerairePrevu(?string $itinerairePrevu): self
    {
        $this->itinerairePrevu = $itinerairePrevu;
        return $this;
    }
}
