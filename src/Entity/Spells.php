<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpellsRepository")
 */
class Spells
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Characters", inversedBy="spells")
     */
    private $characterSpell;

    public function __construct()
    {
        $this->characterSpell = new ArrayCollection();
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
    public function getCharacterSpell(): Collection
    {
        return $this->characterSpell;
    }

    public function addCharacterSpell(Characters $characterSpell): self
    {
        if (!$this->characterSpell->contains($characterSpell)) {
            $this->characterSpell[] = $characterSpell;
        }

        return $this;
    }

    public function removeCharacterSpell(Characters $characterSpell): self
    {
        if ($this->characterSpell->contains($characterSpell)) {
            $this->characterSpell->removeElement($characterSpell);
        }

        return $this;
    }
}
