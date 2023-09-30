<?php

namespace App\Entity;

use App\Repository\StopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StopRepository::class)]
class Stop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $villeStop = null;

    #[ORM\Column]
    private ?int $tempsStop = null;

   

    #[ORM\OneToMany(mappedBy: 'stop', targetEntity: Magasin::class)]
    private Collection $magasins;

    #[ORM\ManyToOne(inversedBy: 'stops')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Trajet $trajet = null;

   
    public function __construct()
    {
    
        $this->magasins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilleStop(): ?string
    {
        return $this->villeStop;
    }

    public function setVilleStop(string $villeStop): static
    {
        $this->villeStop = $villeStop;

        return $this;
    }

    public function getTempsStop(): ?int
    {
        return $this->tempsStop;
    }

    public function setTempsStop(int $tempsStop): static
    {
        $this->tempsStop = $tempsStop;

        return $this;
    }
    
    /**
     * @return Collection<int, Magasin>
     */
    public function getMagasins(): Collection
    {
        return $this->magasins;
    }

    public function addMagasin(Magasin $magasin): static
    {
        if (!$this->magasins->contains($magasin)) {
            $this->magasins->add($magasin);
            $magasin->setStop($this);
        }

        return $this;
    }

    public function removeMagasin(Magasin $magasin): static
    {
        if ($this->magasins->removeElement($magasin)) {
            // set the owning side to null (unless already changed)
            if ($magasin->getStop() === $this) {
                $magasin->setStop(null);
            }
        }

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

    public function __toString()
    {
        return $this-> villeStop;
    }

}
