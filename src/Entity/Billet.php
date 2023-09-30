<?php

namespace App\Entity;

use App\Repository\BilletRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BilletRepository::class)]
class Billet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?bool $paye = null;

    #[ORM\Column(length: 255)]
    private ?string $nomPassager = null;

    #[ORM\ManyToOne(inversedBy: 'billets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToOne(inversedBy: 'billet', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Paiement $paiement = null;

    #[ORM\ManyToOne(inversedBy: 'billets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Trajet $trajet = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typePassager = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenomPassager = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function isPaye(): ?bool
    {
        return $this->paye;
    }

    public function setPaye(bool $paye): static
    {
        $this->paye = $paye;

        return $this;
    }

    public function getNomPrenomPassager(): ?string
    {
        return $this->nomPassager;
    }

    public function setNomPrenomPassager(string $nomPassager): static
    {
        $this->nomPassager = $nomPassager;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getPaiement(): ?Paiement
    {
        return $this->paiement;
    }

    public function setPaiement(Paiement $paiement): static
    {
        $this->paiement = $paiement;

        return $this;
    }

    public function getTrajet(): ?Trajet
    {
        return $this->trajet;
    }

    public function setTrajet(?Trajet $trajet): static
    {
        $this->trajet = $trajet;

        return $this;
    }

    public function getTypePassager(): ?string
    {
        return $this->typePassager;
    }

    public function setTypePassager(?string $typePassager): static
    {
        $this->typePassager = $typePassager;

        return $this;
    }

    public function getPrenomPassager(): ?string
    {
        return $this->prenomPassager;
    }

    public function setPrenomPassager(?string $prenomPassager): static
    {
        $this->prenomPassager = $prenomPassager;

        return $this;
    }

}
