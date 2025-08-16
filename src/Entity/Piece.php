<?php

namespace App\Entity;

use App\Repository\PieceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PieceRepository::class)]
class Piece
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reference = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $minPrice = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $category = null;

    /**
     * @var Collection<int, Car>
     */
    #[ORM\ManyToMany(targetEntity: Car::class, inversedBy: 'pieces')]
    private Collection $compatibleCars;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?\DateTime $updatedAt = null;

    /**
     * @var Collection<int, ServicePrice>
     */
    #[ORM\ManyToMany(targetEntity: ServicePrice::class, mappedBy: 'pieces')]
    private Collection $servicePrices;

    #[ORM\Column]
    private ?bool $isActive = null;

    public function __construct()
    {
        $this->compatibleCars = new ArrayCollection();
        $this->servicePrices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMinPrice(): ?float
    {
        return $this->minPrice;
    }

    public function setMinPrice(float $minPrice): static
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Car>
     */
    public function getCompatibleCars(): Collection
    {
        return $this->compatibleCars;
    }

    public function addCompatibleCar(Car $compatibleCar): static
    {
        if (!$this->compatibleCars->contains($compatibleCar)) {
            $this->compatibleCars->add($compatibleCar);
        }

        return $this;
    }

    public function removeCompatibleCar(Car $compatibleCar): static
    {
        $this->compatibleCars->removeElement($compatibleCar);

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
            $servicePrice->addPiece($this);
        }

        return $this;
    }

    public function removeServicePrice(ServicePrice $servicePrice): static
    {
        if ($this->servicePrices->removeElement($servicePrice)) {
            $servicePrice->removePiece($this);
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
