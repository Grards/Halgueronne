<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateursRepository")
 */
class Utilisateurs
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
     * @ORM\Column(type="string", length=75)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mdp;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $rang;

    /**
     * @ORM\Column(type="date")
     */
    private $naissance;

    /**
     * @ORM\Column(type="integer")
     */
    private $messages;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Badges", mappedBy="idUtilisateur", orphanRemoval=true)
     */
    private $badges;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Personnages", mappedBy="idUtilisateur", orphanRemoval=true)
     */
    private $personnages;

    public function __construct()
    {
        $this->badges = new ArrayCollection();
        $this->personnages = new ArrayCollection();
    }

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

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getRang(): ?string
    {
        return $this->rang;
    }

    public function setRang(string $rang): self
    {
        $this->rang = $rang;

        return $this;
    }

    public function getNaissance(): ?\DateTimeInterface
    {
        return $this->naissance;
    }

    public function setNaissance(\DateTimeInterface $naissance): self
    {
        $this->naissance = $naissance;

        return $this;
    }

    public function getMessages(): ?int
    {
        return $this->messages;
    }

    public function setMessages(int $messages): self
    {
        $this->messages = $messages;

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
     * @return Collection|Badges[]
     */
    public function getBadges(): Collection
    {
        return $this->badges;
    }

    public function addBadge(Badges $badge): self
    {
        if (!$this->badges->contains($badge)) {
            $this->badges[] = $badge;
            $badge->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeBadge(Badges $badge): self
    {
        if ($this->badges->contains($badge)) {
            $this->badges->removeElement($badge);
            // set the owning side to null (unless already changed)
            if ($badge->getIdUtilisateur() === $this) {
                $badge->setIdUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Personnages[]
     */
    public function getPersonnages(): Collection
    {
        return $this->personnages;
    }

    public function addPersonnage(Personnages $personnage): self
    {
        if (!$this->personnages->contains($personnage)) {
            $this->personnages[] = $personnage;
            $personnage->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removePersonnage(Personnages $personnage): self
    {
        if ($this->personnages->contains($personnage)) {
            $this->personnages->removeElement($personnage);
            // set the owning side to null (unless already changed)
            if ($personnage->getIdUtilisateur() === $this) {
                $personnage->setIdUtilisateur(null);
            }
        }

        return $this;
    }
}
