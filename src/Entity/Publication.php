<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PublicationRepository::class)
 */
class Publication
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $likes;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreCom;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryPublication::class, inversedBy="publications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Categorie;

    /**
     * @ORM\OneToMany(targetEntity=Commantaire::class, mappedBy="comPub")
     */
    private $commantaires;

    public function __construct()
    {
        $this->commantaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getVus(): ?string
    {
        return $this->vus;
    }

    public function setVus(string $vus): self
    {
        $this->vus = $vus;

        return $this;
    }

    public function getLikes(): ?string
    {
        return $this->likes;
    }

    public function setLikes(string $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function getNombreCom(): ?int
    {
        return $this->nombreCom;
    }

    public function setNombreCom(int $nombreCom): self
    {
        $this->nombreCom = $nombreCom;

        return $this;
    }

    public function getCategorie(): ?CategoryPublication
    {
        return $this->Categorie;
    }

    public function setCategorie(?CategoryPublication $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    /**
     * @return Collection|Commantaire[]
     */
    public function getCommantaires(): Collection
    {
        return $this->commantaires;
    }

    public function addCommantaire(Commantaire $commantaire): self
    {
        if (!$this->commantaires->contains($commantaire)) {
            $this->commantaires[] = $commantaire;
            $commantaire->setComPub($this);
        }

        return $this;
    }

    public function removeCommantaire(Commantaire $commantaire): self
    {
        if ($this->commantaires->removeElement($commantaire)) {
            // set the owning side to null (unless already changed)
            if ($commantaire->getComPub() === $this) {
                $commantaire->setComPub(null);
            }
        }

        return $this;
    }
}
