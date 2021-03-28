<?php

namespace App\Entity;

use App\Repository\EmployeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeurRepository::class)
 */
class employeur
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
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity=Opportunite::class, mappedBy="opemployeur", orphanRemoval=true)
     */
    private $opportunites;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="Eventemployeur")
     */
    private $events;

    /**
     * @ORM\OneToMany(targetEntity=Reunion::class, mappedBy="rnemployeur")
     */
    private $reunions;

    /**
     * @ORM\ManyToMany(targetEntity=Publication::class, mappedBy="pubemployeur")
     */
    private $publications;

    public function __construct()
    {
        $this->opportunites = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->reunions = new ArrayCollection();
        $this->publications = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Collection|Opportunite[]
     */
    public function getOpportunites(): Collection
    {
        return $this->opportunites;
    }

    public function addOpportunite(Opportunite $opportunite): self
    {
        if (!$this->opportunites->contains($opportunite)) {
            $this->opportunites[] = $opportunite;
            $opportunite->setOpemployeur($this);
        }

        return $this;
    }

    public function removeOpportunite(Opportunite $opportunite): self
    {
        if ($this->opportunites->removeElement($opportunite)) {
            // set the owning side to null (unless already changed)
            if ($opportunite->getOpEmployeur() === $this) {
                $opportunite->setOpEmployeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->setEventEmployeur($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getEventEmployeur() === $this) {
                $event->setEventEmployeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reunion[]
     */
    public function getReunions(): Collection
    {
        return $this->reunions;
    }

    public function addReunion(Reunion $reunion): self
    {
        if (!$this->reunions->contains($reunion)) {
            $this->reunions[] = $reunion;
            $reunion->setRnemployeur($this);
        }

        return $this;
    }

    public function removeReunion(Reunion $reunion): self
    {
        if ($this->reunions->removeElement($reunion)) {
            // set the owning side to null (unless already changed)
            if ($reunion->getRnemployeur() === $this) {
                $reunion->setRnemployeur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Publication[]
     */
    public function getPublications(): Collection
    {
        return $this->publications;
    }

    public function addPublication(Publication $publication): self
    {
        if (!$this->publications->contains($publication)) {
            $this->publications[] = $publication;
            $publication->addPubemployeur($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): self
    {
        if ($this->publications->removeElement($publication)) {
            $publication->removePubemployeur($this);
        }

        return $this;
    }
}
