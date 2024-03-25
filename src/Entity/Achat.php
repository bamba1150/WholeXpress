<?php

namespace App\Entity;

use App\Repository\AchatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchatRepository::class)]
class Achat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 25)]
    private ?string $mode_expedition = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_arrivee_estimee = null;

    #[ORM\Column]
    private ?float $montant_ttc = null;

    #[ORM\Column]
    private ?float $frais_transport = null;

    #[ORM\Column]
    private ?float $frais_fournisseur = null;

    #[ORM\Column(length: 15)]
    private ?string $etat_achat = null;

    #[ORM\Column(length: 15)]
    private ?string $etat_communication = null;

    #[ORM\ManyToOne(inversedBy: 'achats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CA $ca = null;

    #[ORM\OneToOne(inversedBy: 'achat')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commande = null;

    #[ORM\ManyToOne(inversedBy: 'achats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getModeExpedition(): ?string
    {
        return $this->mode_expedition;
    }

    public function setModeExpedition(string $mode_expedition): static
    {
        $this->mode_expedition = $mode_expedition;

        return $this;
    }

    public function getDateArriveeEstimee(): ?\DateTimeInterface
    {
        return $this->date_arrivee_estimee;
    }

    public function setDateArriveeEstimee(\DateTimeInterface $date_arrivee_estimee): static
    {
        $this->date_arrivee_estimee = $date_arrivee_estimee;

        return $this;
    }

    public function getMontantTtc(): ?float
    {
        return $this->montant_ttc;
    }

    public function setMontantTtc(float $montant_ttc): static
    {
        $this->montant_ttc = $montant_ttc;

        return $this;
    }

    public function getFraisTransport(): ?float
    {
        return $this->frais_transport;
    }

    public function setFraisTransport(float $frais_transport): static
    {
        $this->frais_transport = $frais_transport;

        return $this;
    }

    public function getFraisFournisseur(): ?float
    {
        return $this->frais_fournisseur;
    }

    public function setFraisFournisseur(float $frais_fournisseur): static
    {
        $this->frais_fournisseur = $frais_fournisseur;

        return $this;
    }

    public function getEtatAchat(): ?string
    {
        return $this->etat_achat;
    }

    public function setEtatAchat(string $etat_achat): static
    {
        $this->etat_achat = $etat_achat;

        return $this;
    }

    public function getEtatCommunication(): ?string
    {
        return $this->etat_communication;
    }

    public function setEtatCommunication(string $etat_communication): static
    {
        $this->etat_communication = $etat_communication;

        return $this;
    }

    public function getCa(): ?CA
    {
        return $this->ca;
    }

    public function setCa(?CA $ca): static
    {
        $this->ca = $ca;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(Commande $commande): static
    {
        $this->commande = $commande;

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
}
