<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PassportStampRepository")
 */
class PassportStamp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfDeparture;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfArrival;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Passport", inversedBy="passportStamp")
     * @ORM\JoinColumn(nullable=false)
     */
    private $passport;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOfDeparture(): ?\DateTimeInterface
    {
        return $this->dateOfDeparture;
    }

    public function setDateOfDeparture(\DateTimeInterface $dateOfDeparture): self
    {
        $this->dateOfDeparture = $dateOfDeparture;

        return $this;
    }

    public function getDateOfArrival(): ?\DateTimeInterface
    {
        return $this->dateOfArrival;
    }

    public function setDateOfArrival(\DateTimeInterface $dateOfArrival): self
    {
        $this->dateOfArrival = $dateOfArrival;

        return $this;
    }

    public function getPassport(): ?Passport
    {
        return $this->passport;
    }

    public function setPassport(?Passport $passport): self
    {
        $this->passport = $passport;

        return $this;
    }
}
