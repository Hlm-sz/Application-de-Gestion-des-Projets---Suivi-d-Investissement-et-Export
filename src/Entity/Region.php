<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 */
class Region
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default" : false})
     */
    private $isDeleted;
    
    /**
     * @ORM\OneToMany(targetEntity=Province::class, mappedBy="region")
     */
    private $provinces;

    public function __construct()
    {
        $this->provinces = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(?bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }
    
    /**
     * @return Collection|Province[]
     */
    public function getProvinces(): Collection
    {
        return $this->provinces;
    }
    
    public function addProvince(Province $province): self
    {
        if (!$this->provinces->contains($province)) {
            $this->provinces[] = $province;
            $province->setRegion($this);
        }
        
        return $this;
    }
    
    public function removeProvince(Province $province): self
    {
        if ($this->provinces->contains($province)) {
            $this->provinces->removeElement($province);
            // set the owning side to null (unless already changed)
            if ($province->getRegion() === $this) {
                $province->setRegion(null);
            }
        }
        
        return $this;
    }
}
