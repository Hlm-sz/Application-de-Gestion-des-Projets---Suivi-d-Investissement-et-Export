<?php


namespace App\Utils\Workflow;


use App\Entity\Compte;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Workflow\Registry;

class CompteWorkflowHandler
{
    private $registry;
    private $manager;
  public function __construct(Registry $registry,EntityManagerInterface $manager)
  {
      $this->registry=$registry;
      $this->manager=$manager;
  }
  public function handle(Compte $compte,string $status){
      $workflow=$this->registry->get($compte);
      $em=$this->manager;
      $workflow->apply($compte,$status);
      $em->flush();
  }
}