<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EncyclopedieSujetsRepository")
 */
class EncyclopedieSujets
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
     * @ORM\Column(type="smallint")
     */
    private $ordre;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EncyclopedieCategories", inversedBy="encyclopedieSujets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idEnclyclopedieCategorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EncyclopediePosts", mappedBy="idEncyclopedieSujet", orphanRemoval=true)
     */
    private $encyclopediePosts;

    public function __construct()
    {
        $this->encyclopediePosts = new ArrayCollection();
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

    public function getVisible(): ?bool
    {
        return $this->visible;
    }

    public function setVisible(bool $visible): self
    {
        $this->visible = $visible;

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

    public function getIdEnclyclopedieCategorie(): ?EncyclopedieCategories
    {
        return $this->idEnclyclopedieCategorie;
    }

    public function setIdEnclyclopedieCategorie(?EncyclopedieCategories $idEnclyclopedieCategorie): self
    {
        $this->idEnclyclopedieCategorie = $idEnclyclopedieCategorie;

        return $this;
    }

    /**
     * @return Collection|EncyclopediePosts[]
     */
    public function getEncyclopediePosts(): Collection
    {
        return $this->encyclopediePosts;
    }

    public function addEncyclopediePost(EncyclopediePosts $encyclopediePost): self
    {
        if (!$this->encyclopediePosts->contains($encyclopediePost)) {
            $this->encyclopediePosts[] = $encyclopediePost;
            $encyclopediePost->setIdEncyclopedieSujet($this);
        }

        return $this;
    }

    public function removeEncyclopediePost(EncyclopediePosts $encyclopediePost): self
    {
        if ($this->encyclopediePosts->contains($encyclopediePost)) {
            $this->encyclopediePosts->removeElement($encyclopediePost);
            // set the owning side to null (unless already changed)
            if ($encyclopediePost->getIdEncyclopedieSujet() === $this) {
                $encyclopediePost->setIdEncyclopedieSujet(null);
            }
        }

        return $this;
    }
}
