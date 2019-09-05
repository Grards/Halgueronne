<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EncyclopediaTopicsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class EncyclopediaTopics
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="smallint")
     */
    private $orderNumber;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visible;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EncyclopediaCategories", inversedBy="encyclopediaTopics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $encyclopediaCategory;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EncyclopediaPosts", mappedBy="encyclopediaTopic", orphanRemoval=true)
     */
    private $encyclopediaPosts;

    public function __construct()
    {
        $this->encyclopediaPosts = new ArrayCollection();
    }

    /**
     * Permet d'initialiser le slug, tant pour les Fixtures que pour le formulaire.
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeSlug() {
        $slugify = new Slugify();
        $this->slug = $slugify->slugify($this->title);
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOrderNumber(): ?int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

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

    public function getEncyclopediaCategory(): ?encyclopediaCategories
    {
        return $this->encyclopediaCategory;
    }

    public function setEncyclopediaCategory(?encyclopediaCategories $encyclopediaCategory): self
    {
        $this->encyclopediaCategory = $encyclopediaCategory;

        return $this;
    }

    /**
     * @return Collection|EncyclopediaPosts[]
     */
    public function getEncyclopediaPosts(): Collection
    {
        return $this->encyclopediaPosts;
    }

    public function addEncyclopediaPost(EncyclopediaPosts $encyclopediaPost): self
    {
        if (!$this->encyclopediaPosts->contains($encyclopediaPost)) {
            $this->encyclopediaPosts[] = $encyclopediaPost;
            $encyclopediaPost->setEncyclopediaTopic($this);
        }

        return $this;
    }

    public function removeEncyclopediaPost(EncyclopediaPosts $encyclopediaPost): self
    {
        if ($this->encyclopediaPosts->contains($encyclopediaPost)) {
            $this->encyclopediaPosts->removeElement($encyclopediaPost);
            // set the owning side to null (unless already changed)
            if ($encyclopediaPost->getEncyclopediaTopic() === $this) {
                $encyclopediaPost->setEncyclopediaTopic(null);
            }
        }

        return $this;
    }
}
