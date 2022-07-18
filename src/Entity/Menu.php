<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $genre_repas = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_repas = null;

    #[ORM\Column(length: 255)]
    private ?string $aperitifs = null;

    #[ORM\Column(length: 255)]
    private ?string $desert = null;

    #[ORM\Column(length: 255)]
    private ?string $categorie = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $jour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $temps = null;

    #[ORM\Column(length: 255)]
    private ?string $repas_alternative = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenreRepas(): ?string
    {
        return $this->genre_repas;
    }

    public function setGenreRepas(string $genre_repas): self
    {
        $this->genre_repas = $genre_repas;

        return $this;
    }

    public function getNomRepas(): ?string
    {
        return $this->nom_repas;
    }

    public function setNomRepas(string $nom_repas): self
    {
        $this->nom_repas = $nom_repas;

        return $this;
    }

    public function getAperitifs(): ?string
    {
        return $this->aperitifs;
    }

    public function setAperitifs(string $aperitifs): self
    {
        $this->aperitifs = $aperitifs;

        return $this;
    }

    public function getDesert(): ?string
    {
        return $this->desert;
    }

    public function setDesert(string $desert): self
    {
        $this->desert = $desert;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getJour(): ?\DateTimeInterface
    {
        return $this->jour;
    }

    public function setJour(\DateTimeInterface $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getTemps(): ?\DateTimeInterface
    {
        return $this->temps;
    }

    public function setTemps(\DateTimeInterface $temps): self
    {
        $this->temps = $temps;

        return $this;
    }

    public function getRepasAlternative(): ?string
    {
        return $this->repas_alternative;
    }

    public function setRepasAlternative(string $repas_alternative): self
    {
        $this->repas_alternative = $repas_alternative;

        return $this;
    }
}
