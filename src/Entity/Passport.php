<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PassportRepository")
 */
class Passport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee", inversedBy="passport")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employee;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PassportStamp", mappedBy="passport", orphanRemoval=true)
     */
    private $passportStamp;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $number;

    public function __construct()
    {
        $this->passportStamp = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

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
            $passportStamp->setPassport($this);
        }

        return $this;
    }

    public function removePassportStamp(PassportStamp $passportStamp): self
    {
        if ($this->passportStamp->contains($passportStamp)) {
            $this->passportStamp->removeElement($passportStamp);
            // set the owning side to null (unless already changed)
            if ($passportStamp->getPassport() === $this) {
                $passportStamp->setPassport(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;

        return $this;
    }
}
