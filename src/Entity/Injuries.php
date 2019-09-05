<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InjuriesRepository")
 */
class Injuries
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Characters", inversedBy="injuries")
     */
    private $characterInjury;

    public function __construct()
    {
        $this->characterInjury = new ArrayCollection();
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
    public function getCharacterInjury(): Collection
    {
        return $this->characterInjury;
    }

    public function addCharacterInjury(Characters $characterInjury): self
    {
        if (!$this->characterInjury->contains($characterInjury)) {
            $this->characterInjury[] = $characterInjury;
        }

        return $this;
    }

    public function removeCharacterInjury(Characters $characterInjury): self
    {
        if ($this->characterInjury->contains($characterInjury)) {
            $this->characterInjury->removeElement($characterInjury);
        }

        return $this;
    }
}
