<?php


namespace App\Utils\Workflow;


use App\Entity\Projets;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Workflow\Registry;

class ProjetWorkflowHandler
{
    private $registry;
    private $manager;
  public function __construct(Registry $registry,EntityManagerInterface $manager)
  {
      $this->registry=$registry;
      $this->manager=$manager;
  }
  public function handle(Projets $projet,string $status){
      $workflow=$this->registry->get($projet);
      $em=$this->manager;
      $workflow->apply($projet,$status);
      $em->flush();
  }
}