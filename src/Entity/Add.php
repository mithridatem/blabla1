<?php

namespace App\Entity;

use App\Repository\AddRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AddRepository::class)]
#[ORM\Table(name: '`add`')]
class Add
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['add','part'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['add','part','mess'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['add','part'])]
    private ?\DateTimeInterface $creation_date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['add','part'])]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['add','part'])]
    private ?int $placeNumber = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['add'])]
    private ?bool $activate = null;

    #[ORM\ManyToOne]
    #[Groups(['add','part'])]
    private ?Localisation $localisationId = null;

    #[ORM\ManyToOne]
    #[Groups(['add','part'])]
    private ?User $userId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(?\DateTimeInterface $creation_date): static
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPlaceNumber(): ?int
    {
        return $this->placeNumber;
    }

    public function setPlaceNumber(?int $placeNumber): static
    {
        $this->placeNumber = $placeNumber;

        return $this;
    }

    public function isActivate(): ?bool
    {
        return $this->activate;
    }

    public function setActivate(?bool $activate): static
    {
        $this->activate = $activate;

        return $this;
    }

    public function getLocalisationId(): ?Localisation
    {
        return $this->localisationId;
    }

    public function setLocalisationId(?Localisation $localisationId): static
    {
        $this->localisationId = $localisationId;

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
