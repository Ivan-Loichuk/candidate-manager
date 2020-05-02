<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $iso;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $nicename;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $iso3;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numcode;

    /**
     * @ORM\Column(type="integer")
     */
    private $phonecode;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Birthplace", mappedBy="country")
     */
    private $birthplaces;

    public function __construct()
    {
        $this->birthplaces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIso(): ?string
    {
        return $this->iso;
    }

    public function setIso(string $iso): self
    {
        $this->iso = $iso;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNicename(): ?string
    {
        return $this->nicename;
    }

    public function setNicename(string $nicename): self
    {
        $this->nicename = $nicename;

        return $this;
    }

    public function getIso3(): ?string
    {
        return $this->iso3;
    }

    public function setIso3(string $iso3): self
    {
        $this->iso3 = $iso3;

        return $this;
    }

    public function getNumcode(): ?int
    {
        return $this->numcode;
    }

    public function setNumcode(int $numcode): self
    {
        $this->numcode = $numcode;

        return $this;
    }

    public function getPhonecode(): ?int
    {
        return $this->phonecode;
    }

    public function setPhonecode(int $phonecode): self
    {
        $this->phonecode = $phonecode;

        return $this;
    }

    /**
     * @return Collection|Birthplace[]
     */
    public function getBirthplaces(): Collection
    {
        return $this->birthplaces;
    }

    public function addBirthplace(Birthplace $birthplace): self
    {
        if (!$this->birthplaces->contains($birthplace)) {
            $this->birthplaces[] = $birthplace;
            $birthplace->setCountry($this);
        }

        return $this;
    }

    public function removeBirthplace(Birthplace $birthplace): self
    {
        if ($this->birthplaces->contains($birthplace)) {
            $this->birthplaces->removeElement($birthplace);
            // set the owning side to null (unless already changed)
            if ($birthplace->getCountry() === $this) {
                $birthplace->setCountry(null);
            }
        }

        return $this;
    }
}
