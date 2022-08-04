<?php

namespace App\Entity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[Assert\Length(min : 10,max : 30,minMessage : "Your first name must be at least {{ limit }} characters long",maxMessage : "Your first name cannot be longer than {{ limit }} characters")]
    #[ORM\Column(length: 30)]
    private ?string $nom = null;
//create assert validation

    /**
     * @Assert\Length(
     * min = 5,
     * max = 25,
     * minMessage = "Your first name must be at least {{ limit }} characters long",
     * maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    #[ORM\Column(length: 30)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 30)]
    private ?string $telephone = null;

    #[ORM\Column(length: 30)]
    private ?string $cin = null;

    #[ORM\Column(length: 100)]
    private ?string $address = null;

    #[ORM\Column(length: 60)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $joindre_a = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $derniere_conexion = null;

    #[ORM\Column(length: 255)]
    private ?string $user_role = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $mise_a_jour_a = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Patient $fk_patient = null;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Medecin $fk_medecin = null;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getJoindreA(): ?\DateTimeInterface
    {
        return $this->joindre_a;
    }

    public function setJoindreA(\DateTimeInterface $joindre_a): self
    {
        $this->joindre_a = $joindre_a;

        return $this;
    }

    public function getDerniereConexion(): ?\DateTimeInterface
    {
        return $this->derniere_conexion;
    }

    public function setDerniereConexion(\DateTimeInterface $derniere_conexion): self
    {
        $this->derniere_conexion = $derniere_conexion;

        return $this;
    }

    public function getUserRole(): ?string
    {
        return $this->user_role;
    }

    public function setUserRole(string $user_role): self
    {
        $this->user_role = $user_role;

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


    public function getFkPatient(): ?Patient
    {
        return $this->fk_patient;
    }

    public function setFkPatient(?Patient $fk_patient): self
    {
        $this->fk_patient = $fk_patient;

        return $this;
    }

    public function getFkMedecin(): ?Medecin
    {
        return $this->fk_medecin;
    }

    public function setFkMedecin(?Medecin $fk_medecin): self
    {
        $this->fk_medecin = $fk_medecin;

        return $this;
    }
}
