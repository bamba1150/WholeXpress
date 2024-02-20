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

    #[ORM\Column(length: 11)]
    private ?string $mode_expedition = null;

    #[ORM\Column(length: 11)]
    private ?string $code_sortie = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_arrivee_est = null;

    #[ORM\Column(length: 50)]
    private ?string $preuve_paiement = null;

    #[ORM\Column]
    private ?float $montant_TTC = null;

    #[ORM\Column]
    private ?float $frais_transport = null;

    #[ORM\Column]
    private ?float $frais_fournisseur = null;

    #[ORM\Column(length: 11)]
    private ?string $etat_achat = null;

    #[ORM\Column(length: 11)]
    private ?string $etat_comm = null;

    #[ORM\ManyToOne(inversedBy: 'achats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\ManyToOne(inversedBy: 'achats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CA $ca = null;

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

    public function getCodeSortie(): ?string
    {
        return $this->code_sortie;
    }

    public function setCodeSortie(string $code_sortie): static
    {
        $this->code_sortie = $code_sortie;

        return $this;
    }

    public function getDateArriveeEst(): ?\DateTimeInterface
    {
        return $this->date_arrivee_est;
    }

    public function setDateArriveeEst(\DateTimeInterface $date_arrivee_est): static
    {
        $this->date_arrivee_est = $date_arrivee_est;

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

    public function getMontantTTC(): ?float
    {
        return $this->montant_TTC;
    }

    public function setMontantTTC(float $montant_TTC): static
    {
        $this->montant_TTC = $montant_TTC;

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

    public function getEtatComm(): ?string
    {
        return $this->etat_comm;
    }

    public function setEtatComm(string $etat_comm): static
    {
        $this->etat_comm = $etat_comm;

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

    public function getCa(): ?CA
    {
        return $this->ca;
    }

    public function setCa(?CA $ca): static
    {
        $this->ca = $ca;

        return $this;
    }
}
