<?php

namespace App\Entity;

use App\Repository\ServicePriceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicePriceRepository::class)]
class ServicePrice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Service>
     */
    #[ORM\ManyToMany(targetEntity: Service::class, inversedBy: 'servicePrices')]
    private Collection $services;

    /**
     * @var Collection<int, Car>
     */
    #[ORM\ManyToMany(targetEntity: Car::class, inversedBy: 'servicePrices')]
    private Collection $Car;

    #[ORM\Column]
    private ?float $price = null;

    /**
     * @var Collection<int, Piece>
     */
    #[ORM\ManyToMany(targetEntity: Piece::class, inversedBy: 'servicePrices')]
    private Collection $pieces;

    /**
     * @var Collection<int, Appointment>
     */
    #[ORM\ManyToMany(targetEntity: Appointment::class, mappedBy: 'servicePrices')]
    private Collection $appointments;

    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->Car = new ArrayCollection();
        $this->pieces = new ArrayCollection();
        $this->appointments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        $this->services->removeElement($service);

        return $this;
    }

    /**
     * @return Collection<int, Car>
     */
    public function getCar(): Collection
    {
        return $this->Car;
    }

    public function addCar(Car $car): static
    {
        if (!$this->Car->contains($car)) {
            $this->Car->add($car);
        }

        return $this;
    }

    public function removeCar(Car $car): static
    {
        $this->Car->removeElement($car);

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Piece>
     */
    public function getPieces(): Collection
    {
        return $this->pieces;
    }

    public function addPiece(Piece $piece): static
    {
        if (!$this->pieces->contains($piece)) {
            $this->pieces->add($piece);
        }

        return $this;
    }

    public function removePiece(Piece $piece): static
    {
        $this->pieces->removeElement($piece);

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
            $appointment->addServicePrice($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): static
    {
        if ($this->appointments->removeElement($appointment)) {
            $appointment->removeServicePrice($this);
        }

        return $this;
    }
}
