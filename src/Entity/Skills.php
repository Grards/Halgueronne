<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SkillsRepository")
 */
class Skills
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Characters", inversedBy="skills")
     */
    private $characterSkill;

    public function __construct()
    {
        $this->characterSkill = new ArrayCollection();
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
    public function getCharacterSkill(): Collection
    {
        return $this->characterSkill;
    }

    public function addCharacterSkill(Characters $characterSkill): self
    {
        if (!$this->characterSkill->contains($characterSkill)) {
            $this->characterSkill[] = $characterSkill;
        }

        return $this;
    }

    public function removeCharacterSkill(Characters $characterSkill): self
    {
        if ($this->characterSkill->contains($characterSkill)) {
            $this->characterSkill->removeElement($characterSkill);
        }

        return $this;
    }
}
