<?php

namespace App\Entity;

use App\Repository\ProjetsDataRepository;
use Doctrine\ORM\Mapping as ORM;
 



/**
 * @ORM\Entity(repositoryClass=ProjetsDataRepository::class)
  */
class ProjetsData
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Projets::class, inversedBy="projetsData",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $projet;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $cle;

    /**
     * @ORM\Column(type="string", length=100000,nullable=true)
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjet(): ?Projets
    {
        return $this->projet;
    }

    public function setProjet(?Projets $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    public function getCle(): ?string
    {
        return $this->cle;
    }

    public function setCle(string $cle): self
    {
        $this->cle = $cle;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
