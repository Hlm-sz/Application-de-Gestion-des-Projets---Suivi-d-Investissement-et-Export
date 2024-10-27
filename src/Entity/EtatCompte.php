<?php

namespace App\Entity;

use App\Repository\EtatCompteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtatCompteRepository::class)
 */
class EtatCompte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom_constant;

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

    public function getNomConstant(): ?string
    {
        return $this->nom_constant;
    }

    public function setNomConstant(string $nom_constant): self
    {
        $this->nom_constant = $nom_constant;

        return $this;
    }
}
