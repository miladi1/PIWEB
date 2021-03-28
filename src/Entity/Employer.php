<?php

namespace App\Entity;

use App\Repository\EmployerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=EmployerRepository::class)
 * @UniqueEntity(
 *     fields={"mail"},
 *     message="L'email que vous avez indiqué est géja utiliser !"
 * )
 */
class Employer implements UserInterface
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8" , minMessage="Votre Mot de Passe doit faire minimum 8 caractères")
     * @Assert\EqualTo(propertyPath="confirm_password", message="Vous n'avez pas Tapez le meme Mot de Passe" )
     */
    private $mdp;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $mail;

    /**
     * @ORM\Column(type="integer")
     */
    private $num;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localisation;


    /**
     * @ORM\ManyToOne(targetEntity=Employeur::class, inversedBy="relation")
     */
    private $employeur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categorie;


    /**
     * @Assert\EqualTo(propertyPath="mdp" , message="Vous n'avez pas Tapez le meme Mot de Passe" )
     */

    public $confirm_password;
    protected $captchaCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img;



    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getmail(): ?string
    {
        return $this->mail;
    }


    public function getEmail(): ?string
    {
        return $this->mail;
    }

    public function setmail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function setEmail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }


    public function getEmployeur(): ?Employeur
    {
        return $this->employeur;
    }

    public function setEmployeur(?Employeur $employeur): self
    {
        $this->employeur = $employeur;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function eraseCredentials()
    {
    }

    public function getSalt()
    {
    }

    public function getRoles()
    {
        return ['ROLE_Employer'];
    }

    public function getPassword(): ?string
    {
        return $this->mdp;
    }

    public function setPassword($mdp): self
    {
        $this->mdp = $mdp;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->mail;
    }

    public function setUsername(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }



}
