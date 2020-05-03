<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CandidateRepository")
 */
class Candidate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "Your last name must be at least {{ limit }} characters long",
     *      maxMessage = "Your last name cannot be longer than {{ limit }} characters",
     *      allowEmptyString = false
     * )
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('MALE', 'FEMALE')")
     * @Assert\NotBlank
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profession;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Birthplace", cascade={"persist", "remove"})
     */
    private $birthplace;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(
     *     pattern="/^[0-9\-\(\)\/\+\s]*$/",
     *     match=true,
     *     message="Wrong phone number"
     * )
     * @Assert\Length(
     *      min = 9,
     *      max = 15,
     *      minMessage = "Your number must be at least {{ limit }} characters long",
     *      maxMessage = "Your number cannot be longer than {{ limit }} characters",
     *      allowEmptyString = true
     * )
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Your viber must be at least {{ limit }} characters long",
     *      maxMessage = "Your viber cannot be longer than {{ limit }} characters",
     *      allowEmptyString = true
     * )
     */
    private $viber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Your skype  must be at least {{ limit }} characters long",
     *      maxMessage = "Your skype cannot be longer than {{ limit }} characters",
     *      allowEmptyString = true
     * )
     */
    private $skype;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $aboutCandidate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LegalizationDocument", mappedBy="idCandidate")
     */
    private $legalizationDocuments;

    /**
     * @ORM\Column(type="date")
     */
    private $lastUpdate;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $nationality;

    public function __construct()
    {
        $this->legalizationDocuments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        if (!in_array($gender, ['MALE', 'FEMALE'])) {
            throw new \InvalidArgumentException("Invalid gender");
        }
        $this->gender = $gender;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getBirthplace(): ?Birthplace
    {
        return $this->birthplace;
    }

    public function setBirthplace(?Birthplace $birthplace): self
    {
        $this->birthplace = $birthplace;

        return $this;
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

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

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

    public function getSkype(): ?string
    {
        return $this->skype;
    }

    public function setSkype(?string $skype): self
    {
        $this->skype = $skype;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getAboutCandidate(): ?string
    {
        return $this->aboutCandidate;
    }

    public function setAboutCandidate(?string $aboutCandidate): self
    {
        $this->aboutCandidate = $aboutCandidate;

        return $this;
    }

    /**
     * @return Collection|LegalizationDocument[]
     */
    public function getLegalizationDocuments(): Collection
    {
        return $this->legalizationDocuments;
    }

    public function addLegalizationDocument(LegalizationDocument $legalizationDocument): self
    {
        if (!$this->legalizationDocuments->contains($legalizationDocument)) {
            $this->legalizationDocuments[] = $legalizationDocument;
            $legalizationDocument->setCandidate($this);
        }

        return $this;
    }

    public function removeLegalizationDocument(LegalizationDocument $legalizationDocument): self
    {
        if ($this->legalizationDocuments->contains($legalizationDocument)) {
            $this->legalizationDocuments->removeElement($legalizationDocument);
            // set the owning side to null (unless already changed)
            if ($legalizationDocument->getCandidate() === $this) {
                $legalizationDocument->setCandidate(null);
            }
        }

        return $this;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(\DateTimeInterface $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(?string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }
}
