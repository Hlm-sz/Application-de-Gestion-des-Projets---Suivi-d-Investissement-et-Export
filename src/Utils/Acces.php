<?php

namespace App\Utils;

use App\Entity\AccesGroupe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class Acces
{
    private $em;
    private $user;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->user = $security->getUser();
    }

    public function has_acces(string $acces)
    {

        if (!$this->user) {
            return false;
        }

        $id_groupe = $this->user->getGroupe()->getId();

        return $this->em->getRepository(AccesGroupe::class)->isAccesByGroupe($acces, $id_groupe) ? true : false;
    }
}
