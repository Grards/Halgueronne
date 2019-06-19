<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateursRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields="pseudo", errorPath="pseudo", message="Ce pseudo est déjà utilisé par quelqu'un d'autre")
 * @UniqueEntity(fields="email", errorPath="email", message="Cette adresse email est déjà utilisée")
 * @UniqueEntity(fields="slug", errorPath="slug", message="Ce slug existe déjà")
 * )
 */
class Utilisateurs implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=75)
     * @Assert\Length(min=3, max=75, minMessage="Votre pseudonyme doit faire au minimum 3 caractères", maxMessage="Votre pseudonyme doit faire au maximum 75 caractères")
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=6, max=255, minMessage="Votre mot de passe doit faire au minimum 6 caractères", maxMessage="Votre mot de passe doit faire au maximum 255 caractères")
     */
    private $mdp;

    /** 
     * @Assert\EqualTo(propertyPath="mdp", message="Vous n'avez pas correctement confirmé votre mot de passe") 
     */ 
    public $mdpConfirm;

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
     * @ORM\Column(type="integer")
     */
    private $messages;

    /**
     * @ORM\Column(type="string", length=255)
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
        $this->slug = $slugify->slugify($this->pseudo);
    }

    /**
     * Permet d'intialiser le nombre de messages à 0 lors de la création de l'utilisateur
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeMessages() {
        if(empty($this->messages)) {
            $this->messages = 0;
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

    public function getId(): ?int
    {
        return $this->id;
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
     * Ajout de la partie sécurité
     */

    public function getRoles(){
        return ['ROLE_USER'];
    }

    public function getPassword(){
        return $this->mdp;
    }

    public function getSalt(){}

    public function getUsername(){
        return $this->pseudo;
    }

    public function eraseCredentials(){}
}
