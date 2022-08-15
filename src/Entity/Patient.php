<?php

namespace App\Entity;

use App\Repository\PatientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
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

    #[Assert\Length(max : 30,maxMessage : "Profession cannot be longer than {{ limit }} characters")]
    #[ORM\Column(length: 30, nullable: true)]
    private ?string $profession = null;

    
    /**
     * @Assert\Regex(pattern="/^\d+$/")
      */
    #[ORM\Column(length: 20)]//type: Types::INTEGER 
    private ?string $status_patient = null;

    #[ORM\OneToOne(mappedBy: 'fk_patient', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'fk_patient', targetEntity: Dossier::class, orphanRemoval: true)]
    private Collection $dossiers;

    public function __construct()
    {
        $this->dossiers = new ArrayCollection();
    }

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



    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setFkPatient(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getFkPatient() !== $this) {
            $user->setFkPatient($this);
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
            $dossier->setFkPatient($this);
        }

        return $this;
    }

    public function removeDossier(Dossier $dossier): self
    {
        if ($this->dossiers->removeElement($dossier)) {
            // set the owning side to null (unless already changed)
            if ($dossier->getFkPatient() === $this) {
                $dossier->setFkPatient(null);
            }
        }

        return $this;
    }
}
