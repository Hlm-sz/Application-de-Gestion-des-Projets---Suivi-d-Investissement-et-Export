<?php

namespace App\Controller;

use App\Entity\Compte;
use DateTime;
use App\Entity\Event;
use App\Entity\User;
use App\Entity\Pays;
use App\Entity\Projets;
use App\Form\EventType;
use App\FiltreData\EventFiltre;
use App\Form\EventFiltreType;
use App\Domain\SecteurDomain;
use App\Entity\ListeDo;
use App\Entity\ListeExportateur;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use App\Utils\Uploader\FileUploader;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
// Include PhpSpreadsheet required namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * @Route("/events")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/", name="events_index")
     * @Security("is_granted('CONSULTER_EVENT')")
     */
    public function index(Request $request,EventRepository $eventRepository): Response
    {
        $event = new Event();
        $data=new EventFiltre();
        $form = $this->createForm(EventFiltreType::class, $data);
        $form->handleRequest($request);
        
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
            'events'=>$eventRepository->getAllsEvents(),
            'event'=> $event,
            'form'=>$form->createView()

        ]);
    }

    /**
     * @Route("/event", name="event_detail")
     */
    public function detail()
    {
        return $this->render('event/detail.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }
    /**
     * @Route("/new", name="events_new", methods={"GET","POST"})
     * @Security("is_granted('CREATION_DE_EVENT')")
     */
    public function new(Request $request,FileUploader $fileUploader): Response
    {
        $event = new Event();
        $event->setCreatedBy($this->getUser());
        $event->setUpdatedBy($this->getUser());
        $event->setIsValide(false);
        if($event->getDocumet()){
            $event->setDocumet(new File($this->getParameter('uploader_directory').'/'.$event->getDocumet()));
        }
        $event->setCreatedAt(new DateTime('NOW'));
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            if($event->getDocumet()){
                $file = $event->getDocumet(); 
                $newFilename = $fileUploader->upload($file);
                $event->setDocumet($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();
            $this->addFlash('success', 'Evénement a été créé avec succès');
            return $this->redirectToRoute('events_detail',['id' => $event->getId()]);
        }
        //get comptes
        $all_comptes = $this->getDoctrine()->getRepository(Compte::class)->findAll();
        
        return $this->render('event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
            'all_comptes' => $all_comptes
        ]);
    }

    /**
     * @Route("/{id}", name="event_show", methods={"GET"})
     */
    public function show(Event $event): Response
    {
        $comptes = $event->getComptes();
        
        $updatedBy = $event->getUpdatedBy() ? ['nom'=> $event->getUpdatedBy()->getNom(),'prenom'=> $event->getUpdatedBy()->getPrenom()]: ['nom'=>'','prenom' => ''];
        $createdBy = $event->getCreatedBy() ? ['nom'=> $event->getCreatedBy()->getNom(),'prenom'=> $event->getCreatedBy()->getPrenom()]: ['nom'=>'','prenom' => ''];
    
        return $this->render('event/show.html.twig', [
            'event' => $event,
            'comptes' => $comptes,
            'updated' => $updatedBy,
            'created' => $createdBy
            

        ]);
    }

    /**
     * @Route("/{id}/event", name="events_detail", methods={"GET","POST"})
     * @Security("is_granted('MODIFIER_EVENT')")
     */
    public function detaileve(Request $request, Event $event,FileUploader $fileUploader): Response
     {   //get comptes
        $ProjetsData=[];
        // $all_comptes = $this->getDoctrine()->getRepository(Compte::class)->findAll();
        $comptes = $event->getComptes();
        foreach($comptes as $compte){
            $Projets = $this->getDoctrine()->getRepository(Projets::class)->findBy(['compte' => $compte->getId()]);
            $ProjetsData = array_merge($Projets,$ProjetsData);
        }
        array_merge($ProjetsData);
        $event->setUpdatedBy($this->getUser());
        $event->setUpdatedAt(new DateTime('NOW'));
        
        // if($event->getDocumet()){
        //     $event->setDocumet(new File($this->getParameter('uploader_directory').'/'.$event->getDocumet()));
        // }
        $EventData = $this->getDoctrine()->getRepository(Event::class)->findOneByid($event->getId());
        $doc = $EventData->getDocumet();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('documet')->getData();
            if($file){
                $file = $event->getDocumet(); 
                $newFilename = $fileUploader->upload($file);
                $event->setDocumet($newFilename);
            }else{
                $event->setDocumet($doc);
            }
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Cet événement a été modifié avec succès');
            return $this->redirectToRoute('events_detail',['id' => $event->getId()]);
        }

        
        
        $updatedBy = $event->getUpdatedBy() ? ['nom'=> $event->getUpdatedBy()->getNom(),'prenom'=> $event->getUpdatedBy()->getPrenom()]: ['nom'=>'','prenom' => ''];
        $createdBy = $event->getCreatedBy() ? ['nom'=> $event->getCreatedBy()->getNom(),'prenom'=> $event->getCreatedBy()->getPrenom()]: ['nom'=>'','prenom' => ''];
        return 
         
        $this->render('event/edit.html.twig', [
            'event' => $event,
            //'Projets' => $ProjetsData,
            // 'comptes' => $comptes,
            'form' => $form->createView(),
            // 'all_comptes' => $all_comptes,
           // 'listeInvestisseur' => $ProjetsData,
            'updated' => $updatedBy,
            'created' => $createdBy
        ]);

    
    }

    /**
     * @Route("/{id}", name="event_delete", methods={"DELETE"})
     * @Security("is_granted('SUPPRIMER_EVENT')")
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('events_index');
    }
     /**
     * @Route("/{id}/show", name="event_show", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function showevent(Event $event, Request $request): Response
    {
        $form = $this->createForm(EventType::class, $event);
            return $this->render('event/details.html.twig', [
                'event' => $event,
                'form' => $form->createView()
            ]);   

    }

    /**
     * @Route("/change_activation/{isactive}/{event}", name="event_change_activation", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function changeactivation($isactive,Event $event)
    {
        $event->setIsValide($isactive);
        $em=$this->getDoctrine()->getManager();
        $em->persist($event);
        $em->flush();
        return $this->redirectToRoute('events_detail',['id'=>$event->getId()]);
    }

     /**
     * @Route("/generate/pdf/{id}", name="event_pdf", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function generatePdf(Pdf $pdf,Request $request, Event $event): Response
    {

        //get comptes
        $ProjetsData=[];
        $all_comptes = $this->getDoctrine()->getRepository(Compte::class)->findAll();
        $comptes = $event->getComptes(); 
        foreach($comptes as $compte){
            $Projets = $this->getDoctrine()->getRepository(Projets::class)->findBy(['compte' => $compte->getId()]);
             
            $ProjetsData = array_merge($Projets,$ProjetsData);
        }
        array_merge($ProjetsData);
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        $updatedBy = $event->getUpdatedBy() ? ['nom'=> $event->getUpdatedBy()->getNom(),'prenom'=> $event->getUpdatedBy()->getPrenom()]: ['nom'=>'','prenom' => ''];
        $createdBy = $event->getCreatedBy() ? ['nom'=> $event->getCreatedBy()->getNom(),'prenom'=> $event->getCreatedBy()->getPrenom()]: ['nom'=>'','prenom' => ''];
        // return $this->render('event/pdf/pdf.html.twig', [
        //     'event' => $event,
        //     'data' =>   array("Projets" => $ProjetsData,"comptes"=>$comptes,"all_comptes"=>$all_comptes,"updated"=>$updatedBy,"created"=>$createdBy),
        //     'form' => $form->createView(),
        // ]);
        $url="event/pdf/pdf.html.twig";
        $html=$this->renderView($url, [
            'event' => $event,
            'data' =>   array("Projets" => $ProjetsData,"comptes"=>$comptes,"all_comptes"=>$all_comptes,"updated"=>$updatedBy,"created"=>$createdBy),
            'form' => $form->createView(),
        ]);      
       return new PdfResponse(
            $pdf->getOutputFromHtml($html),
            'detail_event.pdf'
        );
    }
    
    /**
     * @Route("/filtre", name="event_filtre", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function filtre(Request $request,EventRepository $eventRepository): Response
    {
        $data=new EventFiltre();
        $form = $this->createForm(EventFiltreType::class, $data);
        $form->handleRequest($request);
        $events=$eventRepository->getListsEvents($data);
        
        return $this->render('event/filtre/index.html.twig',[
            'events'=> $events,
            'form'=>$form->createView()
        ]);
    }


      /**
     * @Route("/export", name="events_export", methods={"GET"})
     * @Security("is_granted('EXTRACTION_EVENTS')")
     */
    public function exporttoexcel(Request $request,SecteurDomain $secteurDomain,EventRepository $eventRepository): Response
    {

        $event = new Event();
        $data=new EventFiltre();
        $form = $this->createForm(EventFiltreType::class, $data);
        $form->handleRequest($request);
        $events = $eventRepository->findAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $num=1;
        $sheet->setCellValue('A'.$num, 'Nom');
        $sheet->setCellValue('B'.$num, 'Mois');
        $sheet->setCellValue('C'.$num, 'Année');
        $sheet->setCellValue('D'.$num, 'Pays');
        $sheet->setCellValue('E'.$num, 'Secteur');
        $sheet->setCellValue('F'.$num, 'Format de participation');
        $sheet->setCellValue('G'.$num, 'Organisateur');
        $sheet->setCellValue('H'.$num, 'Partenaires');
        $sheet->setCellValue('I'.$num, 'Type d’événement');
        $sheet->setCellValue('J'.$num, 'Comptes');
        $n = 1;
          foreach($events as $row){
            $rowNum = $n + 1;
            $partes = "";
            
            foreach ($row->getPartenaires() as $parte)
            {
                $partes.=" / ".$parte;
            }
            $typeev = "";
            foreach ($row->getTypeEvenement() as $typee)
            {
                $typeev.=" / ".$typee;
            }
            $comptes="";
            foreach ($row->getComptes() as $Compte)
            {
                $comptes.=" / ".$Compte->getNomCompte();
            }
            $secteures="";
            foreach ($row->getSecteur() as $Secteur)
            {
                $secteures.=" / ".$Secteur;
            }
            $pay_id = $row->getPays();
            $pays = $this->getDoctrine()->getRepository(Pays::class)->findOneBy(['id'=> $pay_id]);
            $sheet->setCellValue('A'.$rowNum, $row->getNom());
            $sheet->setCellValue('B'.$rowNum, $row->getMois());
            $sheet->setCellValue('C'.$rowNum, $row->getAnnee());
            $sheet->setCellValue('D'.$rowNum, $pays->getNom());
            $sheet->setCellValue('E'.$rowNum, $secteures);
            $sheet->setCellValue('F'.$rowNum, $row->getFormatParticipation());
            $sheet->setCellValue('G'.$rowNum, $row->getOrganisateur());
            $sheet->setCellValue('H'.$rowNum, $partes);
            $sheet->setCellValue('I'.$rowNum, $typeev);
            $sheet->setCellValue('J'.$rowNum, $comptes);
            
            $n++;
        }        
        // Create your Office 2007 Excel (XLSX Format)
        $writer = new Xlsx($spreadsheet);
        
        // Create a Temporary file in the system
        $date = new \DateTimeImmutable();
        $fileName = 'Events-'.time().'.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        
        // Create the excel file in the tmp directory of the system
        $writer->save($temp_file);
        
        // Return the excel file as an attachment
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
        return $this->render('compte/index.html.twig',[
            'comptes'=> $compteRepository->getListsComptes($id,$data),
            'secteurs'=>$secteurs,
            'secteur_active'=>$secteur,
            'compte' =>$compte,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/deleteeven/{id}", name="delete_event_attache", methods={"GET"})
     */
    public function deletecv(Request $request, Event $event): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $event->setDocumet("");
        $entityManager->persist($event);
        $entityManager->flush();
        // return $this->redirectToRoute('events_detail', ['id' => $event->getId()]);
        return $this->redirectToRoute('events_detail',['id' => $event->getId()]);

    }


 
}
