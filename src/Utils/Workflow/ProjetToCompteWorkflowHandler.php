<?php


namespace App\Utils\Workflow;


use App\Entity\Projets;
use App\Entity\EtatProjet;
use App\Entity\Compte;
use App\Entity\EtatCompte;
use App\Services\Mailer\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Workflow\Registry;

class ProjetToCompteWorkflowHandler
{
    private $registry;
    private $manager;
    private $mailer;

  public function __construct(Registry $registry,Mailer $mailer,EntityManagerInterface $manager)
  {
      $this->registry=$registry;
      $this->manager=$manager;
      $this->mailer=$mailer;

  }
  public function Hello($compte){

            $projetsIn = $this->manager->getRepository(Projets::class)->getListeProjetByCompteIN($compte);
            $projetsDe = $this->manager->getRepository(Projets::class)->getListeProjetByCompteDE($compte);
            $projetsFe = $this->manager->getRepository(Projets::class)->getListeProjetByCompteFer($compte);
            
           if (count($projetsIn)>0 || count($projetsDe) == count($projetsIn)){
            $getEtatCompte = $this->manager->getRepository(EtatCompte::class)->findOneBy(['id'=>10]);
             $compte->setEtatCompte($getEtatCompte);
             $this->manager->persist($compte);
             $this->manager->flush();
             $this->mailer->sendMail($compte->getResponsableCompte()->getEmail(),"le compte ".$compte->getNomCompte()." change statut à Intérêt ","Changement de statut");
           }elseif(count($projetsDe)> count($projetsIn)){
            
            $getEtatCompte = $this->manager->getRepository(EtatCompte::class)->findOneBy(['id'=>11]);
            $compte->setEtatCompte($getEtatCompte);
             $this->manager->persist($compte);
             $this->manager->flush();
             $this->mailer->sendMail($compte->getResponsableCompte()->getEmail(),"le compte ".$compte->getNomCompte()." change statut à Décision","Changement de statut");
           }elseif(count($projetsFe)> count($projetsDe)){
            $getEtatCompte = $this->manager->getRepository(EtatCompte::class)->findOneBy(['id'=>12]);
            $compte->setEtatCompte($getEtatCompte);
             $this->manager->persist($compte);
             $this->manager->flush();
             $this->mailer->sendMail($compte->getResponsableCompte()->getEmail(),"le compte ".$compte->getNomCompte()." change statut à Fermé","Changement de statut");
          }
    }
}