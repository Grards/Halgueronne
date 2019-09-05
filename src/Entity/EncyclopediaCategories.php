<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EncyclopediaCategoriesRepository")
 * @ORM\HasLifecycleCallbacks
 */
class EncyclopediaCategories
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
     * @ORM\Column(type="string", length=255)
     */
    private $cover;

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
     * @ORM\OneToMany(targetEntity="App\Entity\EncyclopediaTopics", mappedBy="encyclopediaCategory", orphanRemoval=true)
     */
    private $encyclopediaTopics;

    public function __construct()
    {
        $this->encyclopediaTopics = new ArrayCollection();
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

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

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

    /**
     * @return Collection|EncyclopediaTopics[]
     */
    public function getEncyclopediaTopics(): Collection
    {
        return $this->encyclopediaTopics;
    }

    public function addEncyclopediaTopic(EncyclopediaTopics $encyclopediaTopic): self
    {
        if (!$this->encyclopediaTopics->contains($encyclopediaTopic)) {
            $this->encyclopediaTopics[] = $encyclopediaTopic;
            $encyclopediaTopic->setEncyclopediaCategory($this);
        }

        return $this;
    }

    public function removeEncyclopediaTopic(EncyclopediaTopics $encyclopediaTopic): self
    {
        if ($this->encyclopediaTopics->contains($encyclopediaTopic)) {
            $this->encyclopediaTopics->removeElement($encyclopediaTopic);
            // set the owning side to null (unless already changed)
            if ($encyclopediaTopic->getEncyclopediaCategory() === $this) {
                $encyclopediaTopic->setEncyclopediaCategory(null);
            }
        }

        return $this;
    }
}
