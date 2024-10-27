<?php


namespace App\EventListener\Workflow;


use App\Entity\EtatProjet;
use App\Entity\LogProjet;
use App\Services\Mailer\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Workflow\Event\Event;

class ProjetEventListener implements EventSubscriberInterface
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
            'workflow.status_projet.leave' => 'onLeaved',
        ];
    }

    public function onLeaved(Event $event)
    {
       // dd($event->getSubject()->getTitre());
        $from=$this->em->getRepository(EtatProjet::class)->findOneBy(['nom_constant'=> implode(', ', array_keys($event->getMarking()->getPlaces()))]);
        $to=$this->em->getRepository(EtatProjet::class)->findOneBy(['nom_constant'=>implode(', ', $event->getTransition()->getTos())]);
        $Idprojet = $event->getSubject()->getId();
        $logsbypro = $this->em->getRepository(LogProjet::class)->listLogsByProjetStatus($Idprojet);
        if($logsbypro){
            
            $gol = $logsbypro[0];
            $diff = date_diff(new \DateTimeImmutable(), $gol->getDateCreation());
             
            $gol->setDuree($diff->days);
             $this->em->persist($gol);
        }
       
           $logProjet=new LogProjet();
           $logProjet->setCreePar($this->user->getUser());
           $logProjet->setStatus($to->getNom());
           $logProjet->setDateCreation(new \DateTimeImmutable());
           $commentaire=$this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a créé un projet";
            if($from!=null){
                $commentaire=$this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet ".$from->getNom()." à ".$to->getNom();
            }
           $logProjet->setCommentaire($commentaire);
           $logProjet->setProjet($event->getSubject());
           $this->em->persist($logProjet);
           $message=$this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet (".$event->getSubject()->getTitre().") à ".$to->getNom();
           $this->mailer->sendMail($this->user->getUser()->getEmail(),$message,"le projet : ".$event->getSubject()->getTitre()." (Changement Status)");
           $this->em->flush();
    }

}