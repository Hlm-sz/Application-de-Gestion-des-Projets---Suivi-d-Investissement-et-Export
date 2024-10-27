<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;




/**
 * @ORM\Entity(repositoryClass=CompteRepository::class)
 *@UniqueEntity("nomCompte")

 */
class Compte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, name="nom_compte")
     */
    private $nomCompte;

    /**
     * @ORM\Column(type="boolean")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=TypeCompte::class)
     * @ORM\JoinColumn(referencedColumnName="id",nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class)
     */
    private $paysSiege;

    /**
     * @ORM\ManyToMany(targetEntity=Pays::class, inversedBy="implantationSuccursales")
     */
    private $paysImplantationSuccursales;

    /**
     * @ORM\ManyToMany(targetEntity=Secteur::class, inversedBy="comptes")
     */
    private $secteurs;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $chiffreAffaires;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $detailLibre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $signalement;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comptes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $responsableCompte;

    /**
     * @ORM\ManyToOne(targetEntity=EtatCompte::class)
     */
    private $etatCompte;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDeleted;

    /**
     * @ORM\OneToMany(targetEntity=CarteVisite::class, mappedBy="compte")
     */
    private $carteVisites;

    /**
     * @ORM\OneToMany(targetEntity=Projets::class, mappedBy="compte")
     */
    private $projets;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $ca_export;

    

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="comptes")
     */
    private $centreDecision;

    /**
     * @ORM\ManyToMany(targetEntity=Contact::class, inversedBy="comptes")
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $creePar;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dateCreation; 

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $modifiePar;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dateModification;

    /**
     * @ORM\OneToMany(targetEntity=CompteData::class, mappedBy="compte",cascade={"persist"})
     */
    private $compteData;

    /**
     * @ORM\ManyToMany(targetEntity=Event::class, mappedBy="comptes")
     */
    private $events;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $status = [];

    /**
     * @ORM\OneToMany(targetEntity=LogCompte::class, mappedBy="compte")
     */
    private $logComptes;

    /**
     * @ORM\OneToMany(targetEntity=Contact::class, mappedBy="compte")
     */
    private $contacts;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $GPAC;

    /**
     * @ORM\ManyToOne(targetEntity=EcosystemeFiliere::class, inversedBy="comptes")
     */
    private $ecosystemeFiliere;

    // /**
    //  * @ORM\ManyToMany(targetEntity=ListeDo::class, mappedBy="eventsDo")
    //  */
    // private $listeDo;

    // /**
    //  * @ORM\ManyToMany(targetEntity=ListeInvestisseur::class, mappedBy="eventsInvestisseur")
    //  */
    // private $listeInvestisseur;

    // /**
    //  * @ORM\ManyToMany(targetEntity=ListeExportateur::class, mappedBy="listeExportateur")
    //  */
    // private $listeExportateur;

    /**
     *
     */


    
    public function __construct()
    {
        $this->paysImplantationSuccursales = new ArrayCollection();
        $this->secteurs = new ArrayCollection();
        $this->carteVisites = new ArrayCollection();
        $this->projets = new ArrayCollection();
        $this->contact = new ArrayCollection();
        $this->compteData = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->logComptes = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        // $this->listeDo = new ArrayCollection();
        // $this->listeInvestisseur = new ArrayCollection();
        // $this->listeExportateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCompte(): ?string
    {
        return $this->nomCompte;
    }

    public function setNomCompte(string $nomCompte): self
    {
        $this->nomCompte = $nomCompte;

        return $this;
    }

    public function getCategorie(): ?bool
    {
        return $this->categorie;
    }

    public function setCategorie(bool $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getType(): ?typeCompte
    {
        return $this->type;
    }

    public function setType(?typeCompte $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPaysSiege(): ?pays
    {
        return $this->paysSiege;
    }

    public function setPaysSiege(?pays $paysSiege): self
    {
        $this->paysSiege = $paysSiege;

        return $this;
    }

    /**
     * @return Collection|pays[]
     */
    public function getPaysImplantationSuccursales(): Collection
    {
        return $this->paysImplantationSuccursales;
    }

    public function addPaysImplantationSuccursale(pays $paysImplantationSuccursale): self
    {
        if (!$this->paysImplantationSuccursales->contains($paysImplantationSuccursale)) {
            $this->paysImplantationSuccursales[] = $paysImplantationSuccursale;
        }

        return $this;
    }

    public function removePaysImplantationSuccursale(pays $paysImplantationSuccursale): self
    {
        if ($this->paysImplantationSuccursales->contains($paysImplantationSuccursale)) {
            $this->paysImplantationSuccursales->removeElement($paysImplantationSuccursale);
        }

        return $this;
    }

    /**
     * @return Collection|secteur[]
     */
    public function getSecteurs(): Collection
    {
        return $this->secteurs;
    }

    public function addSecteur(Secteur $secteur): self
    {
        if (!$this->secteurs->contains($secteur)) {
            $this->secteurs[] = $secteur;
        }

        return $this;
    }

    public function removeSecteur(Secteur $secteur): self
    {
        if ($this->secteurs->contains($secteur)) {
            $this->secteurs->removeElement($secteur);
        }

        return $this;
    }

    public function getChiffreAffaires(): ?string
    {
        return $this->chiffreAffaires;
    }

    public function setChiffreAffaires(?string $chiffreAffaires): self
    {
        $this->chiffreAffaires = $chiffreAffaires;

        return $this;
    }

    public function getDetailLibre(): ?string
    {
        return $this->detailLibre;
    }

    public function setDetailLibre(?string $detailLibre): self
    {
        $this->detailLibre = $detailLibre;

        return $this;
    }

    public function getSignalement(): ?bool
    {
        return $this->signalement;
    }

    public function setSignalement(bool $signalement): self
    {
        $this->signalement = $signalement;

        return $this;
    }

    public function getResponsableCompte(): ?user
    {
        return $this->responsableCompte;
    }

    public function setResponsableCompte(?user $responsableCompte): self
    {
        $this->responsableCompte = $responsableCompte;

        return $this;
    }

    public function getEtatCompte(): ?etatCompte
    {
        return $this->etatCompte;
    }

    public function setEtatCompte(?etatCompte $etatCompte): self
    {
        $this->etatCompte = $etatCompte;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

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
            $carteVisite->setCompte($this);
        }

        return $this;
    }

    public function removeCarteVisite(CarteVisite $carteVisite): self
    {
        if ($this->carteVisites->contains($carteVisite)) {
            $this->carteVisites->removeElement($carteVisite);
            // set the owning side to null (unless already changed)
            if ($carteVisite->getCompte() === $this) {
                $carteVisite->setCompte(null);
            }
        }

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
            $projet->setCompte($this);
        }

        return $this;
    }

    public function removeProjet(Projets $projet): self
    {
        if ($this->projets->contains($projet)) {
            $this->projets->removeElement($projet);
            // set the owning side to null (unless already changed)
            if ($projet->getCompte() === $this) {
                $projet->setCompte(null);
            }
        }

        return $this;
    }

    public function getCaExport(): ?string
    {
        return $this->ca_export;
    }

    public function setCaExport(?string $ca_export): self
    {
        $this->ca_export = $ca_export;

        return $this;
    }

    public function getCentreDecision(): ?Pays
    {
        return $this->centreDecision;
    }

    public function setCentreDecision(?Pays $centreDecision): self
    {
        $this->centreDecision = $centreDecision;

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contact->contains($contact)) {
            $this->contact[] = $contact;
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contact->contains($contact)) {
            $this->contact->removeElement($contact);
        }

        return $this;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getCreePar(): ?User
    {
        return $this->creePar;
    }

    public function setCreePar(?User $creePar): self
    {
        $this->creePar = $creePar;

        return $this;
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

    public function getModifiePar(): ?User
    {
        return $this->modifiePar;
    }

    public function setModifiePar(?User $modifiePar): self
    {
        $this->modifiePar = $modifiePar;

        return $this;
    }

    public function getDateModification(): ?\DateTimeImmutable
    {
        return $this->dateModification;
    }

    public function setDateModification(?\DateTimeImmutable $dateModification): self
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    /**
     * @return Collection|CompteData[]
     */
    public function getCompteData(): Collection
    {
        return $this->compteData;
    }

    public function addCompteData(CompteData $compteData): self
    {
        if (!$this->compteData->contains($compteData)) {
            $this->compteData[] = $compteData;
            $compteData->setCompte($this);
        }

        return $this;
    }

    public function removeCompteData(CompteData $compteData): self
    {
        if ($this->compteData->contains($compteData)) {
            $this->compteData->removeElement($compteData);
            // set the owning side to null (unless already changed)
            if ($compteData->getCompte() === $this) {
                $compteData->setCompte(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->events->contains($event)) {
            $this->events[] = $event;
            $event->addCompte($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->events->contains($event)) {
            $this->events->removeElement($event);
            $event->removeCompte($this);
        }

        return $this;
    }

    public function getStatus(): ?array
    {
        return $this->status;
    }

    public function setStatus(?array $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|LogCompte[]
     */
    public function getLogComptes(): Collection
    {
        return $this->logComptes;
    }

    public function addLogCompte(LogCompte $logCompte): self
    {
        if (!$this->logComptes->contains($logCompte)) {
            $this->logComptes[] = $logCompte;
            $logCompte->setCompte($this);
        }

        return $this;
    }

    public function removeLogCompte(LogCompte $logCompte): self
    {
        if ($this->logComptes->contains($logCompte)) {
            $this->logComptes->removeElement($logCompte);
            // set the owning side to null (unless already changed)
            if ($logCompte->getCompte() === $this) {
                $logCompte->setCompte(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nomCompte;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }
    public function getGPAC(): ?bool
    {
        return $this->GPAC;
    }

    public function setGPAC(?bool $GPAC): self
    {
        $this->GPAC = $GPAC;
        return $this;
    }

    public function getEcosystemeFiliere(): ?EcosystemeFiliere
    {
        return $this->ecosystemeFiliere;
    }

    public function setEcosystemeFiliere(?EcosystemeFiliere $ecosystemeFiliere): self
    {
        $this->ecosystemeFiliere = $ecosystemeFiliere;

        return $this;
    }

    // /**
    //  * @return Collection|listeDo[]
    //  */
    // public function getListeDo(): Collection
    // {
    //     return $this->listeDo;
    // }

    // public function addListeDo(listeDo $listeDo): self
    // {
    //     if (!$this->listeDo->contains($listeDo)) {
    //         $this->listeDo[] = $listeDo;
    //         $listeDo->addEventsDo($this);
    //     }

    //     return $this;
    // }

    // public function removeListeDo(listeDo $listeDo): self
    // {
    //     if ($this->listeDo->removeElement($listeDo)) {
    //         $listeDo->removeEventsDo($this);
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection|ListeInvestisseur[]
    //  */
    // public function getListeInvestisseur(): Collection
    // {
    //     return $this->listeInvestisseur;
    // }

    // public function addListeInvestisseur(ListeInvestisseur $listeInvestisseur): self
    // {
    //     if (!$this->listeInvestisseur->contains($listeInvestisseur)) {
    //         $this->listeInvestisseur[] = $listeInvestisseur;
    //         $listeInvestisseur->addEventsInvestisseur($this);
    //     }

    //     return $this;
    // }

    // public function removeListeInvestisseur(ListeInvestisseur $listeInvestisseur): self
    // {
    //     if ($this->listeInvestisseur->removeElement($listeInvestisseur)) {
    //         $listeInvestisseur->removeEventsInvestisseur($this);
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection|ListeExportateur[]
    //  */
    // public function getListeExportateur(): Collection
    // {
    //     return $this->listeExportateur;
    // }

    // public function addListeExportateur(ListeExportateur $listeExportateur): self
    // {
    //     if (!$this->listeExportateur->contains($listeExportateur)) {
    //         $this->listeExportateur[] = $listeExportateur;
    //         $listeExportateur->addEventsExportateur($this);
    //     }

    //     return $this;
    // }

    // public function removeListeExportateur(ListeExportateur $listeExportateur): self
    // {
    //     if ($this->listeExportateur->removeElement($listeExportateur)) {
    //         $listeExportateur->removeEventsExportateur($this);
    //     }

    //     return $this;
    // }


}
