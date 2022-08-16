<?php

namespace App\Entity;

use App\Repository\SpecialiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialiteRepository::class)]
class Specialite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'fk_specialite', targetEntity: SousSpecialitee::class)]
    private Collection $sousSpecialitees;

    #[ORM\OneToMany(mappedBy: 'fk_specialite', targetEntity: Dossier::class)]
    private Collection $dossiers;

    #[ORM\ManyToMany(targetEntity: Medecin::class, mappedBy: 'fk_specialite')]
    private Collection $medecins;

    public function __construct()
    {
        $this->sousSpecialitees = new ArrayCollection();
        $this->dossiers = new ArrayCollection();
        $this->medecins = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, SousSpecialitee>
     */
    public function getSousSpecialitees(): Collection
    {
        return $this->sousSpecialitees;
    }

    public function addSousSpecialitee(SousSpecialitee $sousSpecialitee): self
    {
        if (!$this->sousSpecialitees->contains($sousSpecialitee)) {
            $this->sousSpecialitees[] = $sousSpecialitee;
            $sousSpecialitee->setFkSpecialite($this);
        }

        return $this;
    }

    public function removeSousSpecialitee(SousSpecialitee $sousSpecialitee): self
    {
        if ($this->sousSpecialitees->removeElement($sousSpecialitee)) {
            // set the owning side to null (unless already changed)
            if ($sousSpecialitee->getFkSpecialite() === $this) {
                $sousSpecialitee->setFkSpecialite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Dossier>
     */
    public function getDossiers(): Collection
    {
        return $this->dossiers;
    }

    public function addDossier(Dossier $dossier): self
    {
        if (!$this->dossiers->contains($dossier)) {
            $this->dossiers[] = $dossier;
            $dossier->setFkSpecialite($this);
        }

        return $this;
    }

    public function removeDossier(Dossier $dossier): self
    {
        if ($this->dossiers->removeElement($dossier)) {
            // set the owning side to null (unless already changed)
            if ($dossier->getFkSpecialite() === $this) {
                $dossier->setFkSpecialite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Medecin>
     */
    public function getMedecins(): Collection
    {
        return $this->medecins;
    }

    public function addMedecin(Medecin $medecin): self
    {
        if (!$this->medecins->contains($medecin)) {
            $this->medecins[] = $medecin;
            $medecin->addFkSpecialite($this);
        }

        return $this;
    }

    public function removeMedecin(Medecin $medecin): self
    {
        if ($this->medecins->removeElement($medecin)) {
            $medecin->removeFkSpecialite($this);
        }

        return $this;
    }
}
