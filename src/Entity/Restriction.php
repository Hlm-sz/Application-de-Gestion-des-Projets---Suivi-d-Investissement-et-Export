<?php

namespace App\Entity;

use App\Repository\RestrictionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RestrictionRepository::class)
 */
class Restriction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nom;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="Restrictions")
     */
    private $groupes;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nomConstant;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
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
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addRestriction($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->contains($groupe)) {
            $this->groupes->removeElement($groupe);
            $groupe->removeRestriction($this);
        }

        return $this;
    }

    public function getNomConstant(): ?string
    {
        return $this->nomConstant;
    }

    public function setNomConstant(string $nomConstant): self
    {
        $this->nomConstant = $nomConstant;

        return $this;
    }
}
