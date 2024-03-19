<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $ref_emballage = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\OneToOne(inversedBy: 'commande')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Catalogue $catalogue = null;

    #[ORM\OneToOne(inversedBy: 'commande')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Achat $achat = null;

    #[ORM\Column(length: 15)]
    private ?string $moyen_paiement = null;

    #[ORM\Column(length: 15)]
    private ?string $nbre_versement = null;

    #[ORM\Column(length: 15)]
    private ?string $etat_commande = null;

    #[ORM\Column(length: 25)]
    private ?string $preuve_paiement = null;

    

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefEmballage(): ?string
    {
        return $this->ref_emballage;
    }

    public function setRefEmballage(string $ref_emballage): static
    {
        $this->ref_emballage = $ref_emballage;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getCatalogue(): ?Catalogue
    {
        return $this->catalogue;
    }

    public function setCatalogue(Catalogue $catalogue): static
    {
        $this->catalogue = $catalogue;

        return $this;
    }

    public function getAchat(): ?Achat
    {
        return $this->achat;
    }

    public function setAchat(Achat $achat): static
    {
        $this->achat = $achat;

        return $this;
    }

    public function getMoyenPaiement(): ?string
    {
        return $this->moyen_paiement;
    }

    public function setMoyenPaiement(string $moyen_paiement): static
    {
        $this->moyen_paiement = $moyen_paiement;

        return $this;
    }

    public function getNbreVersement(): ?string
    {
        return $this->nbre_versement;
    }

    public function setNbreVersement(string $nbre_versement): static
    {
        $this->nbre_versement = $nbre_versement;

        return $this;
    }

    public function getEtatCommande(): ?string
    {
        return $this->etat_commande;
    }

    public function setEtatCommande(string $etat_commande): static
    {
        $this->etat_commande = $etat_commande;

        return $this;
    }

    public function getPreuvePaiement(): ?string
    {
        return $this->preuve_paiement;
    }

    public function setPreuvePaiement(string $preuve_paiement): static
    {
        $this->preuve_paiement = $preuve_paiement;

        return $this;
    }

    

}