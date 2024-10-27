<?php

namespace App\Entity;

use App\Repository\EtatProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtatProjetRepository::class)
 */
class EtatProjet
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
     * @ORM\OneToMany(targetEntity=Projets::class, mappedBy="etatProjet")
     */
    private $projets;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom_constant;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
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
     * @return Collection|Projets[]
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projets $projet): self
    {
        if (!$this->projets->contains($projet)) {
            $this->projets[] = $projet;
            $projet->setEtatProjet($this);
        }

        return $this;
    }

    public function removeProjet(Projets $projet): self
    {
        if ($this->projets->contains($projet)) {
            $this->projets->removeElement($projet);
            // set the owning side to null (unless already changed)
            if ($projet->getEtatProjet() === $this) {
                $projet->setEtatProjet(null);
            }
        }

        return $this;
    }

    public function getNomConstant(): ?string
    {
        return $this->nom_constant;
    }

    public function setNomConstant(string $nom_constant): self
    {
        $this->nom_constant = $nom_constant;

        return $this;
    }
    public function __toString()
    {
        return $this->nom;
    }
}
