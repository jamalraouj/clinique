<?php

namespace App\Entity;

use App\Repository\AnamneseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnamneseRepository::class)]
class Anamnese
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $coeur = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $systeme_pulmonaire = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $systeme_digestif = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $systeme_uro_gyneco = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $systeme_locomoteur = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $remarques = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $other = null;

    #[ORM\ManyToOne(inversedBy: 'anamneses')]
    private ?Patient $fk_patient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoeur(): ?string
    {
        return $this->coeur;
    }

    public function setCoeur(?string $coeur): self
    {
        $this->coeur = $coeur;

        return $this;
    }

    public function getSystemePulmonaire(): ?string
    {
        return $this->systeme_pulmonaire;
    }

    public function setSystemePulmonaire(?string $systeme_pulmonaire): self
    {
        $this->systeme_pulmonaire = $systeme_pulmonaire;

        return $this;
    }

    public function getSystemeDigestif(): ?string
    {
        return $this->systeme_digestif;
    }

    public function setSystemeDigestif(?string $systeme_digestif): self
    {
        $this->systeme_digestif = $systeme_digestif;

        return $this;
    }

    public function getSystemeUroGyneco(): ?string
    {
        return $this->systeme_uro_gyneco;
    }

    public function setSystemeUroGyneco(?string $systeme_uro_gyneco): self
    {
        $this->systeme_uro_gyneco = $systeme_uro_gyneco;

        return $this;
    }

    public function getSystemeLocomoteur(): ?string
    {
        return $this->systeme_locomoteur;
    }

    public function setSystemeLocomoteur(?string $systeme_locomoteur): self
    {
        $this->systeme_locomoteur = $systeme_locomoteur;

        return $this;
    }

    public function getRemarques(): ?string
    {
        return $this->remarques;
    }

    public function setRemarques(?string $remarques): self
    {
        $this->remarques = $remarques;

        return $this;
    }

    public function getOther(): ?string
    {
        return $this->other;
    }

    public function setOther(?string $other): self
    {
        $this->other = $other;

        return $this;
    }

    public function getFkPatient(): ?Patient
    {
        return $this->fk_patient;
    }

    public function setFkPatient(?Patient $fk_patient): self
    {
        $this->fk_patient = $fk_patient;

        return $this;
    }
}
