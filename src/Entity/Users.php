<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields="login", errorPath="login", message="Cet utilisateur existe déjà.")
 * @UniqueEntity(fields="mail", errorPath="mail", message="Cet email est déjà utilisé.")
 * @UniqueEntity(fields="slug", errorPath="slug", message="Ce slug existe déjà.")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=75)
     * @Assert\Length(min=3, max=75, minMessage="Your login must be at least 3 characters long", maxMessage="Your login must be at most 75 characters")
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=6, max=75, minMessage="Your password must be at least 6 characters long", maxMessage="Your password address must be at most 75 characters")
     */
    private $password;

    /** 
     * @Assert\EqualTo(propertyPath="password", message="You have not correctly confirmed your password") 
     */ 
    public $passwordConfirm;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=75, nullable=true)
     */
    private $role;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Characters", mappedBy="user", orphanRemoval=true)
     */
    private $characters;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EncyclopediaPosts", mappedBy="author", orphanRemoval=true)
     */
    private $encyclopediaPosts;

    /**
     * @ORM\Column(type="datetime")
     */
    private $inscriptionDate;

    /**
     * @ORM\Column(type="string", length=75)
     */
    private $timeZone;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
        $this->encyclopediaPosts = new ArrayCollection();

        /**
         * La DateTime enregistrée dans la base de données est en heure UTC, en regard de la config du server et de PHP, configurés en heure UTC.
         * Cette heure commune sera convertie à l'affichage pour les différents utilisateurs, selon leur TimeZone.
         * Par défaut, on place la timeZone sur Paris.
         * https://blog.elao.com/fr/dev/date-php-timezone-utc-pourquoi-est-ce-important/
         */ 
        
        $this->inscriptionDate = new \DateTime();
        $this->timeZone = 'Europe/Paris';
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
        $this->slug = $slugify->slugify($this->login);
    }

    /**
     * Permet d'intialiser le nombre de messages à 0 lors de la création de l'utilisateur
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializePosts() {
        if(empty($this->posts)) {
            $this->posts = 0;
        }
    }

    /**
     * Permet d'intialiser un avatar par défaut si aucun n'a été fourni au moment de la création de compte.
     * Par défaut, les ressources sont recherchées depuis le dossier "public".
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeAvatar() {
        if(empty($this->avatar)) {
            $this->avatar = 'img/no-avatar.png';
        }
    }

    /**
     * Permet d'intialiser un rôle par défaut si aucun n'a été fourni au moment de la création de compte.
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeRole() {
        if(empty($this->role)) {
            $this->role = 'ROLE_USER';
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

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
     * @return Collection|Characters[]
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Characters $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters[] = $character;
            $character->setUser($this);
        }

        return $this;
    }

    public function removeCharacter(Characters $character): self
    {
        if ($this->characters->contains($character)) {
            $this->characters->removeElement($character);
            // set the owning side to null (unless already changed)
            if ($character->getUser() === $this) {
                $character->setUser(null);
            }
        }

        return $this;
    }

     /**
     * Ajout de la partie sécurité
     */

    public function getRoles(){
        if($this->role=="ROLE_ADMIN"){
            $roles[]=$this->role;
           $roles[] = 'ROLE_USER';
         }else{
             $roles[]=$this->role;
         }
         return $roles;
    }

    public function getSalt(){}

    public function getUsername(){
        return $this->login;
    }

    public function eraseCredentials(){}

    
    public function getPosts(): ?int
    {
        return $this->posts;
    }

    public function setPosts(int $posts): self
    {
        $this->posts = $posts;

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
            $encyclopediaPost->setAuthor($this);
        }

        return $this;
    }

    public function removeEncyclopediaPost(EncyclopediaPosts $encyclopediaPost): self
    {
        if ($this->encyclopediaPosts->contains($encyclopediaPost)) {
            $this->encyclopediaPosts->removeElement($encyclopediaPost);
            // set the owning side to null (unless already changed)
            if ($encyclopediaPost->getAuthor() === $this) {
                $encyclopediaPost->setAuthor(null);
            }
        }

        return $this;
    }

    public function getInscriptionDate(): ?\DateTimeInterface
    {
        return $this->inscriptionDate;
    }

    public function setInscriptionDate(\DateTimeInterface $inscriptionDate): self
    {
        $this->inscriptionDate = $inscriptionDate;

        return $this;
    }

    public function getTimeZone(): ?string
    {
        return $this->timeZone;
    }

    public function setTimeZone(string $timeZone): self
    {
        $this->timeZone = $timeZone;

        return $this;
    }
}
