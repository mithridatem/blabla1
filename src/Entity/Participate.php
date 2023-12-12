<?php

namespace App\Entity;

use App\Repository\ParticipateRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
#[ORM\Entity(repositoryClass: ParticipateRepository::class)]
class Participate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['part'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['part'])]
    private ?\DateTimeInterface $rdvDate = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['part'])]
    private ?string $message = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['part'])]
    private ?bool $confirm = null;

    #[ORM\ManyToOne]
    #[Groups(['part'])]
    private ?Add $addId = null;

    #[ORM\ManyToOne]
    #[Groups(['part'])]
    private ?User $userId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRdvDate(): ?\DateTimeInterface
    {
        return $this->rdvDate;
    }

    public function setRdvDate(?\DateTimeInterface $rdvDate): static
    {
        $this->rdvDate = $rdvDate;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function isConfirm(): ?bool
    {
        return $this->confirm;
    }

    public function setConfirm(?bool $confirm): static
    {
        $this->confirm = $confirm;

        return $this;
    }

    public function getAddId(): ?Add
    {
        return $this->addId;
    }

    public function setAddId(?Add $addId): static
    {
        $this->addId = $addId;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): static
    {
        $this->userId = $userId;

        return $this;
    }
}
