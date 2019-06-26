<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CharactersRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Characters
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
    private $lastname;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $birthDay;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $birthMonth;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $birthYear;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $deathDay;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $deathMonth;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $deathYear;

    /**
     * @ORM\Column(type="text")
     */
    private $background;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="characters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    /**
     * Permet d'intialiser le slug, tant pour les Fixtures que pour le formulaire.
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeSlug() {
        $slugify = new Slugify();
        $this->slug = $slugify->slugify($this->firstname."-".$this->lastname);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

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

    public function getBirthDay(): ?int
    {
        return $this->birthDay;
    }

    public function setBirthDay(?int $birthDay): self
    {
        $this->birthDay = $birthDay;

        return $this;
    }

    public function getBirthMonth(): ?int
    {
        return $this->birthMonth;
    }

    public function setBirthMonth(?int $birthMonth): self
    {
        $this->birthMonth = $birthMonth;

        return $this;
    }

    public function getBirthYear(): ?int
    {
        return $this->birthYear;
    }

    public function setBirthYear(?int $birthYear): self
    {
        $this->birthYear = $birthYear;

        return $this;
    }

    public function getDeathDay(): ?int
    {
        return $this->deathDay;
    }

    public function setDeathDay(?int $deathDay): self
    {
        $this->deathDay = $deathDay;

        return $this;
    }

    public function getDeathMonth(): ?int
    {
        return $this->deathMonth;
    }

    public function setDeathMonth(?int $deathMonth): self
    {
        $this->deathMonth = $deathMonth;

        return $this;
    }

    public function getDeathYear(): ?int
    {
        return $this->deathYear;
    }

    public function setDeathYear(?int $deathYear): self
    {
        $this->deathYear = $deathYear;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(string $background): self
    {
        $this->background = $background;

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

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): self
    {
        $this->user = $user;

        return $this;
    }
}
