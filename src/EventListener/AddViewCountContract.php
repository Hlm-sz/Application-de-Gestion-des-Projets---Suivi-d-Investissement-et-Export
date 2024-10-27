<?php


namespace App\EventListener;


use App\Domain\SecteurDomain;
use App\Repository\ContactRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class AddViewCountContract implements EventSubscriberInterface
{

    private $twig;
    private $contactRepository;
    private $secteurDomain;

    public function __construct(Environment $twig,SecteurDomain $secteurDomain,ContactRepository $contactRepository)
    {
        $this->twig = $twig;
        $this->contactRepository=$contactRepository;
        $this->secteurDomain=$secteurDomain;

    }

     public function onControllerEvent(ControllerEvent $event)
    {
        $this->twig->addGlobal('count', $this->NbrContactsAmdieNotActive());
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onControllerEvent',
        ];
    }

    private function NbrContactsAmdieNotActive(){
        $secteurs=$this->secteurDomain->getSecteurByUser();

        $count=0;
        if($secteurs){
            foreach ($secteurs as $key => $_secteur) {
                $contacts = $this->contactRepository->contatSiteWebAmdie($_secteur->getNom());
                if ($contacts) {
                    $count = $count + count($this->contactRepository->contatSiteWebAmdie($_secteur->getNom()));
                }
            }
        }

        return $count;
    }

}