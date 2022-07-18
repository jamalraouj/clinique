<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
class Patient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $family_history = null;

    #[ORM\Column(length: 30, nullable: true)]
    private ?string $profession = null;

    #[ORM\Column(length: 20)]
    private ?string $status_patient = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $cree_en = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $mise_a_jour_a = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFamilyHistory(): ?string
    {
        return $this->family_history;
    }

    public function setFamilyHistory(?string $family_history): self
    {
        $this->family_history = $family_history;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getStatusPatient(): ?string
    {
        return $this->status_patient;
    }

    public function setStatusPatient(string $status_patient): self
    {
        $this->status_patient = $status_patient;

        return $this;
    }

    public function getCreeEn(): ?\DateTimeInterface
    {
        return $this->cree_en;
    }

    public function setCreeEn(\DateTimeInterface $cree_en): self
    {
        $this->cree_en = $cree_en;

        return $this;
    }

    public function getMiseAJourA(): ?\DateTimeInterface
    {
        return $this->mise_a_jour_a;
    }

    public function setMiseAJourA(\DateTimeInterface $mise_a_jour_a): self
    {
        $this->mise_a_jour_a = $mise_a_jour_a;

        return $this;
    }
}
