<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $minPrice = null;

    #[ORM\Column(length: 25)]
    private ?string $category = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    /**
     * @var Collection<int, ServicePrice>
     */
    #[ORM\ManyToMany(targetEntity: ServicePrice::class, mappedBy: 'services')]
    private Collection $servicePrices;

    public function __construct()
    {
        $this->servicePrices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

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
            $servicePrice->addService($this);
        }

        return $this;
    }

    public function removeServicePrice(ServicePrice $servicePrice): static
    {
        if ($this->servicePrices->removeElement($servicePrice)) {
            $servicePrice->removeService($this);
        }

        return $this;
    }
}
