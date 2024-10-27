<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 * @UniqueEntity("nom")
 */
class Groupe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank
     */
    private $nom;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDeleted;

    /**
     * @ORM\ManyToMany(targetEntity=Role::class, inversedBy="groupes")
     */
    private $roles;

    /**
     * @ORM\ManyToMany(targetEntity=Restriction::class, inversedBy="groupes")
     */
    private $Restrictions;


    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->Restrictions = new ArrayCollection();
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
     * @return Collection|Role[]
     */
    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Role $role): self
    {
        if (!$this->roles->contains($role)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->roles->contains($role)) {
            $this->roles->removeElement($role);
        }

        return $this;
    }

    /**
     * @return Collection|Restriction[]
     */
    public function getRestrictions(): Collection
    {
        return $this->Restrictions;
    }

    public function addRestriction(Restriction $restriction): self
    {
        if (!$this->Restrictions->contains($restriction)) {
            $this->Restrictions[] = $restriction;
        }

        return $this;
    }

    public function removeRestriction(Restriction $restriction): self
    {
        if ($this->Restrictions->contains($restriction)) {
            $this->Restrictions->removeElement($restriction);
        }

        return $this;
    }
}
