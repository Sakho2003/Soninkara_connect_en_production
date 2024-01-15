<?php

namespace App\Entity;

use App\Repository\ColisRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;



#[ORM\Entity(repositoryClass: ColisRepository::class)]
class Colis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'float')]
    private ?float $deliveryCost = null;

    #[ORM\Column(type: 'float')]
    private ?float $weight = null;
 
    #[ORM\Column(length: 255)]
    private ?string $moyenPaiement = null;

    #[ORM\ManyToOne(targetEntity: Reservation::class, inversedBy: "colisRelation")]
    #[ORM\JoinColumn(name: "reservation_id", referencedColumnName: "id")]
    private ?Reservation $reservation = null;

    #[ORM\OneToMany(mappedBy: 'colis', targetEntity: SuiviColis::class, cascade: ["remove"])]
    private Collection $suivisColis;
    

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $numeroSuivi = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return sprintf('Colis %d - Réservation %d', $this->getId(), $this->getReservation()->getId());
    }

   

    // Getter et Setter pour la réservation
    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;
        return $this;
    }

    public function addColis(Colis $colis): self
    {
        if (!$this->suivisColis->contains($colis)) {
            $this->suivisColis[] = $colis;
            $colis->setReservation($this);
        }
    
        return $this;
    }

    
    
    public function getDeliveryCost(): ?float
    {
    return $this->deliveryCost;
    }

    public function setDeliveryCost(?float $deliveryCost): self
    {
    $this->deliveryCost = $deliveryCost;

    return $this; 
    }

    

    public function getWeight(): ?float
    {
    return $this->weight; 
    }

    public function setWeight(?float $weight): self
    {
    $this->weight = $weight;

    return $this;
    }

    public function getMoyenPaiement(): ?string
    {
        return $this->moyenPaiement;
    }

    public function setMoyenPaiement(string $moyenPaiement): self
    {
        $this->moyenPaiement = $moyenPaiement;
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


}
