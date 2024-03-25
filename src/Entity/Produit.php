<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $codeProduit = null;

    #[ORM\Column(length: 25)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $prixUsine_devise = null;

    #[ORM\Column]
    private ?float $prixUnitaire = null;

    #[ORM\Column]
    private ?float $qte = null;

    #[ORM\Column]
    private ?float $qte_recue = null;

    #[ORM\Column]
    private ?float $qte_manquante = null;

    
    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Catalogue $catalogue = null;

    #[ORM\OneToMany(mappedBy: 'produits', targetEntity: Commande::class)]
    private Collection $commandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    

   

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeProduit(): ?string
    {
        return $this->codeProduit;
    }

    public function setCodeProduit(string $codeProduit): static
    {
        $this->codeProduit = $codeProduit;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrixUsineDevise(): ?float
    {
        return $this->prixUsine_devise;
    }

    public function setPrixUsineDevise(float $prixUsine_devise): static
    {
        $this->prixUsine_devise = $prixUsine_devise;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): static
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    public function getQte(): ?float
    {
        return $this->qte;
    }

    public function setQte(float $qte): static
    {
        $this->qte = $qte;

        return $this;
    }

    public function getQteRecue(): ?float
    {
        return $this->qte_recue;
    }

    public function setQteRecue(float $qte_recue): static
    {
        $this->qte_recue = $qte_recue;

        return $this;
    }

    public function getQteManquante(): ?float
    {
        return $this->qte_manquante;
    }

    public function setQteManquante(float $qte_manquante): static
    {
        $this->qte_manquante = $qte_manquante;

        return $this;
    }

   

    public function getCatalogue(): ?Catalogue
    {
        return $this->catalogue;
    }

    public function setCatalogue(?Catalogue $catalogue): static
    {
        $this->catalogue = $catalogue;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }
}
   
