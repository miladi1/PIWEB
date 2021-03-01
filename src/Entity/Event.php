<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=TypeEvent::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $titre;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="time")
     */
    private $heure;

    /**
     * @ORM\Column(type="integer")
     */
    private $dure;

    /**
     * @ORM\Column(type="integer")
     */
    private $nomberPar;

    /**
     * @ORM\ManyToOne(targetEntity=employeur::class, inversedBy="events")
     * @ORM\JoinColumn(nullable=false)
     */
    private $EventEmployeur;

    /**
     * @ORM\ManyToMany(targetEntity=employer::class)
     */
    private $EventEmployer;

    public function __construct()
    {
        $this->EventEmployer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?TypeEvent
    {
        return $this->titre;
    }

    public function setTitre(?TypeEvent $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getDure(): ?int
    {
        return $this->dure;
    }

    public function setDure(int $dure): self
    {
        $this->dure = $dure;

        return $this;
    }

    public function getNomberPar(): ?int
    {
        return $this->nomberPar;
    }

    public function setNomberPar(int $nomberPar): self
    {
        $this->nomberPar = $nomberPar;

        return $this;
    }

    public function getEventEmployeur(): ?employeur
    {
        return $this->EventEmployeur;
    }

    public function setEventEmployeur(?employeur $EventEmployeur): self
    {
        $this->EventEmployeur = $EventEmployeur;

        return $this;
    }

    /**
     * @return Collection|employer[]
     */
    public function getEventEmployer(): Collection
    {
        return $this->EventEmployer;
    }

    public function addEventEmployer(employer $eventEmployer): self
    {
        if (!$this->EventEmployer->contains($eventEmployer)) {
            $this->EventEmployer[] = $eventEmployer;
        }

        return $this;
    }

    public function removeEventEmployer(employer $eventEmployer): self
    {
        $this->EventEmployer->removeElement($eventEmployer);

        return $this;
    }
}
