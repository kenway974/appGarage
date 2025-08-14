<?php

namespace App\Entity;

use App\Repository\UserCarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserCarRepository::class)]
class UserCar
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userCars')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'userCars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Car $car = null;

    #[ORM\Column(length: 25)]
    private ?string $plateNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vin = null;

    #[ORM\Column]
    private ?int $mileage = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $purchaseDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $lastServiceDate = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    /**
     * @var Collection<int, Appointment>
     */
    #[ORM\OneToMany(targetEntity: Appointment::class, mappedBy: 'userCar')]
    private Collection $appointments;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): static
    {
        $this->car = $car;

        return $this;
    }

    public function getPlateNumber(): ?string
    {
        return $this->plateNumber;
    }

    public function setPlateNumber(string $plateNumber): static
    {
        $this->plateNumber = $plateNumber;

        return $this;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(?string $vin): static
    {
        $this->vin = $vin;

        return $this;
    }

    public function getMileage(): ?int
    {
        return $this->mileage;
    }

    public function setMileage(int $mileage): static
    {
        $this->mileage = $mileage;

        return $this;
    }

    public function getPurchaseDate(): ?\DateTime
    {
        return $this->purchaseDate;
    }

    public function setPurchaseDate(?\DateTime $purchaseDate): static
    {
        $this->purchaseDate = $purchaseDate;

        return $this;
    }

    public function getLastServiceDate(): ?\DateTime
    {
        return $this->lastServiceDate;
    }

    public function setLastServiceDate(?\DateTime $lastServiceDate): static
    {
        $this->lastServiceDate = $lastServiceDate;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * @return Collection<int, Appointment>
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): static
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments->add($appointment);
            $appointment->setUserCar($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): static
    {
        if ($this->appointments->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getUserCar() === $this) {
                $appointment->setUserCar(null);
            }
        }

        return $this;
    }
}
