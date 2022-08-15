<?php

namespace App\Entity;

use App\Repository\LitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LitRepository::class)]
class Lit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\Column(length: 20)]
    private ?string $status = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\ManyToOne(inversedBy: 'lits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chambre $fk_chambre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creer_a = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $mise_a_jour_a = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getFkChambre(): ?Chambre
    {
        return $this->fk_chambre;
    }

    public function setFkChambre(?Chambre $fk_chambre): self
    {
        $this->fk_chambre = $fk_chambre;

        return $this;
    }

    public function getCreerA(): ?\DateTimeInterface
    {
        return $this->creer_a;
    }

    public function setCreerA(\DateTimeInterface $creer_a): self
    {
        $this->creer_a = $creer_a;

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
