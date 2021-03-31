<?php

namespace App\Entity;

use App\Repository\OpportuniteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=OpportuniteRepository::class)
 */

class opportunite
{
    const GENRES = ['Employeur','Agence de recrutement'];
    const GENRES2 = ['journale','affiche pub'];
    const GENRES3 = ['1-49','50-99','superieur à 100'];
    const GENRES4 = ['Agriculture','Informatique'];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(choices=opportunite::GENRES4, message="Choose a valid Title")
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Employeur::class, inversedBy="opportunites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $opEmployeur;

    /**
     * @ORM\OneToMany(targetEntity=Contrat::class, mappedBy="titre")
     */
    private $contrats;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_entreprise;

    /**
     * @ORM\Column(type="string", length=110)
     *  @Assert\Choice(choices=opportunite::GENRES3, message="Choose a valid company size !!!")
     */
    private $taille_entreprise;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Choice(choices=opportunite::GENRES, message="Choose a valid Post!!!!!")

     */
    private $poste;

    /**
     * @ORM\Column(type="string", length=255)
    * @Assert\Choice(choices=opportunite::GENRES2, message="Choose a valid media")
     */
    private $media;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_recrutement;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please upload image")
    
     */
    private $logo;
  /**
     * @ORM\Column(type="string", length=255)
     */
     
    private $fonction;

    public function __construct()
    {
        $this->contrats = new ArrayCollection();
        $this->fonction = new ArrayCollection();
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

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

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

    public function getOpEmployeur(): ?Employeur
    {
        return $this->opEmployeur;
    }

    public function setOpEmployeur(?Employeur $opEmployeur): self
    {
        $this->opEmployeur = $opEmployeur;

        return $this;
    }

    /**
     * @return Collection|Contrat[]
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats[] = $contrat;
            $contrat->setTitre($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getTitre() === $this) {
                $contrat->setTitre(null);
            }
        }

        return $this;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->nom_entreprise;
    }

    public function setNomEntreprise(string $nom_entreprise): self
    {
        $this->nom_entreprise = $nom_entreprise;

        return $this;
    }

    public function getTailleEntreprise(): ?string
    {
        return $this->taille_entreprise;
    }

    public function setTailleEntreprise(string $taille_entreprise): self
    {
        $this->taille_entreprise = $taille_entreprise;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getMedia(): ?string
    {
        return $this->media;
    }

    public function setMedia(string $media): self
    {
        $this->media = $media;

        return $this;
    }

    public function getNombreRecrutement(): ?int
    {
        return $this->nombre_recrutement;
    }

    public function setNombreRecrutement(int $nombre_recrutement): self
    {
        $this->nombre_recrutement = $nombre_recrutement;

        return $this;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection|Candidature[]
     */
    public function getFonction(): Collection
    {
        return $this->fonction;
    }

    public function addFonction(Candidature $fonction): self
    {
        if (!$this->fonction->contains($fonction)) {
            $this->fonction[] = $fonction;
            $fonction->setTitre($this);
        }

        return $this;
    }

    public function removeFonction(Candidature $fonction): self
    {
        if ($this->fonction->removeElement($fonction)) {
            // set the owning side to null (unless already changed)
            if ($fonction->getTitre() === $this) {
                $fonction->setTitre(null);
            }
        }

        return $this;
    }
}
