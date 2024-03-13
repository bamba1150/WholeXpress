<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;

#[InheritanceType("JOINED")]
#[DiscriminatorColumn(name:"typeClient", type:"string")]
#[DiscriminatorMap([
    "commercant" => "Commercant" ,
    "particulier" => "Particulier"
])]

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{

   

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column] 
    protected ?int $id = null;

    #[ORM\Column(length: 25)]
    protected ?string $emailClient = null;

    #[ORM\Column(length: 25)]
    protected ?string $adresseClient = null;

    #[ORM\ManyToOne(inversedBy: 'clients')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $commercial = null;

    #[ORM\ManyToOne(inversedBy: 'clients')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Reclamations $reclamations = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Achat::class)]
    private Collection $achats;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Paiement::class)]
    private Collection $paiements;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Catalogue::class)]
    private Collection $catalogues;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Commande::class)]
    private Collection $commandes;

    #[ORM\Column(length: 25)]
    private ?string $nomComplet_Client = null;

   

  
    protected static int $incrementParticulier = 1;
    protected static int $incrementCommercant = 1;

    public function __construct()
    {
        // Initialiser le type lors de la création de l'entité
        if ($this instanceof Particulier) 
        {
            $this->setCodeClient('PART' . str_pad(self::$incrementParticulier, 3, '0', STR_PAD_LEFT));
        }
        elseif ($this instanceof Commercant) 
        {
            $this->setCodeClient('COM' . str_pad(self::$incrementCommercant++, 3, '0', STR_PAD_LEFT));
        }

        $this->achats = new ArrayCollection();
        $this->paiements = new ArrayCollection();
        $this->catalogues = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }
    

    public function getType(): string
    {
        return $this::class;
    }

    

    public function getNomCompletClient(): ?string
    {
        return $this->nomComplet_Client;
    }

    public function setNomCompletClient(string $nomComplet_Client): static
    {
        $this->nomComplet_Client = $nomComplet_Client;

        return $this;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    #[ORM\Column(length: 25)]
    private ?string $codeClient = null;

    #[ORM\PrePersist]
    public function generateCodeClient(): string
    {
     
       // Logique pour générer le code client
        $codePrefix = $this instanceof Particulier ? 'PART' : 'COM';
        $counter = $this instanceof Particulier ? self::$incrementParticulier++ : self::$incrementCommercant++;
        
        return $codePrefix . str_pad($counter, 3, '0', STR_PAD_LEFT);
    }

    
   


    public function getCodeClient(): ?string
    {
        return $this->codeClient;
    }

    
    public function setCodeClient(string $codeClient): static
    {
        $this->codeClient = $codeClient;

        return $this;
    }


    public function getEmailClient(): ?string
    {
        return $this->emailClient;
    }

    public function setEmailClient(string $emailClient): static
    {
        $this->emailClient = $emailClient;

        return $this;
    }

    public function getAdresseClient(): ?string
    {
        return $this->adresseClient;
    }

    public function setAdresseClient(string $adresseClient): static
    {
        $this->adresseClient = $adresseClient;

        return $this;
    }

    public function getCommercial(): ?User
    {
        return $this->commercial;
    }

    public function setCommercial(?User $commercial): static
    {
        $this->commercial = $commercial;

        return $this;
    }

    public function getReclamations(): ?Reclamations
    {
        return $this->reclamations;
    }

    public function setReclamations(?Reclamations $reclamations): static
    {
        $this->reclamations = $reclamations;

        return $this;
    }

    /**
     * @return Collection<int, Achat>
     */
    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Achat $achat): static
    {
        if (!$this->achats->contains($achat)) {
            $this->achats->add($achat);
            $achat->setClient($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): static
    {
        if ($this->achats->removeElement($achat)) {
            // set the owning side to null (unless already changed)
            if ($achat->getClient() === $this) {
                $achat->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Paiement>
     */
    public function getPaiements(): Collection
    {
        return $this->paiements;
    }

    public function addPaiement(Paiement $paiement): static
    {
        if (!$this->paiements->contains($paiement)) {
            $this->paiements->add($paiement);
            $paiement->setClient($this);
        }

        return $this;
    }

    public function removePaiement(Paiement $paiement): static
    {
        if ($this->paiements->removeElement($paiement)) {
            // set the owning side to null (unless already changed)
            if ($paiement->getClient() === $this) {
                $paiement->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Catalogue>
     */
    public function getCatalogues(): Collection
    {
        return $this->catalogues;
    }

    public function addCatalogue(Catalogue $catalogue): static
    {
        if (!$this->catalogues->contains($catalogue)) {
            $this->catalogues->add($catalogue);
            $catalogue->setClient($this);
        }

        return $this;
    }

    public function removeCatalogue(Catalogue $catalogue): static
    {
        if ($this->catalogues->removeElement($catalogue)) {
            // set the owning side to null (unless already changed)
            if ($catalogue->getClient() === $this) {
                $catalogue->setClient(null);
            }
        }

        return $this;
    }

   

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes->add($commande);
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

        return $this;
    }

    public function getCommercialNomComplet()
    {
        return $this->commercial->getNomComplet(); 

   }
}