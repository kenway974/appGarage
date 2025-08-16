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

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    private ?Brand $brand = null;

    /**
     * @var Collection<int, Model>
     */
    #[ORM\OneToMany(targetEntity: Model::class, mappedBy: 'car')]
    private Collection $models;

    #[ORM\Column]
    private ?bool $isActive = null;

    public function __construct()
    {
        $this->userCars = new ArrayCollection();
        $this->servicePrices = new ArrayCollection();
        $this->pieces = new ArrayCollection();
        $this->models = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return Collection<int, Model>
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Model $model): static
    {
        if (!$this->models->contains($model)) {
            $this->models->add($model);
            $model->setCar($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getCar() === $this) {
                $model->setCar(null);
            }
        }

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }
}
