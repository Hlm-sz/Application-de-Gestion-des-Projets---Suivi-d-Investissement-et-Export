<?php

namespace App\Entity;
use DateTime;
use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
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
     * @ORM\Column(type="string", length=30)
     */
    private $mois;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class)
     */
    private $pays;

    /**
    * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $secteur;

    /**
     * @ORM\Column(type="string", length=130)
     */
    private $formatParticipation;

    /**
     * @ORM\Column(type="string", length=130)
     */
    private $Organisateur;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $partenaires;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $typeEvenement;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Compte::class, inversedBy="events")
     */
    private $comptes;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="modifie_par")
     */
    private $cree_par;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="events")
     */
    private $created_by;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="events")
     */
    private $updated_by;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_valide;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $documet;

    /**
     * @ORM\ManyToOne(targetEntity=Compte::class)
     */
    //private $ListInvest;
 
    // /**
    // * @ORM\ManyToMany(targetEntity=Compte::class, inversedBy="listeDo")
    // */
    // public $listeDo;

    // /**
    // * @ORM\ManyToMany(targetEntity=Compte::class, inversedBy="listeInvestisseur")
    // */
    // public $listeInvestisseur;

    // /**
    // * @ORM\ManyToMany(targetEntity=Compte::class, inversedBy="listeExportateur")
    // */
    // public $listeExportateur;

    // add champs 
    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_procpects_invesstisseur;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_business_dev_investisseur;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_prospects_do;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_entreprises_accompagnees;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_business_dev_do;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_exportateur_do;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Compte")
     */
    //private $listeInvestisseurs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Compte")
     */
    //private $listeDO;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Compte")
     */
    //private $listeExportateurs;

    



    /**
     * @ORM\PrePersist
     *
     * @throws Exception;
     */
    public function onPrePersist(): void
    {
        
        $this->created_at = new DateTime('NOW');
    }

    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate(): void
    {
        $this->updated_at = new DateTime('NOW');
    }

    public function __construct()
    {
        $this->comptes = new ArrayCollection();
        //$this->eventsDocs = new ArrayCollection();
        //$this->listeInvestisseurs = new ArrayCollection();
        //$this->listeDO = new ArrayCollection();
        //$this->listeExportateurs = new ArrayCollection();
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

    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): self
    {
        $this->mois = $mois;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

   

    public function getFormatParticipation(): ?string 
    {
        return $this->formatParticipation;
    }

    public function setFormatParticipation(?string $formatParticipation): self
    {
        $this->formatParticipation = $formatParticipation;

        return $this;
    }

    public function getOrganisateur(): ?string
    {
        return $this->Organisateur;
    }

    public function setOrganisateur(string $Organisateur): self
    {
        $this->Organisateur = $Organisateur;

        return $this;
    }

    // public function getPartenaires(): ?string
    // {
    //     return $this->partenaires;
    // }

    // public function setPartenaires(?string $partenaires): self
    // {
    //     $this->partenaires = $partenaires;

    //     return $this;
    // }
    public function getPartenaires(): ?array
    {
        return json_decode($this->partenaires);
    }

    public function setPartenaires(array $partenaires): self
    {
        $this->partenaires = json_encode($partenaires);

        return $this;
    }
    public function getSecteur()
    {
        return json_decode($this->secteur);
    }

    public function setSecteur(array $secteur): self
    {
        $this->secteur = json_encode($secteur);

        return $this;
    }

    public function getTypeEvenement(): ?array
    {
        return json_decode($this->typeEvenement);
    }

    public function setTypeEvenement(array $typeEvenement): self
    {
        $this->typeEvenement = json_encode($typeEvenement);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
        }

        return $this;
    }
    // public function setComptes(array $comptes): void
    // {
    // $this->comptes = $comptes;
    // }

    public function removeCompte(Compte $compte): self
    {
        if ($this->comptes->contains($compte)) {
            $this->comptes->removeElement($compte);
        }

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->created_by;
    }

    public function setCreatedBy(?User $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updated_by;
    }

    public function setUpdatedBy(?User $updated_by): self
    {
        $this->updated_by = $updated_by;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getIsValide(): ?bool
    {
        return $this->is_valide;
    }

    public function setIsValide(?bool $is_valide): self
    {
        $this->is_valide = $is_valide;

        return $this;
    }
    public function getDocumet()
    {
        return $this->documet;
    }

    public function setDocumet($documet): self
    {
        $this->documet = $documet;

        return $this;
    }

    /*public function getListInvest(): ?Compte
    {
        return $this->ListInvest;
    }

    public function setListInvest(?Compte $ListInvest): self
    {
        $this->ListInvest = $ListInvest;

        return $this;
    }*/

        
    public function getNombreProcpectsInvesstisseur(): ?int
    {
        return $this->nombre_procpects_invesstisseur;
    }

    public function setNombreProcpectsInvesstisseur(int $nombre_procpects_invesstisseur): self
    {
        $this->nombre_procpects_invesstisseur = $nombre_procpects_invesstisseur;

        return $this;
    }

    public function getNombreBusinessDevInvestisseur(): ?int
    {
        return $this->nombre_business_dev_investisseur;
    }

    public function setNombreBusinessDevInvestisseur(int $nombre_business_dev_investisseur): self
    {
        $this->nombre_business_dev_investisseur = $nombre_business_dev_investisseur;

        return $this;
    }

    public function getNombreProspectsdo(): ?int
    {
        return $this->nombre_prospects_do;
    }

    public function setNombreProspectsdo(int $nombre_prospects_do): self
    {
        $this->nombre_prospects_do = $nombre_prospects_do;

        return $this;
    }

    public function getNombreEntreprisesAccompagnees(): ?int
    {
        return $this->nombre_entreprises_accompagnees;
    }

    public function setNombreEntreprisesAccompagnees(int $nombre_entreprises_accompagnees): self
    {
        $this->nombre_entreprises_accompagnees = $nombre_entreprises_accompagnees;

        return $this;
    }

    public function getNombreBusinessDevDo(): ?int
    {
        return $this->nombre_business_dev_do;
    }

    public function setNombreBusinessDevDo(int $nombre_business_dev_do): self
    {
        $this->nombre_business_dev_do = $nombre_business_dev_do;

        return $this;
    }

    public function getNombreExportateurDo(): ?int
    {
        return $this->nombre_exportateur_do;
    }

    public function setNombreExportateurDo(int $nombre_exportateur_do): self
    {
        $this->nombre_exportateur_do = $nombre_exportateur_do;

        return $this;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getListeInvestisseurs(): Collection
    {
        return $this->comptes;
        //return new ArrayCollection();;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getListeDO(): Collection
    {
        //return $this->listeDO;
        return $this->comptes;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getListeExportateurs(): Collection
    {
        //return $this->listeExportateurs;
        return $this->comptes;
    }

    
    
}
