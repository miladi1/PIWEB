<?php

namespace App\Entity;

use App\Repository\ParticipationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ParticipationRepository::class)
 */
class Participation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;





    /**
     * @ORM\Column(type="string")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $idEmployer;

    /**
     * @ORM\Column(type="integer")
     */
    private $idEvent;



    public function getId(): ?int
    {
        return $this->id;
    }



    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getIdEmployer(): ?string
    {
        return $this->idEmployer;
    }

    public function setIdEmployer(string $idEmployer): self
    {
        $this->idEmployer = $idEmployer;

        return $this;
    }

    public function getIdEvent(): ?int
    {
        return $this->idEvent;
    }

    public function setIdEvent(int $idEvent): self
    {
        $this->idEvent = $idEvent;

        return $this;
    }


}
