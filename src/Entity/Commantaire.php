<?php

namespace App\Entity;

use App\Repository\CommantaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=CommantaireRepository::class)
 */
class Commantaire
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
    private $contenu;




    /**
     * @var string
     * @Assert\Date
     * @ORM\Column(name="date" ,type="string" ,length=255)
     */
    private $date;


    /**
     *@var int
     * @ORM\Column(type="integer")
     */
    private $comPub;

    /**
     * @var string
     *  @ORM\Column(name="nom" ,type="string" ,length=255)
     */
    private $nom;

    /**
     * Commantaire constructor.
     */
    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
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


    public function getComPub(): ?int
    {
        return $this->comPub;
    }

    public function setComPub($comPub): self
    {
        $this->comPub = $comPub;

        return $this;
    }




}