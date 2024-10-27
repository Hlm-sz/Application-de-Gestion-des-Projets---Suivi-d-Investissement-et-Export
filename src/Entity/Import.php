<?php

namespace App\Entity;

use App\Repository\ImportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImportRepository::class)
 */
class Import
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
    private $object;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ids_objects;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $creePar;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $file;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isValider;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObject(): ?string
    {
        return $this->object;
    }

    public function setObject(string $object): self
    {
        $this->object = $object;

        return $this;
    }

    public function getIdsObjects(): ?string
    {
        return $this->ids_objects;
    }

    public function setIdsObjects(?string $ids_objects): self
    {
        $this->ids_objects = $ids_objects;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeImmutable
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeImmutable $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

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

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getIsValider(): ?bool
    {
        return $this->isValider;
    }

    public function setIsValider(?bool $isValider): self
    {
        $this->isValider = $isValider;

        return $this;
    }
}
