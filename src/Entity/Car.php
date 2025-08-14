<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $brand = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $brandLogo = null;

    #[ORM\Column(length: 25)]
    private ?string $model = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column(length: 25)]
    private ?string $fuel = null;

    #[ORM\Column(length: 25)]
    private ?string $transmission = null;

    #[ORM\Column(nullable: true)]
    private ?float $engineDisplacement = null;

    #[ORM\Column(nullable: true)]
    private ?int $horsepower = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?\DateTime $updatedAt = null;

    /**
     * @var Collection<int, UserCar>
     */
    #[ORM\OneToMany(targetEntity: UserCar::class, mappedBy: 'car')]
    private Collection $userCars;

    /**
     * @var Collection<int, ServicePrice>
     */
    #[ORM\ManyToMany(targetEntity: ServicePrice::class, mappedBy: 'Car')]
    private Collection $servicePrices;

    /**
     * @var Collection<int, Piece>
     */
    #[ORM\ManyToMany(targetEntity: Piece::class, mappedBy: 'compatibleCars')]
    private Collection $pieces;

    public function __construct()
    {
        $this->userCars = new ArrayCollection();
        $this->servicePrices = new ArrayCollection();
        $this->pieces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrandLogo(): ?string
    {
        return $this->brandLogo;
    }

    public function setBrandLogo(?string $brandLogo): static
    {
        $this->brandLogo = $brandLogo;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): static
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): static
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getEngineDisplacement(): ?float
    {
        return $this->engineDisplacement;
    }

    public function setEngineDisplacement(?float $engineDisplacement): static
    {
        $this->engineDisplacement = $engineDisplacement;

        return $this;
    }

    public function getHorsepower(): ?int
    {
        return $this->horsepower;
    }

    public function setHorsepower(?int $horsepower): static
    {
        $this->horsepower = $horsepower;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, UserCar>
     */
    public function getUserCars(): Collection
    {
        return $this->userCars;
    }

    public function addUserCar(UserCar $userCar): static
    {
        if (!$this->userCars->contains($userCar)) {
            $this->userCars->add($userCar);
            $userCar->setCar($this);
        }

        return $this;
    }

    public function removeUserCar(UserCar $userCar): static
    {
        if ($this->userCars->removeElement($userCar)) {
            // set the owning side to null (unless already changed)
            if ($userCar->getCar() === $this) {
                $userCar->setCar(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ServicePrice>
     */
    public function getServicePrices(): Collection
    {
        return $this->servicePrices;
    }

    public function addServicePrice(ServicePrice $servicePrice): static
    {
        if (!$this->servicePrices->contains($servicePrice)) {
            $this->servicePrices->add($servicePrice);
            $servicePrice->addCar($this);
        }

        return $this;
    }

    public function removeServicePrice(ServicePrice $servicePrice): static
    {
        if ($this->servicePrices->removeElement($servicePrice)) {
            $servicePrice->removeCar($this);
        }

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
            $piece->addCompatibleCar($this);
        }

        return $this;
    }

    public function removePiece(Piece $piece): static
    {
        if ($this->pieces->removeElement($piece)) {
            $piece->removeCompatibleCar($this);
        }

        return $this;
    }
}
