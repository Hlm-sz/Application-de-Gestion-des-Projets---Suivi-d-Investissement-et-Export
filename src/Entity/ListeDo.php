<?php

namespace App\Entity;

use App\Repository\ListeDoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListeDoRepository::class)
 */
class ListeDo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Compte::class, inversedBy="listeDo")
     */
    private $eventsDo;

    public function __construct()
    {
        $this->eventsDo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getEventsDo(): Collection
    {
        return $this->eventsDo;
    }

    public function addEventsDo(Compte $eventsDo): self
    {
        if (!$this->eventsDo->contains($eventsDo)) {
            $this->eventsDo[] = $eventsDo;
        }

        return $this;
    }

    public function removeEventsDo(Compte $eventsDo): self
    {
        $this->eventsDo->removeElement($eventsDo);

        return $this;
    }
}
