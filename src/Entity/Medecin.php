<?php

namespace App\Entity;

use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
class Medecin
{
    public string $UPLOAD_FOLDER = "\public\assets\Uploads";

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $matricule = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $experience = null;

    #[ORM\Column]
    private ?float $salaire = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $temps_travail = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $jour_travail = null;

    #[ORM\Column(length: 200 , nullable: true)]
    private ?string $image_medecin = null;

    #[ORM\Column(length: 25)]
    private ?string $status_medecin = null;

    #[ORM\OneToOne(mappedBy: 'fk_medecin', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\ManyToMany(targetEntity: Dossier::class, mappedBy: 'fk_medecin')]
    private Collection $dossiers;

    #[ORM\ManyToMany(targetEntity: Specialite::class, inversedBy: 'medecins')]
    private Collection $fk_specialite;

    public function __construct()
    {
        $this->dossiers = new ArrayCollection();
        $this->fk_specialite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getSalaire(): ?float
    {
        return $this->salaire;
    }

    public function setSalaire(float $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getTempsTravail(): ?\DateTimeInterface
    {
        return $this->temps_travail;
    }

    public function setTempsTravail(\DateTimeInterface $temps_travail): self
    {
        $this->temps_travail = $temps_travail;

        return $this;
    }

    public function getJourTravail(): ?\DateTimeInterface
    {
        return $this->jour_travail;
    }

    public function setJourTravail(\DateTimeInterface $jour_travail): self
    {
        $this->jour_travail = $jour_travail;

        return $this;
    }

    public function getImageMedecin(): ?string
    {
        return $this->image_medecin;
    }

    public function setImageMedecin(string|null $image_medecin): self
    {
        $this->image_medecin = $image_medecin;

        return $this;
    }

    
    public function getStatusMedecin(): ?string
    {
        return $this->status_medecin;
    }

    public function setStatusMedecin(string $status_medecin): self
    {
        $this->status_medecin = $status_medecin;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setFkMedecin(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getFkMedecin() !== $this) {
            $user->setFkMedecin($this);
        }

        $this->user = $user;

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
            $dossier->addFkMedecin($this);
        }

        return $this;
    }

    public function removeDossier(Dossier $dossier): self
    {
        if ($this->dossiers->removeElement($dossier)) {
            $dossier->removeFkMedecin($this);
        }
        
        return $this;
    }

    /**
     * @return Collection<int, Specialite>
     */
    public function getFkSpecialite(): Collection
    {
        return $this->fk_specialite;
    }

    public function addFkSpecialite(Specialite $fkSpecialite): self
    {
        if (!$this->fk_specialite->contains($fkSpecialite)) {
            $this->fk_specialite[] = $fkSpecialite;
        }

        return $this;
    }

    public function removeFkSpecialite(Specialite $fkSpecialite): self
    {
        $this->fk_specialite->removeElement($fkSpecialite);

        return $this;
    }
}