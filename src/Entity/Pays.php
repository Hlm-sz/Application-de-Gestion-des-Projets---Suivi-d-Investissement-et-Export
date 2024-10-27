<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 */
class Pays
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Compte::class, mappedBy="paysImplantationSuccursales")
     */
    private $implantationSuccursales;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default" : false})
     */
    private $isDeleted;

    /**
     * @ORM\OneToMany(targetEntity=Compte::class, mappedBy="centreDecision")
     */
    private $comptes;

    public function __construct()
    {
        $this->implantationSuccursales = new ArrayCollection();
        $this->comptes = new ArrayCollection();
    }

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

    /**
     * @return Collection|Compte[]
     */
    public function getImplantationSuccursales(): Collection
    {
        return $this->implantationSuccursales;
    }

    public function addImplantationSuccursale(Compte $implantationSuccursale): self
    {
        if (!$this->implantationSuccursales->contains($implantationSuccursale)) {
            $this->implantationSuccursales[] = $implantationSuccursale;
            $implantationSuccursale->addPaysImplantationSuccursale($this);
        }

        return $this;
    }

    public function removeImplantationSuccursale(Compte $implantationSuccursale): self
    {
        if ($this->implantationSuccursales->contains($implantationSuccursale)) {
            $this->implantationSuccursales->removeElement($implantationSuccursale);
            $implantationSuccursale->removePaysImplantationSuccursale($this);
        }

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
     * @return Collection|Compte[]
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Compte $compte): self
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes[] = $compte;
            $compte->setCentreDecision($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): self
    {
        if ($this->comptes->contains($compte)) {
            $this->comptes->removeElement($compte);
            // set the owning side to null (unless already changed)
            if ($compte->getCentreDecision() === $this) {
                $compte->setCentreDecision(null);
            }
        }

        return $this;
    }
}
