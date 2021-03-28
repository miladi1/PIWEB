<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


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
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     * @Assert\Regex(pattern="/^[a-zA-Z\s]+$/")
     * @ORM\Column(name="titre",type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)++++++
     */
    private $description;

    /**
     * @Assert\Range(
     *      min = 0,
     *      max = 5000,
     *      notInRangeMessage = "must be between {{ min }} and {{ max }} vus to enter",
     * )
     * @ORM\Column(type="integer")
     */
    private $vus;

    /**
     * @Assert\Range(
     *      min = 0,
     *      max = 50000,
     *      notInRangeMessage = "must be between {{ min }} and {{ max }} likes to enter",
     * )
     * @ORM\Column(type="integer")
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

    /**
     * @ORM\ManyToMany(targetEntity=employeur::class, inversedBy="publications")
     */
    private $pubEmployeur;

    /**
     * @var string
     * @Assert\Date
     * @ORM\Column(name="date" ,type="string" ,length=255)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img;

    /**
     * Publication constructor.
     * @param $date
     */
    public function __construct()
    {
        $this->commantaires = new ArrayCollection();
        $this->pubEmployeur = new ArrayCollection();

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


    public function getVus(): ?int
    {
        return $this->vus;
    }

    public function setVus(int $vus): self
    {
        $this->vus = $vus;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): self
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

    /**
     * @return Collection|employeur[]
     */
    public function getPubEmployeur(): Collection
    {
        return $this->pubEmployeur;
    }

    public function addPubEmployeur(employeur $pubEmployeur): self
    {
        if (!$this->pubEmployeur->contains($pubEmployeur)) {
            $this->pubEmployeur[] = $pubEmployeur;
        }

        return $this;
    }

    public function removePubEmployeur(employeur $pubEmployeur): self
    {
        $this->pubEmployeur->removeElement($pubEmployeur);

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate($date): self
    {

        $this->date = $date;

        return $this;
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
































