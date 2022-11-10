<?php

namespace App\Entity;

use App\Repository\EntretienRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntretienRepository::class)]
class Entretien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 25)]
    private ?string $nomPostulant = null;

    #[ORM\Column(length: 25)]
    private ?string $prenomPostulant = null;

    #[ORM\Column(length: 25)]
    private ?string $nomRecruteur = null;

    #[ORM\Column(length: 25)]
    private ?string $prenomRecruteur = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNomPostulant(): ?string
    {
        return $this->nomPostulant;
    }

    public function setNomPostulant(string $nomPostulant): self
    {
        $this->nomPostulant = $nomPostulant;

        return $this;
    }

    public function getPrenomPostulant(): ?string
    {
        return $this->prenomPostulant;
    }

    public function setPrenomPostulant(string $prenomPostulant): self
    {
        $this->prenomPostulant = $prenomPostulant;

        return $this;
    }

    public function getNomRecruteur(): ?string
    {
        return $this->nomRecruteur;
    }

    public function setNomRecruteur(string $nomRecruteur): self
    {
        $this->nomRecruteur = $nomRecruteur;

        return $this;
    }

    public function getPrenomRecruteur(): ?string
    {
        return $this->prenomRecruteur;
    }

    public function setPrenomRecruteur(string $prenomRecruteur): self
    {
        $this->prenomRecruteur = $prenomRecruteur;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
