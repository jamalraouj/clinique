<?php

namespace App\Entity;

use App\Repository\DossierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DossierRepository::class)]
class Dossier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_maintenant = null;

    #[ORM\Column(nullable: true)]
    private ?bool $cahier_sante = null;

    #[ORM\Column(nullable: true)]
    private ?int $prix_avance = null;

    #[ORM\Column(nullable: true)]
    private ?int $prix_restant = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(length: 40)]
    private ?string $status_dossier = null;

    #[ORM\ManyToOne(inversedBy: 'dossiers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Patient $fk_patient = null;

    #[ORM\ManyToMany(targetEntity: Medecin::class, inversedBy: 'dossiers')]
    private Collection $fk_medecin;

    public function __construct()
    {
        $this->fk_medecin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDateMaintenant(): ?\DateTimeInterface
    {
        return $this->date_maintenant;
    }

    public function setDateMaintenant(\DateTimeInterface $date_maintenant): self
    {
        $this->date_maintenant = $date_maintenant;

        return $this;
    }

    public function isCahierSante(): ?bool
    {
        return $this->cahier_sante;
    }

    public function setCahierSante(?bool $cahier_sante): self
    {
        $this->cahier_sante = $cahier_sante;

        return $this;
    }

    public function getPrixAvance(): ?int
    {
        return $this->prix_avance;
    }

    public function setPrixAvance(?int $prix_avance): self
    {
        $this->prix_avance = $prix_avance;

        return $this;
    }

    public function getPrixRestant(): ?int
    {
        return $this->prix_restant;
    }

    public function setPrixRestant(?int $prix_restant): self
    {
        $this->prix_restant = $prix_restant;

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

    public function getStatusDossier(): ?string
    {
        return $this->status_dossier;
    }

    public function setStatusDossier(string $status_dossier): self
    {
        $this->status_dossier = $status_dossier;

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

    /**
     * @return Collection<int, Medecin>
     */
    public function getFkMedecin(): Collection
    {
        return $this->fk_medecin;
    }

    public function addFkMedecin(Medecin $fkMedecin): self
    {
        if (!$this->fk_medecin->contains($fkMedecin)) {
            $this->fk_medecin[] = $fkMedecin;
        }

        return $this;
    }

    public function removeFkMedecin(Medecin $fkMedecin): self
    {
        $this->fk_medecin->removeElement($fkMedecin);

        return $this;
    }
}
