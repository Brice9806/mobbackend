<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $modePaiement = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $datePaiement = null;

    #[ORM\Column(type: Types::TIME_IMMUTABLE)]
    private ?\DateTimeImmutable $heurePaiement = null;

    #[ORM\OneToOne(mappedBy: 'paiement', cascade: ['persist', 'remove'])]
    private ?Billet $billet = null;

    #[ORM\Column]
    private ?int $numeroPaiment = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModePaiement(): ?string
    {
        return $this->modePaiement;
    }

    public function setModePaiement(string $modePaiement): static
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDatePaiement(): ?\DateTimeImmutable
    {
        return $this->datePaiement;
    }

    public function setDatePaiement(\DateTimeImmutable $datePaiement): static
    {
        $this->datePaiement = $datePaiement;

        return $this;
    }

    public function getHeurePaiement(): ?\DateTimeImmutable
    {
        return $this->heurePaiement;
    }

    public function setHeurePaiement(\DateTimeImmutable $heurePaiement): static
    {
        $this->heurePaiement = $heurePaiement;

        return $this;
    }

    public function getBillet(): ?Billet
    {
        return $this->billet;
    }

    public function setBillet(Billet $billet): static
    {
        // set the owning side of the relation if necessary
        if ($billet->getPaiement() !== $this) {
            $billet->setPaiement($this);
        }

        $this->billet = $billet;

        return $this;
    }

    public function getNumeroPaiment(): ?int
    {
        return $this->numeroPaiment;
    }

    public function setNumeroPaiment(int $numeroPaiment): static
    {
        $this->numeroPaiment = $numeroPaiment;

        return $this;
    }
}
