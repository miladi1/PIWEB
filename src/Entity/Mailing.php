<?php

namespace App\Entity;

use App\Repository\MailingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MailingRepository::class)
 */
class Mailing
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
    private $sujet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=employer::class)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ref;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    

  

  
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getNumero(): ?employer
    {
        return $this->numero;
    }

    public function setNumero(?employer $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

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

     

   
 

     
}
