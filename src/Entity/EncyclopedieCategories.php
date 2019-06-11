<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EncyclopedieCategoriesRepository")
 */
class EncyclopedieCategories
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couverture;

    /**
     * @ORM\Column(type="smallint")
     */
    private $ordre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $droitAcces;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EncyclopedieSujets", mappedBy="idEnclyclopedieCategorie", orphanRemoval=true)
     */
    private $encyclopedieSujets;

    public function __construct()
    {
        $this->encyclopedieSujets = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCouverture(): ?string
    {
        return $this->couverture;
    }

    public function setCouverture(string $couverture): self
    {
        $this->couverture = $couverture;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDroitAcces(): ?string
    {
        return $this->droitAcces;
    }

    public function setDroitAcces(string $droitAcces): self
    {
        $this->droitAcces = $droitAcces;

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

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * @return Collection|EncyclopedieSujets[]
     */
    public function getEncyclopedieSujets(): Collection
    {
        return $this->encyclopedieSujets;
    }

    public function addEncyclopedieSujet(EncyclopedieSujets $encyclopedieSujet): self
    {
        if (!$this->encyclopedieSujets->contains($encyclopedieSujet)) {
            $this->encyclopedieSujets[] = $encyclopedieSujet;
            $encyclopedieSujet->setIdEnclyclopedieCategorie($this);
        }

        return $this;
    }

    public function removeEncyclopedieSujet(EncyclopedieSujets $encyclopedieSujet): self
    {
        if ($this->encyclopedieSujets->contains($encyclopedieSujet)) {
            $this->encyclopedieSujets->removeElement($encyclopedieSujet);
            // set the owning side to null (unless already changed)
            if ($encyclopedieSujet->getIdEnclyclopedieCategorie() === $this) {
                $encyclopedieSujet->setIdEnclyclopedieCategorie(null);
            }
        }

        return $this;
    }
}
