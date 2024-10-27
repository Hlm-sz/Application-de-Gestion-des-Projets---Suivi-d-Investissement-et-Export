<?php

namespace App\Entity;

use App\Repository\ProjetsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProjetsRepository::class)
 */
class Projets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Compte::class, inversedBy="projets")
     */
    private $compte;
    

    /**
     * @ORM\OneToMany(targetEntity=ProjetsData::class, mappedBy="projet",cascade={"persist"})
     */
    private $projetsData;

    /**
     * @ORM\ManyToOne(targetEntity=TypeProjet::class, inversedBy="projets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeProjet;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="projets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $gere_par;

    /**
     * @ORM\ManyToOne(targetEntity=EtatProjet::class, inversedBy="projets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etatProjet;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $GPAC;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $ActionGPAC;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * 
     */
    private $titre;


    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $status = [];

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $cree_par;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $date_creation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $modifie_par;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dateModification;

    /**
     * @ORM\OneToMany(targetEntity=LogProjet::class, mappedBy="projet")
     */
    private $logProjets;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDeleted;

    /**
     * @ORM\OneToMany(targetEntity=TinyJournal::class, mappedBy="projet", orphanRemoval=true)
     */
    private $tinyJournals;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Confidentiel;



    public function __construct()
    {
        $this->projetsData = new ArrayCollection();
        $this->logProjets = new ArrayCollection();
        $this->tinyJournals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

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

    /**
     * @return Collection|ProjetsData[]
     */
    public function getProjetsData(): Collection
    {
        return $this->projetsData;
    }

    public function addProjetsData(ProjetsData $projetsData): self
    {
        if (!$this->projetsData->contains($projetsData)) {
            $this->projetsData[] = $projetsData;
            $projetsData->setProjet($this);
        }

        return $this;
    }

    public function removeProjetsData(ProjetsData $projetsData): self
    {
        if ($this->projetsData->contains($projetsData)) {
            $this->projetsData->removeElement($projetsData);
            // set the owning side to null (unless already changed)
            if ($projetsData->getProjet() === $this) {
                $projetsData->setProjet(null);
            }
        }

        return $this;
    }

    public function getTypeProjet(): ?TypeProjet
    {
        return $this->typeProjet;
    }

    public function setTypeProjet(?TypeProjet $typeProjet): self
    {
        $this->typeProjet = $typeProjet;

        return $this;
    }

    public function getGerePar(): ?User
    {
        return $this->gere_par;
    }

    public function setGerePar(?User $gere_par): self
    {
        $this->gere_par = $gere_par;

        return $this;
    }

    public function getEtatProjet(): ?EtatProjet
    {
        return $this->etatProjet;
    }

    public function setEtatProjet(?EtatProjet $etatProjet): self
    {
        $this->etatProjet = $etatProjet;

        return $this;
    }
    
    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
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
    public function getActionGPAC(): ?bool
    {
        return $this->ActionGPAC;
    }

    public function setActionGPAC(?bool $ActionGPAC): self
    {
        $this->ActionGPAC = $ActionGPAC;
        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

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

    public function getCreePar(): ?User
    {
        return $this->cree_par;
    }

    public function setCreePar(?User $cree_par): self
    {
        $this->cree_par = $cree_par;

        return $this;
    }

    public function getModifiePar(): ?User
    {
        return $this->modifie_par;
    }

    public function setModifiePar(?User $modifie_par): self
    {
        $this->modifie_par = $modifie_par;

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
     * @return Collection|LogProjet[]
     */
    public function getLogProjets(): Collection
    {
        return $this->logProjets;
    }

    public function addLogProjet(LogProjet $logProjet): self
    {
        if (!$this->logProjets->contains($logProjet)) {
            $this->logProjets[] = $logProjet;
            $logProjet->setProjet($this);
        }

        return $this;
    }

    public function removeLogProjet(LogProjet $logProjet): self
    {
        if ($this->logProjets->contains($logProjet)) {
            $this->logProjets->removeElement($logProjet);
            // set the owning side to null (unless already changed)
            if ($logProjet->getProjet() === $this) {
                $logProjet->setProjet(null);
            }
        }

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
     * @return Collection|TinyJournal[]
     */
    public function getTinyJournals(): Collection
    {
        return $this->tinyJournals;
    }

    public function addTinyJournal(TinyJournal $tinyJournal): self
    {
        if (!$this->tinyJournals->contains($tinyJournal)) {
            $this->tinyJournals[] = $tinyJournal;
            $tinyJournal->setProjet($this);
        }

        return $this;
    }

    public function removeTinyJournal(TinyJournal $tinyJournal): self
    {
        if ($this->tinyJournals->removeElement($tinyJournal)) {
            // set the owning side to null (unless already changed)
            if ($tinyJournal->getProjet() === $this) {
                $tinyJournal->setProjet(null);
            }
        }

        return $this;
    }

    public function getConfidentiel(): ?bool
    {
        return $this->Confidentiel;
    }

    public function setConfidentiel(bool $Confidentiel): self
    {
        $this->Confidentiel = $Confidentiel;

        return $this;
    }
    
}
