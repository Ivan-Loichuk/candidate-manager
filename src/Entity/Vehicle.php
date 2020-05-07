<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="VehicleRepository")
 */
class Vehicle
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
    private $model;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $registrationNumber;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $inspectionDateTo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $insuranceDateTo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VehicleMileage", mappedBy="vehicle", orphanRemoval=true)
     */
    private $vehicleMileage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $oilChangeMileage;

    public function __construct()
    {
        $this->vehicleMileage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getRegistrationNumber(): ?string
    {
        return $this->registrationNumber;
    }

    public function setRegistrationNumber(?string $registrationNumber): self
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    public function getInspectionDateTo(): ?\DateTimeInterface
    {
        return $this->inspectionDateTo;
    }

    public function setInspectionDateTo(?\DateTimeInterface $inspectionDateTo): self
    {
        $this->inspectionDateTo = $inspectionDateTo;

        return $this;
    }

    public function getInsuranceDateTo(): ?\DateTimeInterface
    {
        return $this->insuranceDateTo;
    }

    public function setInsuranceDateTo(?\DateTimeInterface $insuranceDateTo): self
    {
        $this->insuranceDateTo = $insuranceDateTo;

        return $this;
    }

    /**
     * @return Collection|VehicleMileage[]
     */
    public function getVehicleMileage(): Collection
    {
        return $this->vehicleMileage;
    }

    public function addVehicleMileage(VehicleMileage $vehicleMileage): self
    {
        if (!$this->vehicleMileage->contains($vehicleMileage)) {
            $this->vehicleMileage[] = $vehicleMileage;
            $vehicleMileage->setVehicle($this);
        }

        return $this;
    }

    public function removeVehicleMileage(VehicleMileage $vehicleMileage): self
    {
        if ($this->vehicleMileage->contains($vehicleMileage)) {
            $this->vehicleMileage->removeElement($vehicleMileage);
            // set the owning side to null (unless already changed)
            if ($vehicleMileage->getVehicle() === $this) {
                $vehicleMileage->setVehicle(null);
            }
        }

        return $this;
    }

    public function getOilChangeMileage(): ?int
    {
        return $this->oilChangeMileage;
    }

    public function setOilChangeMileage(?int $oilChangeMileage): self
    {
        $this->oilChangeMileage = $oilChangeMileage;

        return $this;
    }
}
