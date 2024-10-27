<?php

namespace App\Entity;

use App\Repository\ContactDataRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactDataRepository::class)
 */
class ContactData
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
     * @ORM\ManyToOne(targetEntity=Contact::class, inversedBy="contactData")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contact;

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
    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }


   
}
