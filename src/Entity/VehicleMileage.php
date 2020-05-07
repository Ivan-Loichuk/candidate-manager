<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="VehicleMileageRepository")
 */
class VehicleMileage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $mileage;

    /**
     * @ORM\Column(type="date")
     */
    private $mileageDate;

    /**
     * @ORM\ManyToOne(targetEntity="Vehicle", inversedBy="vehicleMileage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vehicle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): self
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getMileageDate(): ?\DateTimeInterface
    {
        return $this->mileageDate;
    }

    public function setMileageDate(\DateTimeInterface $mileageDate): self
    {
        $this->mileageDate = $mileageDate;

        return $this;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }
}
