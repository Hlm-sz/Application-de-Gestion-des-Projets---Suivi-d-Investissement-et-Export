<?php


namespace App\EventListener\Workflow;


use App\Entity\EtatCompte;
use App\Entity\LogCompte;
use App\Mailing\ProjetMails;
use App\Services\Mailer\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Workflow\Event\Event;

class CompteEventListener implements EventSubscriberInterface
{
    private $logger;
    private $mailer;
    private $user;
    private $em;
    public function __construct(LoggerInterface $logger,EntityManagerInterface $manager,Security $security,Mailer $mailer)
    {
        $this->logger = $logger;
        $this->mailer=$mailer;
        $this->user=$security;
        $this->em=$manager;
    }

    public static function getSubscribedEvents()
    {
        return [
            'workflow.status_compte.leave' => 'onLeaved',
        ];
    }

    public function onLeaved(Event $event)
    {
        $from=$this->em->getRepository(EtatCompte::class)->findOneBy(['nom_constant'=> implode(', ', array_keys($event->getMarking()->getPlaces()))]);
        $to=$this->em->getRepository(EtatCompte::class)->findOneBy(['nom_constant'=>implode(', ', $event->getTransition()->getTos())]);
           
         if($to->getId() != 7){
             
             $logCompte=new LogCompte();
             $logCompte->setCreePar($this->user->getUser());
             $logCompte->setStatus($to->getNom());
             $logCompte->setDateCreation(new \DateTimeImmutable());
             $logCompte->setCompte($event->getSubject());
             $commentaire=$this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a créé un compte";
              if($from!=null){
                  $commentaire=$this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut du compte ".$from->getNom()." a ".$to->getNom();
              }
              $logCompte->setCommentaire($commentaire);
              $logCompte->setCompte($event->getSubject());
              $this->em->persist($logCompte);
              $message=$this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut du compte (".$event->getSubject()->getNomCompte().") a ".$to->getNom();
            //   $this->mailer->sendMail($this->user->getUser()->getEmail(),$message,"le compte : ".$event->getSubject()->getNomCompte()." (Changement Status)");
  
             $this->em->persist($logCompte);
             $this->em->flush();
        }

    }

}