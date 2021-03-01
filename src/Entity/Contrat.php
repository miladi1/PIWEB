<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=opportunite::class, inversedBy="contrats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fonction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeContrat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $horaires;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $devise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modeSalaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $periode;

    /**
     * @ORM\Column(type="integer")
     */
    private $annuelMoins;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?opportunite
    {
        return $this->titre;
    }

    public function setTitre(?opportunite $titre): self
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
        return $this->typeContrat;
    }

    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

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

    public function getDevise(): ?string
    {
        return $this->devise;
    }

    public function setDevise(string $devise): self
    {
        $this->devise = $devise;

        return $this;
    }

    public function getModeSalaire(): ?string
    {
        return $this->modeSalaire;
    }

    public function setModeSalaire(string $modeSalaire): self
    {
        $this->modeSalaire = $modeSalaire;

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

    public function getAnnuelMoins(): ?int
    {
        return $this->annuelMoins;
    }

    public function setAnnuelMoins(int $annuelMoins): self
    {
        $this->annuelMoins = $annuelMoins;

        return $this;
    }
}
