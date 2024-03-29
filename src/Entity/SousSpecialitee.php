<?php

namespace App\Entity;

use App\Repository\SousSpecialiteeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousSpecialiteeRepository::class)]
class SousSpecialitee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'sousSpecialitees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Specialite $fk_specialite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFkSpecialite(): ?Specialite
    {
        return $this->fk_specialite;
    }

    public function setFkSpecialite(?Specialite $fk_specialite): self
    {
        $this->fk_specialite = $fk_specialite;

        return $this;
    }
}
