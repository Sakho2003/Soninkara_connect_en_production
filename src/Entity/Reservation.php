<?php

namespace App\Entity;

use App\Entity\Colis;
use App\Entity\TypeEmballage;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection; 


#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // section Expediteur

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $numero = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $pays = null;

    // section destination

    #[ORM\Column(length: 255)]
    private ?string $nomDest = null;

    #[ORM\Column(length: 255)]
    private ?string $prenomDest = null;

    #[ORM\Column(length: 255)]
    private ?string $numeroDest = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseDest = null;

    #[ORM\Column(length: 255)]
    private ?string $paysDest = null;

    // section moyen de paiement

    #[ORM\Column(length: 255)]
    private ?string $moyenPaiement = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $deliveryCost = null;

    // #[ORM\Column(length: 255, nullable: true)]
    // private ?string $colis = null;

    // #[ORM\Column(nullable: true)]
    // private ?float $distance = null;

    
    #[ORM\Column(type: 'float')]
    private ?float $weight = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numeroSuivi = null;


    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $reservationDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $statutPaiement = null;


    // section de relation avec les entités

    #[ORM\ManyToOne(targetEntity: TypeEmballage::class)]
    #[ORM\JoinColumn(name: "type_emballage_id", referencedColumnName: "id", nullable: true)]
    private ?TypeEmballage $typeEmballage = null;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: Colis::class, cascade: ["remove"])]
    private Collection $colisRelation;    

    #[ORM\Column(type: "float", nullable: true)]
    private ?float $tarifEstime = null;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id')]
    private ?Client $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }



    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }


    public function getReservationDate(): \DateTimeImmutable
    {
        return $this->reservationDate;
    }


   // Getters et setters pour la première étape : Expéditeur

    public function getNom(): ?string
    {
        return $this->nom;
    }
  
   public function setNom(?string $nom): self
   {
       $this->nom = $nom;
       return $this;
   }
  
   public function getPrenom(): ?string
   {
       return $this->prenom;
   }
  
   public function setPrenom(?string $prenom): self
   {
       $this->prenom = $prenom;
       return $this;
   }
  
   public function getNumero(): ?string
   {
       return $this->numero;
   }
  
   public function setNumero(?string $numero): self
   {
       $this->numero = $numero;
       return $this;
   }
  
   public function getAdresse(): ?string
   {
       return $this->adresse;
   }
  
   public function setAdresse(?string $adresse): self
   {
       $this->adresse = $adresse;
       return $this;
   }
  
   public function getPays(): ?string
   {
       return $this->pays;
   }
  
   public function setPays(?string $pays): self
   {
       $this->pays = $pays;
       return $this;
   }

   public function getTypeEmballage(): ?TypeEmballage  
    {
    return $this->typeEmballage;
    }

    public function setTypeEmballage(?TypeEmballage $typeEmballage): self
    {
    $this->typeEmballage = $typeEmballage;
    
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
    
   // Getters et setters pour la deuxième étape : Destinataire et Moyen de paiement
   public function getNomDest(): ?string
   {
       return $this->nomDest;
   }
  
   public function setNomDest(?string $nomDest): self
   {
       $this->nomDest = $nomDest;
       return $this;
   }
  
   public function getPrenomDest(): ?string
   {
       return $this->prenomDest;
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

   public function setPrenomDest(?string $prenomDest): self
   {
       $this->prenomDest = $prenomDest;
       return $this;
   }
  
   public function getNumeroDest(): ?string
   {
       return $this->numeroDest;
   }
  
   public function setNumeroDest(?string $numeroDest): self
   {
       $this->numeroDest = $numeroDest;
       return $this;
   }
  
   public function getAdresseDest(): ?string
   {
       return $this->adresseDest;
   }
  
   public function setAdresseDest(?string $adresseDest): self
   {
       $this->adresseDest = $adresseDest;
       return $this;
   }
  
   public function getPaysDest(): ?string 
   {
     return $this->paysDest;
   }
   
   public function setPaysDest(?string $paysDest): self
   {
     $this->paysDest = $paysDest;
   
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

   public function getStatutPaiement(): ?string
    {
        return $this->statutPaiement;
    }

    public function setStatutPaiement(?string $statutPaiement): self
    {
        $this->statutPaiement = $statutPaiement;
        return $this;
    }

    public function setReservationDate(\DateTimeImmutable $reservationDate): self
    {
        $this->reservationDate = $reservationDate;
        return $this;
    }

    public function getSlug(): string
    {
        return (new AsciiSlugger())->slug($this->nom)->lower();
    }

    public function __toString(): string
    {
        return $this->nom . ' ' . $this->prenom . ' - Réservation N°' . $this->id;
    } 

    
/**
 * Get the value of colisRelation
 *
 * @return Collection|null
 */
public function getColisRelation(): ?Collection  
{
  return $this->colisRelation ?? new ArrayCollection();
}

/**
 * Set the value of colisRelation
 *
 * @param Collection|null $colisRelation
 *
 * @return self
 */
public function setColisRelation(?Collection $colisRelation): self
{
  $this->colisRelation = $colisRelation;
  
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

    public function addColis(Colis $colis): self
    {
        if (!$this->colisRelation->contains($colis)) {
            $this->colisRelation[] = $colis;
            $colis->setReservation($this);
        }
    
        return $this;
    }
    



    public function __construct()
    {
        $this->colis = new ArrayCollection();
    }

    /**
     * @return Collection|Colis[]
     */
    public function getColis(): Collection
    {
        return $this->colis;
    }


    public function removeColis(Colis $colis): self
    {
        if ($this->colis->removeElement($colis)) {
            // set the owning side to null (unless already changed)
            if ($colis->getReservation() === $this) {
                $colis->setReservation(null);
            }
        }

        return $this;
    }

    
    public function getTarifEstime(): ?float
    {
        return $this->tarifEstime;
    }
    
    public function setTarifEstime(?float $tarifEstime): self
    {
        $this->tarifEstime = $tarifEstime;
    
        return $this;
    }
    
}
