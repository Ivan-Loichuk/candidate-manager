<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeeRepository")
 */
class Employee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateOfArrival;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateOfDeparture;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $baxtUA;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $pipApplicationDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ResidenceCard", mappedBy="employee", orphanRemoval=true)
     */
    private $residenceCard;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Passport", mappedBy="employee", orphanRemoval=true, cascade={"persist"})
     */
    private $passport;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contract", mappedBy="employee", cascade={"persist"}, orphanRemoval=true)
     */
    private $contract;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MedicalExamination", mappedBy="employee", cascade={"persist"}, orphanRemoval=true)
     */
    private $medicalExamination;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SafetyTraining", mappedBy="employee", cascade={"persist"}, orphanRemoval=true)
     */
    private $safetyTraining;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DelegationList", mappedBy="employee", cascade={"persist"}, orphanRemoval=true)
     */
    private $delegationList;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Contact", cascade={"persist", "remove"})
     */
    private $contact;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Document", mappedBy="employee", orphanRemoval=true)
     */
    private $document;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", inversedBy="employee")
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Permission", mappedBy="employee", cascade={"persist"}, orphanRemoval=true)
     */
    private $permission;

    public function __construct()
    {
        $this->residenceCard = new ArrayCollection();
        $this->passport = new ArrayCollection();
        $this->contract = new ArrayCollection();
        $this->medicalExamination = new ArrayCollection();
        $this->safetyTraining = new ArrayCollection();
        $this->delegationList = new ArrayCollection();
        $this->document = new ArrayCollection();

        $this->setCreatedDate(new \DateTime('now'));
        $this->permission = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getPipApplicationDate(): ?\DateTimeInterface
    {
        return $this->pipApplicationDate;
    }

    public function setPipApplicationDate(?\DateTimeInterface $pipApplicationDate): self
    {
        $this->pipApplicationDate = $pipApplicationDate;

        return $this;
    }

    /**
     * @return Collection|ResidenceCard[]
     */
    public function getResidenceCard(): Collection
    {
        return $this->residenceCard;
    }

    public function addResidenceCard(ResidenceCard $residenceCard): self
    {
        if (!$this->residenceCard->contains($residenceCard)) {
            $this->residenceCard[] = $residenceCard;
            $residenceCard->setEmployee($this);
        }

        return $this;
    }

    public function removeResidenceCard(ResidenceCard $residenceCard): self
    {
        if ($this->residenceCard->contains($residenceCard)) {
            $this->residenceCard->removeElement($residenceCard);
            // set the owning side to null (unless already changed)
            if ($residenceCard->getEmployee() === $this) {
                $residenceCard->setEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Passport[]
     */
    public function getPassport(): Collection
    {
        return $this->passport;
    }

    public function addPassport(Passport $passport): self
    {
        if (!$this->passport->contains($passport)) {
            $this->passport[] = $passport;
            $passport->setEmployee($this);
        }

        return $this;
    }

    public function removePassport(Passport $passport): self
    {
        if ($this->passport->contains($passport)) {
            $this->passport->removeElement($passport);
            // set the owning side to null (unless already changed)
            if ($passport->getEmployee() === $this) {
                $passport->setEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contract[]
     */
    public function getContract(): Collection
    {
        return $this->contract;
    }

    public function addContract(Contract $contract): self
    {
        if (!$this->contract->contains($contract)) {
            $this->contract[] = $contract;
            $contract->setEmployee($this);
        }

        return $this;
    }

    public function removeContract(Contract $contract): self
    {
        if ($this->contract->contains($contract)) {
            $this->contract->removeElement($contract);
            // set the owning side to null (unless already changed)
            if ($contract->getEmployee() === $this) {
                $contract->setEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|MedicalExamination[]
     */
    public function getMedicalExamination(): Collection
    {
        return $this->medicalExamination;
    }

    public function addMedicalExamination(MedicalExamination $medicalExamination): self
    {
        if (!$this->medicalExamination->contains($medicalExamination)) {
            $this->medicalExamination[] = $medicalExamination;
            $medicalExamination->setEmployee($this);
        }

        return $this;
    }

    public function removeMedicalExamination(MedicalExamination $medicalExamination): self
    {
        if ($this->medicalExamination->contains($medicalExamination)) {
            $this->medicalExamination->removeElement($medicalExamination);
            // set the owning side to null (unless already changed)
            if ($medicalExamination->getEmployee() === $this) {
                $medicalExamination->setEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SafetyTraining[]
     */
    public function getSafetyTraining(): Collection
    {
        return $this->safetyTraining;
    }

    public function addSafetyTraining(SafetyTraining $safetyTraining): self
    {
        if (!$this->safetyTraining->contains($safetyTraining)) {
            $this->safetyTraining[] = $safetyTraining;
            $safetyTraining->setEmployee($this);
        }

        return $this;
    }

    public function removeSafetyTraining(SafetyTraining $safetyTraining): self
    {
        if ($this->safetyTraining->contains($safetyTraining)) {
            $this->safetyTraining->removeElement($safetyTraining);
            // set the owning side to null (unless already changed)
            if ($safetyTraining->getEmployee() === $this) {
                $safetyTraining->setEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DelegationList[]
     */
    public function getDelegationList(): Collection
    {
        return $this->delegationList;
    }

    public function addDelegationList(DelegationList $delegationList): self
    {
        if (!$this->delegationList->contains($delegationList)) {
            $this->delegationList[] = $delegationList;
            $delegationList->setEmployee($this);
        }

        return $this;
    }

    public function removeDelegationList(DelegationList $delegationList): self
    {
        if ($this->delegationList->contains($delegationList)) {
            $this->delegationList->removeElement($delegationList);
            // set the owning side to null (unless already changed)
            if ($delegationList->getEmployee() === $this) {
                $delegationList->setEmployee(null);
            }
        }

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * @return Collection|Document[]
     */
    public function getDocument(): Collection
    {
        return $this->document;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->document->contains($document)) {
            $this->document[] = $document;
            $document->setEmployee($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->document->contains($document)) {
            $this->document->removeElement($document);
            // set the owning side to null (unless already changed)
            if ($document->getEmployee() === $this) {
                $document->setEmployee(null);
            }
        }

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getDateOfArrival(): ?\DateTimeInterface
    {
        return $this->dateOfArrival;
    }

    public function setDateOfArrival(?\DateTimeInterface $dateOfArrival): self
    {
        $this->dateOfArrival = $dateOfArrival;

        return $this;
    }

    public function getDateOfDeparture(): ?\DateTimeInterface
    {
        return $this->dateOfDeparture;
    }

    public function setDateOfDeparture(?\DateTimeInterface $dateOfDeparture): self
    {
        $this->dateOfDeparture = $dateOfDeparture;

        return $this;
    }

    public function getBaxtUA(): ?string
    {
        return $this->baxtUA;
    }

    public function setBaxtUA(?string $baxtUA): self
    {
        $this->baxtUA = $baxtUA;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    /**
     * @return Collection|Permission[]
     */
    public function getPermission(): Collection
    {
        return $this->permission;
    }

    public function addPermission(Permission $permission): self
    {
        if (!$this->permission->contains($permission)) {
            $this->permission[] = $permission;
            $permission->setEmployee($this);
        }

        return $this;
    }

    public function removePermission(Permission $permission): self
    {
        if ($this->permission->contains($permission)) {
            $this->permission->removeElement($permission);
            // set the owning side to null (unless already changed)
            if ($permission->getEmployee() === $this) {
                $permission->setEmployee(null);
            }
        }

        return $this;
    }
}
