<?php

namespace App\Entity;

use App\Repository\ReunionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReunionRepository::class)
 */
class Reunion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryReunion::class, inversedBy="reunions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $heure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lienMeet;

    /**
     * @ORM\ManyToOne(targetEntity=employeur::class, inversedBy="reunions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rnEmployeur;

    /**
     * @ORM\ManyToOne(targetEntity=employer::class, inversedBy="reunions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rnEmployer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?CategoryReunion
    {
        return $this->titre;
    }

    public function setTitre(?CategoryReunion $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?string
    {
        return $this->heure;
    }

    public function setHeure(string $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getLienMeet(): ?string
    {
        return $this->lienMeet;
    }

    public function setLienMeet(string $lienMeet): self
    {
        $this->lienMeet = $lienMeet;

        return $this;
    }

    public function getRnEmployeur(): ?employeur
    {
        return $this->rnEmployeur;
    }

    public function setRnEmployeur(?employeur $rnEmployeur): self
    {
        $this->rnEmployeur = $rnEmployeur;

        return $this;
    }

    public function getRnEmployer(): ?employer
    {
        return $this->rnEmployer;
    }

    public function setRnEmployer(?employer $rnEmployer): self
    {
        $this->rnEmployer = $rnEmployer;

        return $this;
    }
}
