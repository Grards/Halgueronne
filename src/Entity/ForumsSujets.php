<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ForumsSujetsRepository")
 */
class ForumsSujets
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
     * @ORM\Column(type="string", length=75)
     */
    private $droitAcces;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ForumsCategories", inversedBy="forumsSujets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idForumCategorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ForumsPosts", mappedBy="idForumSujet", orphanRemoval=true)
     */
    private $forumsPosts;

    public function __construct()
    {
        $this->forumsPosts = new ArrayCollection();
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

    public function getDroitAcces(): ?string
    {
        return $this->droitAcces;
    }

    public function setDroitAcces(string $droitAcces): self
    {
        $this->droitAcces = $droitAcces;

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

    public function getIdForumCategorie(): ?ForumsCategories
    {
        return $this->idForumCategorie;
    }

    public function setIdForumCategorie(?ForumsCategories $idForumCategorie): self
    {
        $this->idForumCategorie = $idForumCategorie;

        return $this;
    }

    /**
     * @return Collection|ForumsPosts[]
     */
    public function getForumsPosts(): Collection
    {
        return $this->forumsPosts;
    }

    public function addForumsPost(ForumsPosts $forumsPost): self
    {
        if (!$this->forumsPosts->contains($forumsPost)) {
            $this->forumsPosts[] = $forumsPost;
            $forumsPost->setIdForumSujet($this);
        }

        return $this;
    }

    public function removeForumsPost(ForumsPosts $forumsPost): self
    {
        if ($this->forumsPosts->contains($forumsPost)) {
            $this->forumsPosts->removeElement($forumsPost);
            // set the owning side to null (unless already changed)
            if ($forumsPost->getIdForumSujet() === $this) {
                $forumsPost->setIdForumSujet(null);
            }
        }

        return $this;
    }
}
