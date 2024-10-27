<?php

namespace App\Entity;

use App\Repository\CarteVisiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarteVisiteRepository::class)
 */
class CarteVisite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @ORM\ManyToOne(targetEntity=Fonction::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $fonction;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $tel2;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $web;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPrincipale;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Compte::class, inversedBy="carteVisites")
     * @ORM\JoinColumn(nullable=true)
     */
    private $compte;

    /**
     * @ORM\ManyToOne(targetEntity=Contact::class, inversedBy="carteVisites")
     */
    private $contact;

     /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $organisation;
    
    /**
     * @ORM\ManyToOne(targetEntity=Profils::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $profil;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $compte_autre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFonction(): ?Fonction
    {
        return $this->fonction;
    }
  
    public function setFonction(?Fonction $fonction): self
    {
        $this->fonction = $fonction;
  
        return $this;
    }
  

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getTel2(): ?string
    {
        return $this->tel2;
    }

    public function setTel2(?string $tel2): self
    {
        $this->tel2 = $tel2;

        return $this;
    }

    public function getWeb(): ?string
    {
        return $this->web;
    }

    public function setWeb(?string $web): self
    {
        $this->web = $web;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

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

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getCompteAutre(): ?string
    {
        return $this->compte_autre;
    }

    public function setCompteAutre(?string $compte_autre): self
    {
        $this->compte_autre = $compte_autre;

        return $this;
    }
    
    public function getIsPrincipale(): ?bool
    {
        return $this->isPrincipale;
    }

    public function setIsPrincipale(bool $isPrincipale): self
    {
        $this->isPrincipale = $isPrincipale;

        return $this;
    }
    public function getOrganisation(): ?string
    {
        return $this->organisation;
    }

    public function setOrganisation(string $organisation): self
    {
        $this->organisation = $organisation;

        return $this;
    }

    public function getProfil(): ?Profils
    {
        return $this->profil;
    }

    public function setProfil(?Profils $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

}
