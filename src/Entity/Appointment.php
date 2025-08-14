<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppointmentRepository::class)]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'appointments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'appointments')]
    private ?UserCar $userCar = null;

    /**
     * @var Collection<int, ServicePrice>
     */
    #[ORM\ManyToMany(targetEntity: ServicePrice::class, inversedBy: 'appointments')]
    private Collection $servicePrices;

    #[ORM\Column]
    private ?\DateTime $datetime = null;

    #[ORM\Column(length: 25)]
    private ?string $status = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct()
    {
        $this->servicePrices = new ArrayCollection();
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

    public function getUserCar(): ?UserCar
    {
        return $this->userCar;
    }

    public function setUserCar(?UserCar $userCar): static
    {
        $this->userCar = $userCar;

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
        }

        return $this;
    }

    public function removeServicePrice(ServicePrice $servicePrice): static
    {
        $this->servicePrices->removeElement($servicePrice);

        return $this;
    }

    public function getDatetime(): ?\DateTime
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTime $datetime): static
    {
        $this->datetime = $datetime;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
