<?php

namespace App\Entity;

use App\Repository\EmployeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=EmployeurRepository::class)
 * * @UniqueEntity(
 *     fields={"adresse"},
 *     message="L'email que vous avez indiqué est géja utiliser !"
 * )
 */
class Employeur implements UserInterface
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\Length(min="8" , minMessage="Votre Mot de Passe doit faire minimum 8 caractères")
     * @Assert\EqualTo(propertyPath="cp", message="Vous n'avez pas Tapez le meme Mot de Passe" )
     */
    private $pass;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive(message="le contenu doit être positive")
     * @Assert\Length(min="8")
     *
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $loca;

    /**
     * @ORM\OneToMany(targetEntity=Employer::class, mappedBy="Employeur")
     */
    private $relation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logo;
    /**
     *@Assert\EqualTo(propertyPath="pass" , message="Vous n'avez pas Tapez le meme Mot de Passe" )
     */
    public $cp;


    /**
     * @return mixed
     */




    protected $captcha;



    public function __construct()
    {
        $this->relation = new ArrayCollection();


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

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setPass(string $pass): self
    {
        $this->pass = $pass;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }
    public function getEmail(): ?string
    {
        return $this->adresse;
    }
    public function setEmail(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLoca(): ?string
    {
        return $this->loca;
    }

    public function setLoca(string $loca): self
    {
        $this->loca = $loca;

        return $this;
    }

    /**
     * @return Collection|Employer[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Employer $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
            $relation->setEmployeur($this);
        }

        return $this;
    }

    public function removeRelation(Employer $relation): self
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getEmployeur() === $this) {
                $relation->setEmployeur(null);
            }
        }

        return $this;
    }
    public function eraseCredentials(){}
    public function getSalt(){}
    public function getName()
    {
        return $this->nom;
    }

    public function getRoles()
    {
        return ['ROLE_Employeur'];
    }
    public function getPassword(): ?string
    {
        return $this->pass;
    }
    public function setPassword($pass): self
    {
        $this->pass = $pass;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->adresse;
    }
    public function setUsername(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo): self
    {
        $this->logo = $logo;

        return $this;
    }
    public function getCaptcha()
    {
        return $this->captcha;
    }

    public function setCaptcha($captcha)
    {
        $this->captcha = $captcha;
    }

    public function __toString(): string
    {
        return $this->nom;
    }
}