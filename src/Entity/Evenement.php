<?php

namespace App\Entity;


use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 * @Vich\Uploadable
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
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     */
    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
    }
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="photo")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;




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

    /**
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string|null $photo
     */
    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }



    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }




}
