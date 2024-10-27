<?php

namespace App\Subscribers;

use App\Entity\Projets;
use App\Entity\ProjetsData;
use App\Entity\EtatCompte;
use App\Utils\Workflow\ProjetWorkflowHandler;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ProjetSubscriber implements EventSubscriber
{

    private $user;
    private $em;
    private $pwh;

    public function __construct(EntityManagerInterface $em,TokenStorageInterface $user,ProjetWorkflowHandler $pwh)
    {
        $this->user=$user;
        $this->em=$em;
        $this->pwh=$pwh;
    }
    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }


    public function prePersist(LifecycleEventArgs $args)
    {

        $entity = $args->getEntity();

        if ($entity instanceof Projets) {
            $getEtatCompte = $this->em->getRepository(EtatCompte::class)->findOneBy(['id'=>10]);
            $compte = $entity->getCompte();
            $compte->setEtatCompte($getEtatCompte);
            $this->em->persist($compte);
           $user_token = $this->user->getToken()->getUser();
           $entity->setCreePar($user_token);
           $entity->setDateCreation(new \DateTimeImmutable());
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {


        $entity = $args->getEntity();
        if ($entity instanceof ProjetsData) {
            $user_token = $this->user->getToken()->getUser();
            $projet=$entity->getProjet();
            $projet->setModifiePar($user_token);
            $projet->setDateModification(new \DateTimeImmutable());
            $this->em->persist($projet);
        }
    }
}
