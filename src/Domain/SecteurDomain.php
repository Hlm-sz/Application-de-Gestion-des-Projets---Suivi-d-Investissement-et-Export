<?php


namespace App\Domain;


use App\Entity\Secteur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SecteurDomain
{
    private $user;
    private $em;
    public function __construct(EntityManagerInterface $em,TokenStorageInterface $user)
    {

       if(!is_null($user->getToken())){
             $this->user=$user->getToken()->getUser();
       }
      
        $this->em=$em;
    }
    public function getSecteurByUser(){
       
        if($this->user=="anon."){
            return null;
        }
       
        $restrictions=!is_null($this->user) ? $this->user->getGroupe()->getRestrictions() : null;
        $secteurs=null;
        if($restrictions){
            $secteurs = $this->em->getRepository(Secteur::class)->findAll();
            foreach ($restrictions as $restriction){
                switch ($restriction->getId()) {
                    case 1:
                        $secteurs = $this->user->getSecteurs();
                        break;

                    case 2:
                        $secteurs = $this->em->getRepository(Secteur::class)->ListsSecteursByComptes($this->user->getId());
                        break;
                }
            }
        }else{
            $secteurs = $this->em->getRepository(Secteur::class)->findAll();
        }
        return $secteurs;
    }
    public function getProjetsBySecteurs(){
        return true;
    }
}