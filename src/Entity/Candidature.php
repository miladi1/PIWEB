<?php
// src/Entity/Candidature.php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\CandidatureRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

const GENRE2 = ["Développeur web","Ingenieur réseaux","Agent Agriculteur"];
const GENRES3 = ['CDD','CDI','Stage'];
const GENRES4 = ['Temps plein','Temps partiel','Fin de semaine'];

const GENRES5 = ['suivant profil','fixe'];
const GENRES6= ['Annuel','Mois'];
const GENRES7 = ['En cours','Accepter','Refuser'];

/**
 * @ORM\Entity(repositoryClass=CandidatureRepository::class)
 */
class Candidature
{
     
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=opportunite::class)
     * @ORM\JoinColumn(nullable=false)
     
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
    * @Assert\Choice(choices = {"Développeur web", "Ingenieur réseaux", "Agent Agriculteur"})
 
     */
    private $fonction;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Choice(choices = {"CDD","CDI","Stage"})
    
     */
    private $type_contrat;
  /**
     * @ORM\Column(type="string", length=255)
          *  @Assert\Choice(choices = {"Temps plein","Temps partiel","Fin de semaine"})
     */
    private $horaires;
    /**
     * @ORM\Column(type="string", length=255)
     
    
    
     */
    private $mode_salaire;

    /**
     * @ORM\Column(type="string", length=255)
      * @Assert\Choice(choices = {"Annuel", "Mois"})
     */
    private $periode;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $annuel_mois;

   
   

   
    
  

     
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?opportunite
    {
        return $this->titre;
    }

    public function setTitre(?opportunite $titre=null): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
        
    }

    public function setFonction(string $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getTypeContrat(): ?string
    {
        return $this->type_contrat;
    }
    

    public function setTypeContrat(string $type_contrat): self
    {
        $this->type_contrat = $type_contrat;

        return $this;
    }

    public function getModeSalaire(): ?string
    {
        return $this->mode_salaire;
    }

    public function setModeSalaire(string $mode_salaire): self
    {
        $this->mode_salaire = $mode_salaire;

        return $this;
    }

    public function getPeriode(): ?string
    {
        return $this->periode;
    }

    public function setPeriode(string $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getAnnuelMois(): ?string
    {
        return $this->annuel_mois;
    }

    public function setAnnuelMois(string $annuel_mois): self
    {
        $this->annuel_mois = $annuel_mois;

        return $this;
    }

  

   
    public function getHoraires(): ?string
    {
        return $this->horaires;
    }

    public function setHoraires(string $horaires): self
    {
        $this->horaires = $horaires;

        return $this;
    }

    

   

    
}
