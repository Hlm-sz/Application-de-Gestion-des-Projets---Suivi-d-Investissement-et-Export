<?php

namespace App\Utils\Doctrine\Selector;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class FactorySelector
{
    private $em;
    private $user;
    public function __construct(EntityManagerInterface $em, Security $user)
    {
        $this->em = $em;
        $this->user = $user;
    }
    public function getIdsListe(string $table, string $permission = null, array $options = [])
    {
        $em = $this->em;
        $classe = $this->getClasse($table, $permission, $options, $em);
        return $classe->getIdsListe();
    }
    public function getClasse($table, $permission, $options)
    {
        switch ($table) {
            case 'Compte':
                return new CompteSelector($this->user, $permission, $options, $this->em);
                break;

            default:
                # code...
                break;
        }
    }

    public function isPermission(string $table, int $id_table)
    {
        $classe = $this->getClasse($table, $permission = null, $options = ['id' => $id_table]);
        return $classe->isPermission($permission, $id_table);
    }
    public function getGroupe()
    {
        return null;
    }
}
