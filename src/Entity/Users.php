<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields="login", errorPath="login", message="This login already exists !")
 * @UniqueEntity(fields="mail", errorPath="mail", message="This mail address already exists !")
 * @UniqueEntity(fields="slug", errorPath="slug", message="This slug already exists !")
 * )
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $posts;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

/**
     * Permet d'intialiser le slug, tant pour les Fixtures que pour le formulaire (on réédite le slug par dessus la valeur de base donnée par défaut)
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

    public function getPosts(): ?int
    {
        return $this->posts;
    }

    public function setPosts(int $posts): self
    {
        $this->posts = $posts;

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
     * Ajout de la partie sécurité
     */

    public function getRoles(){
        return ['ROLE_USER'];
    }

    public function getSalt(){}

    public function getUsername(){
        return $this->login;
    }

    public function eraseCredentials(){}
}
