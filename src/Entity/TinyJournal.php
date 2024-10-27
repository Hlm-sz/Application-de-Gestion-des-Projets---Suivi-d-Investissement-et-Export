<?php

namespace App\Entity;

use App\Repository\TinyJournalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TinyJournalRepository::class)
 */
class TinyJournal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $CreePar;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateCreation;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Commentaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $docMou;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $docCnv;

    /**
     * @ORM\ManyToOne(targetEntity=Projets::class, inversedBy="tinyJournals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $projet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreePar(): ?User
    {
        return $this->CreePar;
    }

    public function setCreePar(?User $CreePar): self
    {
        $this->CreePar = $CreePar;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->DateCreation;
    }

    public function setDateCreation(?\DateTimeInterface $DateCreation): self
    {
        $this->DateCreation = $DateCreation;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->Commentaire;
    }

    public function setCommentaire(?string $Commentaire): self
    {
        $this->Commentaire = $Commentaire;

        return $this;
    }
    
    public function getDocMou()
    {
        return $this->docMou;
    }
    
    public function setDocMou($docMou): self
    {
        $this->docMou = $docMou;
        
        return $this;
    }

    public function getDocCnv()
    {
        return $this->docCnv;
    }
    
    public function setDocCnv($docCnv): self
    {
        $this->docCnv = $docCnv;
        
        return $this;
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
}
