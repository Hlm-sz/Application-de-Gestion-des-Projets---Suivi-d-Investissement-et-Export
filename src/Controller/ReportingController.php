<?php

namespace App\Controller;

use App\Entity\EtatProjet;
use App\Entity\TypeProjet;
use App\Repository\CompteRepository;
use App\Repository\ContactRepository;
use App\Repository\ProjetsRepository;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ReportingController extends AbstractController
{
    /**
     * @Route("/reporting", name="reporting")
     */
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $projet = $em->getRepository('App\Entity\Projets');
        $contact = $em->getRepository('App\Entity\Contact');
        $compte = $em->getRepository('App\Entity\Compte');
        $event = $em->getRepository('App\Entity\Event');
        $defaultData = ['message' => 'Type your message here'];
        $form = $this->createFormBuilder($defaultData)
            ->add('date', DateType::class,array('label' => 'form.date','data'=> new \DateTime("now"),'widget'=>'single_text'))
            ->add('datef', DateType::class,array('label' => 'form.datef','data'=> new \DateTime("now"),'widget'=>'single_text'))
            ->getForm();
            $form->handleRequest($request);
            $sumProjetByTypes=[];
            $sumProjetByTypewithStatus=[];
            $projetsByMonth=[];
            if ($form->isSubmitted() && $form->isValid()) {
                $dateS=$form->get('date')->getData()->format('Y-m-d');
                $dateE=$form->get('datef')->getData()->format('Y-m-d');
                
                $countProjet=$projet->countProjetbydate($dateS,$dateE)['count']; 
                $countCompte=$compte->countComptebydate($dateS,$dateE)['count'];
                $countEvent=$event->countEventbydate($dateS,$dateE)['count'];

                
                $countContact=$contact->countContact()['count'];
                $statues=$this->getDoctrine()->getRepository(EtatProjet::class)->findAll();
                $types=$this->getDoctrine()->getRepository(TypeProjet::class)->findAll();
                
                foreach ($statues as $status){
                    foreach ($types as $type) {
                        $ProjetByTypeWithStatus=isset($sumProjetByTypewithStatus[$status->getId()][$type->getId()])?$sumProjetByTypewithStatus[$status->getId()][$type->getId()]:0;
                        $sumProjetByType=isset($sumProjetByTypes[$type->getId()])?$sumProjetByTypes[$type->getId()]:0;
                        $sumProjetByTypes[$type->getId()]=$sumProjetByType+$projet->getCountBystatusprojetdate($dateS,$dateE,$status->getId(), $type->getId())['count'];
                        $sumProjetByTypewithStatus[$status->getId()][$type->getId()]=$ProjetByTypeWithStatus+$projet->getCountBystatusprojetdate($dateS,$dateE,$status->getId(), $type->getId())['count'];
                    }
                }
                $projetsByMonth=[];
                foreach ($types as $type) {
                    for($i=1;$i<13;$i++){
                        $date_debut=new \DateTimeImmutable("2020-".$i."-01");
                        $date_fin=new \DateTimeImmutable("2020-".$i."-31");
                        $projetsByMonth[$type->getId()][$i]=$projet->getCountByprojetDate($date_debut,$date_fin,$type->getId())['count'];
                    }
                }

                $count=['projet'=>$countProjet,'contact'=>$countContact,'compte'=>$countCompte, 'event'=> $countEvent];
               
            }else{
                $countProjet=$projet->countProjet()['count']; 
                $countContact=$contact->countContact()['count'];
                $countCompte=$compte->countCompte()['count'];
                $countEvent=$event->countEvent()['count'];
                $statues=$this->getDoctrine()->getRepository(EtatProjet::class)->findAll();
                $types=$this->getDoctrine()->getRepository(TypeProjet::class)->findAll();
              
                foreach ($statues as $status){
                    foreach ($types as $type) {
                        $ProjetByTypeWithStatus=isset($sumProjetByTypewithStatus[$status->getId()][$type->getId()])?$sumProjetByTypewithStatus[$status->getId()][$type->getId()]:0;
                        $sumProjetByType=isset($sumProjetByTypes[$type->getId()])?$sumProjetByTypes[$type->getId()]:0;
                        $sumProjetByTypes[$type->getId()]=$sumProjetByType+$projet->getCountBystatusprojet($status->getId(), $type->getId())['count'];
                        $sumProjetByTypewithStatus[$status->getId()][$type->getId()]=$ProjetByTypeWithStatus+$projet->getCountBystatusprojet($status->getId(), $type->getId())['count'];
                    }
                }
        
             
                foreach ($types as $type) {
                    for($i=1;$i<13;$i++){
                        $date_debut=new \DateTimeImmutable("2020-".$i."-01");
                        $date_fin=new \DateTimeImmutable("2020-".$i."-31");
                        $projetsByMonth[$type->getId()][$i]=$projet->getCountByprojetDate($date_debut,$date_fin,$type->getId())['count'];
                    }
                }
                $count=['projet'=>$countProjet,'contact'=>$countContact,'compte'=>$countCompte, 'event'=> $countEvent];
            }

       
        
        return $this->render('reporting/index.html.twig', [
            'count'=>$count,
            'reportingProjet'=>$sumProjetByTypewithStatus,
            'sumProjetByTypes'=>$sumProjetByTypes,
            'projetsByMonth'=>$projetsByMonth,
            'form' => $form->createView()
            
        ]);
    }
    
}