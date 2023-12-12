<?php

namespace App\Entity;

use App\Repository\LocalisationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LocalisationRepository::class)]
class Localisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['add','part'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['add','part'])]
    private ?string $nameLocalisation = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['add','part'])]
    private ?string $nameStreet = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['add','part'])]
    private ?int $numStreet = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['add','part'])]
    private ?string $town = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['add','part'])]
    private ?int $postalCode = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['add','part'])]
    private ?float $longitude = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['add','part'])]
    private ?float $latitude = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameLocalisation(): ?string
    {
        return $this->nameLocalisation;
    }

    public function setNameLocalisation(?string $nameLocalisation): static
    {
        $this->nameLocalisation = $nameLocalisation;

        return $this;
    }

    public function getNameStreet(): ?string
    {
        return $this->nameStreet;
    }

    public function setNameStreet(?string $nameStreet): static
    {
        $this->nameStreet = $nameStreet;

        return $this;
    }

    public function getNumStreet(): ?int
    {
        return $this->numStreet;
    }

    public function setNumStreet(?int $numStreet): static
    {
        $this->numStreet = $numStreet;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(?string $town): static
    {
        $this->town = $town;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(?int $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }


    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }
}
