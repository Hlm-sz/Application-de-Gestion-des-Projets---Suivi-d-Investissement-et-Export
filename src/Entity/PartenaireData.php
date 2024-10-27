<?php

namespace App\Entity;

use App\Entity\Partenaire;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PartenaireDataRepository;

/**
 * @ORM\Entity(repositoryClass=PartenaireDataRepository::class)
 */
class PartenaireData
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
    private $cle;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=Partenaire::class, inversedBy="PartenaireData")
     * @ORM\JoinColumn(nullable=false)
     */
    private $partenaire;

    public function getId(): ?int
    {
        return $this->id;
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

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }
    public function getPartenaire(): ?Partenaire
    {
        return $this->Partenaire;
    }

    public function setPartenaire(?Partenaire $partenaire): self
    {
        $this->partenaire = $partenaire;

        return $this;
    }


   
}
