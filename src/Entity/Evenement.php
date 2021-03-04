<?php

namespace App\Entity;


use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *@Assert\NotBlank()
     * @Assert\Length(min="5")
     * @Assert\Regex(pattern="/^[a-zA-Z\s]+$/")
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @Assert\GreaterThan("now")
     *@ORM\Column(type="datetime")
     */
    private $date_start;


    /**
     * @Assert\GreaterThan("+1 hours")
     * @Assert\GreaterThan(propertyPath="date_start")
     * @ORM\Column(type="datetime")
     */
    private $date_end;

    /**
     * @Assert\Range(
     *      min = 10,
     *      max = 100,
     *      notInRangeMessage = "must be between {{ min }} and {{ max }} participants to enter",
     * )
     * @ORM\Column(type="integer")
     */
    private $nombrePar;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Employeur::class, inversedBy="evenements")
     */
    private $employeurEvent;



    /**
     * @ORM\ManyToOne(targetEntity=TypeEvent::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;


    /**
     * Evenement constructor.
     * @param $date_start
     * @param $date_end
     */
    public function __construct($date_start, $date_end)
    {
        $this->date_start = $date_start;
        $this->date_end = $date_end;

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


    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->date_start;
    }

    public function setDateStart(\DateTimeInterface $date_start): self
    {
        $this->date_start = $date_start;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function getNombrePar(): ?int
    {
        return $this->nombrePar;
    }

    public function setNombrePar(int $nombrePar): self
    {
        $this->nombrePar = $nombrePar;

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

    public function getEmployeurEvent(): ?Employeur
    {
        return $this->employeurEvent;
    }

    public function setEmployeurEvent(?Employeur $employeurEvent): self
    {
        $this->employeurEvent = $employeurEvent;

        return $this;
    }


    public function getType(): ?TypeEvent
    {
        return $this->type;
    }

    public function setType(?TypeEvent $type): self
    {
        $this->type = $type;

        return $this;
    }


}
