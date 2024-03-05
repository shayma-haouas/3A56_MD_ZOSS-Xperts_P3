<?php

namespace App\Entity;

use App\Repository\DechetsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DechetsRepository::class)]
class Dechets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_entre = null;

    #[ORM\Column]
    private ?float $quantité = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'Dechets', targetEntity: ReservationDechets::class)]
    private Collection $reservationDechets;

    public function __construct()
    {
        $this->reservationDechets = new ArrayCollection();
    }

 

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDateEntre(): ?\DateTimeInterface
    {
        return $this->date_entre;
    }

    public function setDateEntre(\DateTimeInterface $date_entre): static
    {
        $this->date_entre = $date_entre;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, ReservationDechets>
     */
    public function getReservationDechets(): Collection
    {
        return $this->reservationDechets;
    }

    public function addReservationDechet(ReservationDechets $reservationDechet): static
    {
        if (!$this->reservationDechets->contains($reservationDechet)) {
            $this->reservationDechets->add($reservationDechet);
            $reservationDechet->setDechets($this);
        }

        return $this;
    }

    public function removeReservationDechet(ReservationDechets $reservationDechet): static
    {
        if ($this->reservationDechets->removeElement($reservationDechet)) {
            // set the owning side to null (unless already changed)
            if ($reservationDechet->getDechets() === $this) {
                $reservationDechet->setDechets(null);
            }
        }

        return $this;
    }

   

  

 
    
}
