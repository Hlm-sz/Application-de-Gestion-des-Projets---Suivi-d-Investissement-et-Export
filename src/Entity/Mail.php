<?php

namespace App\Entity;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MailRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=MailRepository::class)
 */
class Mail
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
    private $objet;

    /**
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEnvoi;

    /**
     * @ORM\ManyToMany(targetEntity=contact::class, inversedBy="mails")
     */
    private $contact;

    public function __construct()
    {
        $this->contact = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateEnvoi(): ?\DateTimeInterface
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi(\DateTimeInterface $dateEnvoi): self
    {
        $this->dateEnvoi = $dateEnvoi;

        return $this;
    }

    /**
     * @return Collection|contact[]
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    public function setContact($contact) {
        $this->contact = new ArrayCollection($contact);
    }

    public function addContact(contact $contact): self
    {
        if (!$this->contact->contains($contact)) {
            $this->contact[] = $contact;
        }

        return $this;
    }

    public function removeContact(contact $contact): self
    {
        $this->contact->removeElement($contact);

        return $this;
    }

}
