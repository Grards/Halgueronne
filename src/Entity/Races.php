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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Characters", mappedBy="races", orphanRemoval=true)
     */
    private $characterRace;

    public function __construct()
    {
        $this->characterRace = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|Characters[]
     */
    public function getCharacterRace(): Collection
    {
        return $this->characterRace;
    }

    public function addCharacterRace(Characters $characterRace): self
    {
        if (!$this->characterRace->contains($characterRace)) {
            $this->characterRace[] = $characterRace;
            $characterRace->setRaces($this);
        }

        return $this;
    }

    public function removeCharacterRace(Characters $characterRace): self
    {
        if ($this->characterRace->contains($characterRace)) {
            $this->characterRace->removeElement($characterRace);
            // set the owning side to null (unless already changed)
            if ($characterRace->getRaces() === $this) {
                $characterRace->setRaces(null);
            }
        }

        return $this;
    }
}
