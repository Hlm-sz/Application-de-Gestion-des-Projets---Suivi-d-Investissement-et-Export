<?php

namespace App\Utils\Doctrine\Selector;

use App\Entity\Compte;
use App\Entity\Groupe;
use App\Entity\Secteur;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class CompteSelector
{
    private $user;
    private $permission;
    private $options;
    private $em;

    public function __construct(Security $user, string $permission = null, array $options = [], EntityManagerInterface $em)
    {
        $this->user = $user->getUser();
        $this->permission = $permission;
        $this->options = $options;
        $this->em = $em;
    }
    public function getIdsListe()
    {
        return $this->addQuery();
    }

    private function addQuery()
    {
        $groupe = $this->user->getGroupe()->getId();
        $restriction = $this->em->getRepository(Groupe::class)->getRestrictionByUser($this->getPermission(), $groupe);
        if($restriction){
            if($restriction['id']=1){
                return $this->getComptesParSecteurs();
            }elseif($restriction['id']=2){
                return $this->getSecteursByUser();
            }    
        }
        
    }


    private function getComptesParSecteurs()
    {
        $listsSecteurs = $this->em->getRepository(User::class)->getISecteursByUser($this->user->getId());
        $comptes = $this->em->getRepository(Compte::class)->listsCompteBySeteurs($listsSecteurs);
        return $comptes;
    }

    private function getSecteursByUser()
    {
       // $listsSecteurs = $this->em->getRepository(Secteur::class)->ListsIdesSecteursByComptes($this->user->getId());
        $comptes = $this->em->getRepository(Compte::class)->findBy(['responsableCompte'=>$this->user->getId()]);
       
        return $comptes;
    }
    /*

    public function isPermission($permission, $id_table)
    {
    }
    private function isExiste()
    {
        $groupe = $this->user->getGroupe()->getId();
        $restriction = $this->em->getRepository(Groupe::class)->getRestrictionByUser($this->getPermission(), $groupe);

        switch ($restriction['id']) {
            case 1:
                return $this->getComptesParSecteurs();
                break;
            case 2:
                return $this->getSecteursByUser();
                break;
        }
    }*/

    /**
     * Get the value of table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * Set the value of table
     *
     * @return  self
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Get the value of permission
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set the value of permission
     *
     * @return  self
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get the value of options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the value of options
     *
     * @return  self
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }
}
