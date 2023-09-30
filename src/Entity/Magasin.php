<?php

namespace App\Entity;

use App\Repository\MagasinRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MagasinRepository::class)]
class Magasin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $typeMagasin = null;

    #[ORM\Column(length: 255)]
    private ?string $nomMagasin = null;

    #[ORM\Column]
    private ?int $numeroMagasin = null;

    #[ORM\Column(length: 255)]
    private ?string $liensMaps = null;

    #[ORM\ManyToOne(inversedBy: 'magasins')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Stop $stop = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeMagasin(): ?string
    {
        return $this->typeMagasin;
    }

    public function setTypeMagasin(string $typeMagasin): static
    {
        $this->typeMagasin = $typeMagasin;

        return $this;
    }

    public function getNomMagasin(): ?string
    {
        return $this->nomMagasin;
    }

    public function setNomMagasin(string $nomMagasin): static
    {
        $this->nomMagasin = $nomMagasin;

        return $this;
    }

    public function getNumeroMagasin(): ?int
    {
        return $this->numeroMagasin;
    }

    public function setNumeroMagasin(int $numeroMagasin): static
    {
        $this->numeroMagasin = $numeroMagasin;

        return $this;
    }

    public function getLiensMaps(): ?string
    {
        return $this->liensMaps;
    }

    public function setLiensMaps(string $liensMaps): static
    {
        $this->liensMaps = $liensMaps;

        return $this;
    }

    public function getStop(): ?Stop
    {
        return $this->stop;
    }

    public function setStop(?Stop $stop): static
    {
        $this->stop = $stop;

        return $this;
    }
}
