<?php

namespace App\Entity;

use App\Repository\FactureDonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureDonRepository::class)]
class FactureDon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_donateur = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom_donateur = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?float $montant = null;

    

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNomDonateur(): ?string
    {
        return $this->nom_donateur;
    }

    public function setNomDonateur(string $nom_donateur): static
    {
        $this->nom_donateur = $nom_donateur;

        return $this;
    }

    public function getPrenomDonateur(): ?string
    {
        return $this->prenom_donateur;
    }

    public function setPrenomDonateur(string $prenom_donateur): static
    {
        $this->prenom_donateur = $prenom_donateur;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDon(): ?Don
    {
        return $this->Don;
    }

    public function setDon(?Don $Don): static
    {
        $this->Don = $Don;

        return $this;
    }
}
