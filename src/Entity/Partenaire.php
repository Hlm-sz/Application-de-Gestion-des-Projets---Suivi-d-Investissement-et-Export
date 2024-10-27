<?php

namespace App\Entity;

use App\Repository\PartenaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PartenaireRepository::class)
 */
class Partenaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */ 
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

     

    /**
     * @ORM\OneToMany(targetEntity=PartenaireData::class, mappedBy="partenaire",cascade={"persist"})
     */
    private $partenaireData;

    public function __construct()
    {
        $this->partenaireData = new ArrayCollection();
        $this->paysorigine = new ArrayCollection(); 

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPaysorigine(): ?pays
    {
        return $this->paysorigine;
    }

    public function setPaysorigine(?pays $paysorigine): self
    {
        $this->paysorigine = $paysorigine;

        return $this;
    }
    
    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="partenaires")
     */
    private $responsableContact;

    public function getResponsableContact(): ?User
    {
        return $this->responsableContact;
    }

    public function setResponsableContact(?User $responsableContact): self
    {
        $this->responsableContact = $responsableContact;

        return $this;
    }

    /**
     * @return Collection|PartenaireData[]
     */
    public function getPartenaireData(): Collection
    {
        return $this->partenaireData;
    }

    public function addPartenaireData(PartenaireData $partenaireData): self
    {
        if (!$this->partenaireData->contains($partenaireData)) {
            $this->partenaireData[] = $partenaireData;
            $partenaireData->setPartenaire($this);
        }

        return $this;
    }
    public function removePartenaireData(PartenaireData $partenaireData): self
    {
        if ($this->partenaireData->contains($partenaireData)) {
            $this->partenaireData->removeElement($partenaireData);
            // set the owning side to null (unless already changed)
            if ($partenaireData->getPartenaire() === $this) {
                $partenaireData->setPartenaire(null);
            }
        }

        return $this;
    }

}
