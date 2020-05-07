<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $viber;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PhoneNumber", mappedBy="contact")
     */
    private $telefon;

    public function __construct()
    {
        $this->telefon = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getViber(): ?string
    {
        return $this->viber;
    }

    public function setViber(?string $viber): self
    {
        $this->viber = $viber;

        return $this;
    }

    /**
     * @return Collection|PhoneNumber[]
     */
    public function getTelefon(): Collection
    {
        return $this->telefon;
    }

    public function addTelefon(PhoneNumber $telefon): self
    {
        if (!$this->telefon->contains($telefon)) {
            $this->telefon[] = $telefon;
            $telefon->setContact($this);
        }

        return $this;
    }

    public function removeTelefon(PhoneNumber $telefon): self
    {
        if ($this->telefon->contains($telefon)) {
            $this->telefon->removeElement($telefon);
            // set the owning side to null (unless already changed)
            if ($telefon->getContact() === $this) {
                $telefon->setContact(null);
            }
        }

        return $this;
    }
}
