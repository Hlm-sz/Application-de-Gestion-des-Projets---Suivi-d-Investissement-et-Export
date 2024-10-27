<?php

namespace App\Entity;

use App\Repository\ListeExportateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListeExportateurRepository::class)
 */
class ListeExportateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Compte::class, inversedBy="listeExportateur")
     */
    private $eventsExportateur;

    /**
     * @ORM\ManyToMany(targetEntity=Compte::class, inversedBy="listeExportateur")
     */
    private $comptsExportateur;

    public function __construct()
    {
        $this->eventsExportateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Event[]
     */
    public function getComptsExportateur(): Collection
    {
        return $this->eventsExportateur;
    }

    public function addComptsExportateur(Event $comptsExportateur): self
    {
        if (!$this->comptsExportateur->contains($comptsExportateur)) {
            $this->comptsExportateur[] = $comptsExportateur;
        }

        return $this;
    }

    public function removeComptsExportateur(Event $comptsExportateur): self
    {
        $this->comptsExportateur->removeElement($comptsExportateur);

        return $this;
    }
    /**
     * @return Collection|Compte[]
     */
    public function getEventsExportateur(): Collection
    {
        return $this->eventsExportateur;
    }

    public function addEventsExportateur(Compte $eventsExportateur): self
    {
        if (!$this->eventsExportateur->contains($eventsExportateur)) {
            $this->eventsExportateur[] = $eventsExportateur;
        }

        return $this;
    }

    public function removeEventsExportateur(Compte $eventsExportateur): self
    {
        $this->eventsExportateur->removeElement($eventsExportateur);

        return $this;
    }

}
