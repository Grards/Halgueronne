<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @Assert\Length(min=3, max=75, minMessage="Le nom doit faire au minimum 3 caractères", maxMessage="Le nom ne peut pas faire plus de 75 caractères")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=75)
     * @Assert\Length(min=3, max=75, minMessage="Le prénom doit faire au minimum 3 caractères", maxMessage="Le prénom ne peut pas faire plus de 75 caractères")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\Url
     *      message = "L'url '{{ value }}' n'est une url valide"
     */
    private $picture;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     * @Assert\Range(
     *      min = 1,
     *      max = 31,
     *      minMessage = "Le jours sont compris entre 1 et 31",
     *      maxMessage = "Le jours sont compris entre 1 et 31"
     * )
     */
    private $birthDay;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     * @Assert\Range(
     *      min = 1,
     *      max = 12,
     *      minMessage = "Les mois sont compris entre 1 et 12",
     *      maxMessage = "Les mois sont compris entre 1 et 12"
     * )
     */
    private $birthMonth;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     * @Assert\Range(
     *      min = 1100,
     *      max = 1120,
     *      minMessage = "Il vous faut choisir entre les années 1100 et 1120",
     *      maxMessage = "Il vous faut choisir entre les années 1100 et 1120"
     * )
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
     * @Assert\Unique
     *      message = "Ce personnage existe déjà"
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="characters")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Races", inversedBy="characterRace")
     * @ORM\JoinColumn(nullable=false)
     */
    private $races;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classes", inversedBy="characterClasse")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Injuries", mappedBy="characterInjury")
     */
    private $injuries;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Skills", mappedBy="characterSkill")
     */
    private $skills;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Spells", mappedBy="characterSpell")
     */
    private $spells;

    public function __construct()
    {
        $this->injuries = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->spells = new ArrayCollection();
    }

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

    public function getRaces(): ?Races
    {
        return $this->races;
    }

    public function setRaces(?Races $races): self
    {
        $this->races = $races;

        return $this;
    }

    public function getClasses(): ?Classes
    {
        return $this->classes;
    }

    public function setClasses(?Classes $classes): self
    {
        $this->classes = $classes;

        return $this;
    }

    /**
     * @return Collection|Injuries[]
     */
    public function getInjuries(): Collection
    {
        return $this->injuries;
    }

    public function addInjury(Injuries $injury): self
    {
        if (!$this->injuries->contains($injury)) {
            $this->injuries[] = $injury;
            $injury->addCharacterInjury($this);
        }

        return $this;
    }

    public function removeInjury(Injuries $injury): self
    {
        if ($this->injuries->contains($injury)) {
            $this->injuries->removeElement($injury);
            $injury->removeCharacterInjury($this);
        }

        return $this;
    }

    /**
     * @return Collection|Skills[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skills $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->addCharacterSkill($this);
        }

        return $this;
    }

    public function removeSkill(Skills $skill): self
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
            $skill->removeCharacterSkill($this);
        }

        return $this;
    }

    /**
     * @return Collection|Spells[]
     */
    public function getSpells(): Collection
    {
        return $this->spells;
    }

    public function addSpell(Spells $spell): self
    {
        if (!$this->spells->contains($spell)) {
            $this->spells[] = $spell;
            $spell->addCharacterSpell($this);
        }

        return $this;
    }

    public function removeSpell(Spells $spell): self
    {
        if ($this->spells->contains($spell)) {
            $this->spells->removeElement($spell);
            $spell->removeCharacterSpell($this);
        }

        return $this;
    }
}
