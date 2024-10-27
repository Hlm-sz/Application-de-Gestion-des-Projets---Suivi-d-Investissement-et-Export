<?php

namespace App\Entity;

use App\Entity\Mail;
use App\Repository\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 * @UniqueEntity("email")
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $prenom;
    
    //  /**
    //  * @ORM\Column(type="string", length=250, nullable=true)
    //  */
    // private $organisation;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Profils::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $profil;

    /**
     * @ORM\ManyToOne(targetEntity=Canal::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $canal;

    /**
     * @ORM\Column(type="boolean")
     */
    private $exclusif;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $langugePrincipale;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $langueSecondaire;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $detailsLibres;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="contacts")
     */
    private $responsableContact;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isArchived = false;

    /**
     * @ORM\OneToMany(targetEntity=CarteVisite::class, mappedBy="contact", cascade={"persist"})
     */
    private $carteVisites;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Assert\Length(
     *      min = 0,
     *      max = 15,
     *      minMessage = "Numéro de tel non valide",
     *      maxMessage = "Numéro de tel non valide"
     * )
     */
    private $tel;

    /**
     * @ORM\ManyToMany(targetEntity=Compte::class, mappedBy="contact")
     */
    private $comptes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

    /**
     * @ORM\OneToMany(targetEntity=ContactData::class, mappedBy="contact",cascade={"persist"})
     */
    private $contactData;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPartenaire;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToMany(targetEntity=Mail::class, mappedBy="contact")
     */
    private $mails;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dateCreation;

     /**
     * @ORM\ManyToOne(targetEntity=Fonction::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $fonction;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $cree_par;



    public function __construct()
    {
        $this->carteVisites = new ArrayCollection();
        $this->comptes = new ArrayCollection();
        $this->contactData = new ArrayCollection();
        $this->mails = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }
    // public function getOrganisation(): ?string
    // {
    //     return $this->organisation;
    // }

    // public function setOrganisation(string $organisation): self
    // {
    //     $this->organisation = $organisation;

    //     return $this;
    // }
    

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

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

    public function getCanal(): ?Canal
    {
        return $this->canal;
    }

    public function setCanal(?Canal $canal): self
    {
        $this->canal = $canal;

        return $this;
    }

    public function getExclusif(): ?bool
    {
        return $this->exclusif;
    }

    public function setExclusif(bool $exclusif): self
    {
        $this->exclusif = $exclusif;

        return $this;
    }

    public function getLangugePrincipale(): ?string
    {
        return $this->langugePrincipale;
    }

    public function setLangugePrincipale(string $langugePrincipale): self
    {
        $this->langugePrincipale = $langugePrincipale;

        return $this;
    }

    public function getLangueSecondaire(): ?string
    {
        return $this->langueSecondaire;
    }

    public function setLangueSecondaire(?string $langueSecondaire): self
    {
        $this->langueSecondaire = $langueSecondaire;

        return $this;
    }

    public function getDetailsLibres(): ?string
    {
        return $this->detailsLibres;
    }

    public function setDetailsLibres(?string $detailsLibres): self
    {
        $this->detailsLibres = $detailsLibres;

        return $this;
    }

    public function getResponsableContact(): ?User
    {
        return $this->responsableContact;
    }

    public function setResponsableContact(?User $responsableContact): self
    {
        $this->responsableContact = $responsableContact;

        return $this;
    }

    public function getIsArchived(): ?bool
    {
        return $this->isArchived;
    }

    public function setIsArchived(bool $isArchived): self
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    /**
     * @return Collection|CarteVisite[]
     */
    public function getCarteVisites(): Collection
    {
        return $this->carteVisites;
    }

    public function addCarteVisite(CarteVisite $carteVisite): self
    {
        if (!$this->carteVisites->contains($carteVisite)) {
            $this->carteVisites[] = $carteVisite;
            $carteVisite->setContact($this);
        }

        return $this;
    }

    public function removeCarteVisite(CarteVisite $carteVisite): self
    {
        if ($this->carteVisites->contains($carteVisite)) {
            $this->carteVisites->removeElement($carteVisite);
            // set the owning side to null (unless already changed)
            if ($carteVisite->getContact() === $this) {
                $carteVisite->setContact(null);
            }
        }

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

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

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
            $compte->addContact($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): self
    {
        if ($this->comptes->contains($compte)) {
            $this->comptes->removeElement($compte);
            $compte->removeContact($this);
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    /**
     * @return Collection|ContactData[]
     */
    public function getContactData(): Collection
    {
        return $this->contactData;
    }

    public function addContactData(ContactData $contactData): self
    {
        if (!$this->contactData->contains($contactData)) {
            $this->contactData[] = $contactData;
            $contactData->setContact($this);
        }

        return $this;
    }
    public function removeContactData(ContactData $contactData): self
    {
        if ($this->contactData->contains($contactData)) {
            $this->contactData->removeElement($contactData);
            // set the owning side to null (unless already changed)
            if ($contactData->getContact() === $this) {
                $contactData->setContact(null);
            }
        }

        return $this;
    }

    public function getIsPartenaire(): ?bool
    {
        return $this->isPartenaire;
    }

    public function setIsPartenaire(bool $isPartenaire): self
    {
        $this->isPartenaire = $isPartenaire;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
    /**
   * @return Collection|Mail[]
   */
  public function getMails(): Collection
  {
      return $this->mails;
  }

  public function addMail(Mail $mail): self
  {
      if (!$this->mails->contains($mail)) {
          $this->mails[] = $mail;
          $mail->addContact($this);
      }

      return $this;
  }

  public function removeMail(Mail $mail): self
  {
      if ($this->mails->removeElement($mail)) {
          $mail->removeContact($this);
      }

      return $this;
  }
  public function nomcomplet()
  {
      return $this->getNom().' '.$this->getPrenom();
  }
  
  public function getDateCreation(): ?\DateTimeImmutable
  {
      return $this->dateCreation;
  }

  public function setDateCreation(?\DateTimeImmutable $dateCreation): self
  {
      $this->dateCreation = $dateCreation;

      return $this;
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

  public function getCreePar(): ?User
    {
        return $this->cree_par;
    }

    public function setCreePar(?User $cree_par): self
    {
        $this->cree_par = $cree_par;

        return $this;
    }

   



}
