<?php

namespace App\Entity;

use App\Repository\CompteDataRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompteDataRepository::class)
 */
class CompteData
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
     * @ORM\Column(type="string", length=100000, nullable=true)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=Compte::class, inversedBy="contactData")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compte;

//    /**
//     * @ORM\ManyToMany (targetEntity=Contact::class)
//     */
//    private $contacts;

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

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }


}
