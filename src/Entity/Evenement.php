<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Name event must not be empty")]
   
    #[Assert\Regex(
          pattern:"/^[^0-9]+$/",
          message:"name can only contain letters"
      )]
      private ?string $nameevent = null;

    
      
    
   

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Type of event cant be empty")]
    #[Assert\Regex(
        pattern:"/^[^0-9]+$/",
        message:"Type can only contain letters"
    )]
    private ?string $type = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datedebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datefin = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Description of event cant be empty")]
    #[Assert\Length(min:10,max:1000, minMessage:"Description needs to be> 10.", maxMessage:"Description needs to be <=1000")]
    private ?string $description = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Number of participant must be filled")]
    
    private ?int $nbparticipant = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"place is required")]
    private ?string $lieu = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    private ?Sponsor $Sponsor = null;

  

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'evenements')]
    private Collection $User;

    


    public function __construct()
    {
        
        $this->User = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameevent(): ?string
    {
        return $this->nameevent;
    }

    public function setNameevent(string $nameevent): static
    {
        $this->nameevent = $nameevent;

        return $this;
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

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): static
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): static
    {
        $this->datefin = $datefin;

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

    public function getNbparticipant(): ?int
    {
        return $this->nbparticipant;
    }

    public function setNbparticipant(int $nbparticipant): static
    {
        $this->nbparticipant = $nbparticipant;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }
   
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getSponsor(): ?Sponsor
    {
        return $this->Sponsor;
    }

    public function setSponsor(?Sponsor $Sponsor): static
    {
        $this->Sponsor = $Sponsor;

        return $this;
    }

   

   

   

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->User;
    }

    public function addUser(User $user): static
    {
        if (!$this->User->contains($user)) {
            $this->User->add($user);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        $this->User->removeElement($user);

        return $this;
    }

  

    
}
