<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonnagesRepository")
 */
class Personnages
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $prenom;

    /**
     * @ORM\Column(type="smallint")
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $portrait;

    /**
     * @ORM\Column(type="text")
     */
    private $biographie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateurs", inversedBy="personnages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUtilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Races", inversedBy="idPersonnage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $races;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classes", inversedBy="idPersonnage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Blessures", inversedBy="idPersonnage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $blessures;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Competences", inversedBy="idPersonnage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $competences;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sorts", inversedBy="idPersonnage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sorts;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getSexe(): ?int
    {
        return $this->sexe;
    }

    public function setSexe(int $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPortrait(): ?string
    {
        return $this->portrait;
    }

    public function setPortrait(?string $portrait): self
    {
        $this->portrait = $portrait;

        return $this;
    }

    public function getBiographie(): ?string
    {
        return $this->biographie;
    }

    public function setBiographie(string $biographie): self
    {
        $this->biographie = $biographie;

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

    public function getIdUtilisateur(): ?Utilisateurs
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(?Utilisateurs $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;

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

    public function getBlessures(): ?Blessures
    {
        return $this->blessures;
    }

    public function setBlessures(?Blessures $blessures): self
    {
        $this->blessures = $blessures;

        return $this;
    }

    public function getCompetences(): ?Competences
    {
        return $this->competences;
    }

    public function setCompetences(?Competences $competences): self
    {
        $this->competences = $competences;

        return $this;
    }

    public function getSorts(): ?Sorts
    {
        return $this->sorts;
    }

    public function setSorts(?Sorts $sorts): self
    {
        $this->sorts = $sorts;

        return $this;
    }
}
