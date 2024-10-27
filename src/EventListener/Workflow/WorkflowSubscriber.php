<?php
// src/EventSubscriber/FormSubmittedSubscriber.php
// namespace App\EventListener\Workflow;

// use App\Entity\Compte;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\EventDispatcher\EventSubscriberInterface;
// use Symfony\Component\Form\FormEvent;
// use Symfony\Component\Form\FormEvents;

// class FormSubmittedSubscriber implements EventSubscriberInterface
// {
//     private $entityManager;

//     public function __construct(EntityManagerInterface $entityManager)
//     {
//         $this->entityManager = $entityManager;
//     }

//     public static function getSubscribedEvents()
//     {
//         return [
//             FormEvents::SUBMIT => 'onFormSubmit',
//         ];
//     }

   
//     public function onFormSubmit(FormEvent $event)
//     {
//         // Récupérer les données soumises
//         $formData = $event->getData();
        
//         // Manipuler les données selon les besoins
//         $listeInvestisseurs = $formData['listeInvestisseurs'];
//         $listeDO = $formData['listeDO'];
//         $listeExportateurs = $formData['listeExportateurs'];

//         // Fusionner les valeurs des trois champs en un seul champ
//         $comptes = array_merge($listeInvestisseurs, $listeDO, $listeExportateurs);
//         $event->getData()->addComptes($comptes);
        
//         // // Assigner les valeurs fusionnées au champ 'compte'
//         // $event->setData(['comptes' => $comptes]);
//         $this->entityManager->flush();
//     }
// }

