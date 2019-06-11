<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RacesRepository")
 */
class Races
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Personnages", mappedBy="races", orphanRemoval=true)
     */
    private $idPersonnage;

    public function __construct()
    {
        $this->idPersonnage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Personnages[]
     */
    public function getIdPersonnage(): Collection
    {
        return $this->idPersonnage;
    }

    public function addIdPersonnage(Personnages $idPersonnage): self
    {
        if (!$this->idPersonnage->contains($idPersonnage)) {
            $this->idPersonnage[] = $idPersonnage;
            $idPersonnage->setRaces($this);
        }

        return $this;
    }

    public function removeIdPersonnage(Personnages $idPersonnage): self
    {
        if ($this->idPersonnage->contains($idPersonnage)) {
            $this->idPersonnage->removeElement($idPersonnage);
            // set the owning side to null (unless already changed)
            if ($idPersonnage->getRaces() === $this) {
                $idPersonnage->setRaces(null);
            }
        }

        return $this;
    }
}
