<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClassesRepository")
 */
class Classes
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
     * @ORM\OneToMany(targetEntity="App\Entity\Characters", mappedBy="classes", orphanRemoval=true)
     */
    private $characterClasse;

    public function __construct()
    {
        $this->characterClasse = new ArrayCollection();
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
    public function getCharacterClasse(): Collection
    {
        return $this->characterClasse;
    }

    public function addCharacterClasse(Characters $characterClasse): self
    {
        if (!$this->characterClasse->contains($characterClasse)) {
            $this->characterClasse[] = $characterClasse;
            $characterClasse->setClasses($this);
        }

        return $this;
    }

    public function removeCharacterClasse(Characters $characterClasse): self
    {
        if ($this->characterClasse->contains($characterClasse)) {
            $this->characterClasse->removeElement($characterClasse);
            // set the owning side to null (unless already changed)
            if ($characterClasse->getClasses() === $this) {
                $characterClasse->setClasses(null);
            }
        }

        return $this;
    }
}
