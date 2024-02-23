<?php

namespace App\Entity;

use App\Repository\ReservationDechetsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationDechetsRepository::class)]
class ReservationDechets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $quantité = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_ramassage = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_fournisseur = null;

    #[ORM\Column]
    private ?int $numero_tell = null;

    #[ORM\ManyToOne(inversedBy: 'reservationDechets')]
    private ?User $User = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantité(): ?float
    {
        return $this->quantité;
    }

    public function setQuantité(float $quantité): static
    {
        $this->quantité = $quantité;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDateRamassage(): ?\DateTimeInterface
    {
        return $this->date_ramassage;
    }

    public function setDateRamassage(\DateTimeInterface $date_ramassage): static
    {
        $this->date_ramassage = $date_ramassage;

        return $this;
    }

    public function getNomFournisseur(): ?string
    {
        return $this->nom_fournisseur;
    }

    public function setNomFournisseur(string $nom_fournisseur): static
    {
        $this->nom_fournisseur = $nom_fournisseur;

        return $this;
    }

    public function getNumeroTell(): ?int
    {
        return $this->numero_tell;
    }

    public function setNumeroTell(int $numero_tell): static
    {
        $this->numero_tell = $numero_tell;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }
}
