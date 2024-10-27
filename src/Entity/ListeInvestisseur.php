<?php

namespace App\Entity;

use App\Repository\ListeInvestisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListeInvestisseurRepository::class)
 */
class ListeInvestisseur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Compte::class, inversedBy="listeInvestisseur")
     */
    private $eventsInvestisseur;

    public function __construct()
    {
        $this->eventsInvestisseur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getEventsInvestisseur(): Collection
    {
        return $this->eventsInvestisseur;
    }

    public function addEventsInvestisseur(Compte $eventsInvestisseur): self
    {
        if (!$this->eventsInvestisseur->contains($eventsInvestisseur)) {
            $this->eventsInvestisseur[] = $eventsInvestisseur;
        }

        return $this;
    }

    public function removeEventsInvestisseur(Compte $eventsInvestisseur): self
    {
        $this->eventsInvestisseur->removeElement($eventsInvestisseur);

        return $this;
    }
}
