<?php

namespace App\Entity;

use App\Repository\QuoteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuoteRepository::class)]
class Quote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'quotes')]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private array $items = [];

    #[ORM\Column(nullable: true)]
    private ?float $priceHT = null;

    #[ORM\Column]
    private ?float $priceTTC = null;

    #[ORM\Column]
    private array $pricesHT = [];

    #[ORM\Column]
    private array $pricesTTC = [];

    #[ORM\Column]
    private ?float $totalHT = null;

    #[ORM\Column]
    private ?float $totalTTC = null;

    #[ORM\Column]
    private ?\DateTime $validUntil = null;

    #[ORM\Column(length: 25)]
    private ?string $status = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): static
    {
        $this->items = $items;

        return $this;
    }

    public function getPriceHT(): ?float
    {
        return $this->priceHT;
    }

    public function setPriceHT(?float $priceHT): static
    {
        $this->priceHT = $priceHT;

        return $this;
    }

    public function getPriceTTC(): ?float
    {
        return $this->priceTTC;
    }

    public function setPriceTTC(float $priceTTC): static
    {
        $this->priceTTC = $priceTTC;

        return $this;
    }

    public function getPricesHT(): array
    {
        return $this->pricesHT;
    }

    public function setPricesHT(array $pricesHT): static
    {
        $this->pricesHT = $pricesHT;

        return $this;
    }

    public function getPricesTTC(): array
    {
        return $this->pricesTTC;
    }

    public function setPricesTTC(array $pricesTTC): static
    {
        $this->pricesTTC = $pricesTTC;

        return $this;
    }

    public function getTotalHT(): ?float
    {
        return $this->totalHT;
    }

    public function setTotalHT(float $totalHT): static
    {
        $this->totalHT = $totalHT;

        return $this;
    }

    public function getTotalTTC(): ?float
    {
        return $this->totalTTC;
    }

    public function setTotalTTC(float $totalTTC): static
    {
        $this->totalTTC = $totalTTC;

        return $this;
    }

    public function getValidUntil(): ?\DateTime
    {
        return $this->validUntil;
    }

    public function setValidUntil(\DateTime $validUntil): static
    {
        $this->validUntil = $validUntil;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
