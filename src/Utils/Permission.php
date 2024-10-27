<?php

namespace App\Utils;

use App\Entity\Groupe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class Permission
{
    private $em;
    private $user;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->user = $security->getUser();
    }

    public function has_permission(string $acces)
    {
        if ($this->user) {
            $id_groupe = $this->user->getGroupe()->getId();
            //dd( $this->user->getRoles());
            return $this->em->getRepository(Groupe::class)->isPermissionGroupe($acces, $id_groupe) ? true : false;
        }
        return false;
    }
}
