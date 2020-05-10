<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisaRepository")
 */
class Visa
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFrom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateTo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Passport", inversedBy="visas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $passport;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PassportStamp", mappedBy="visa")
     */
    private $passportStamp;

    public function __construct()
    {
        $this->passportStamp = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFrom(): ?\DateTimeInterface
    {
        return $this->dateFrom;
    }

    public function setDateFrom(?\DateTimeInterface $dateFrom): self
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    public function getDateTo(): ?\DateTimeInterface
    {
        return $this->dateTo;
    }

    public function setDateTo(?\DateTimeInterface $dateTo): self
    {
        $this->dateTo = $dateTo;

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

    /**
     * @return Collection|PassportStamp[]
     */
    public function getPassportStamp(): Collection
    {
        return $this->passportStamp;
    }

    public function addPassportStamp(PassportStamp $passportStamp): self
    {
        if (!$this->passportStamp->contains($passportStamp)) {
            $this->passportStamp[] = $passportStamp;
            $passportStamp->setVisa($this);
        }

        return $this;
    }

    public function removePassportStamp(PassportStamp $passportStamp): self
    {
        if ($this->passportStamp->contains($passportStamp)) {
            $this->passportStamp->removeElement($passportStamp);
            // set the owning side to null (unless already changed)
            if ($passportStamp->getVisa() === $this) {
                $passportStamp->setVisa(null);
            }
        }

        return $this;
    }
}
