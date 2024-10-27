<?php

namespace App\Controller;



use App\Domain\SecteurDomain;
use App\Entity\CarteVisite;
use App\Entity\Compte;
use App\Entity\Contact;
use App\Entity\CompteData;
use App\Entity\DataGpac;
use App\Entity\EtatProjet;
use App\Entity\LogProjet;
use App\Entity\Projets;
use App\Entity\ProjetsData;
use App\Entity\Secteur;
use App\Entity\TypeProjet;
use App\Entity\TinyJournal;
use App\Entity\User;
use App\FiltreData\ActionsPartenaires;
use App\Form\ContactType;
use App\Form\DataGPACType;
use App\Form\DataProjetType;
use App\Form\FormProjectType;
use App\Form\ProjetDataType;
use App\Form\ActionsPartenairesType;
use App\Form\ProjetStatusType;
use App\Form\ProjetsType;
use App\Repository\ProjetsDataRepository;
use App\Repository\ProjetsRepository;
use App\Repository\TypeProjetRepository;
use App\Service\CreateForm;
use App\Utils\GenerateForm;
use App\Utils\Uploader\FileUploader;
use App\Utils\Workflow\ProjetWorkflowHandler;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Yaml\Yaml;
use Twig\Parser;
use App\Workflow\Transition\ProjetTransitions;
use LogicException;
use phpDocumentor\Reflection\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Services\Mailer\Mailer;


/**
* @Route("/actions")
*/

class PartenairesActionController extends AbstractController {

    public function __construct(Mailer $mailer)
      {
          $this->mailer=$mailer;
      }

    /**
     * @Route("/filtre", name="actions_filtre", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function filtre(SecteurDomain $secteurDomain,Request $request,TypeProjetRepository $typeProjetRepository, ProjetsRepository $projetsRepository): Response
    {
        $telecharger=0;
        if($request->query->get('telecharger')==1){
            $request->query->remove('telecharger');
            $request->request->remove('telecharger');
            $telecharger=1;
        }

        $data=new ActionsPartenaires();
        $form = $this->createForm(ActionsPartenairesType::class, $data);
        $form->handleRequest($request);
        if($telecharger==1){
            $this->telecharger($data);
        }
        $secteur=null;
        $id=$request->get('secteur')?$request->get('secteur'):null;
        if($id){
            $secteur=$this->getDoctrine()->getRepository(Secteur::class)->findOneBy(['id'=>$id]);
            $secteurs=$this->getDoctrine()->getRepository(Secteur::class)->findBy(['id'=>$id]);;
        }else{
            $secteurs=$secteurDomain->getSecteurByUser();
        }
        foreach ($secteurs as $_secteur){
            $_secteur->projets=$projetsRepository->listeProjetBysecteur($_secteur->getId(),$data);
        }

       $projets= $projetsRepository->findSearchPartenaireactions($data);
        foreach ($projets as $projet){
            $confidentiel=$projetsRepository->getValueField($projet->getId(),'Confidentiel')?$projetsRepository->getValueField($projet->getId(),'Confidentiel')['value']:0;
            $prioritaire=$projetsRepository->getValueField($projet->getId(),'Prioritaire')?$projetsRepository->getValueField($projet->getId(),'Prioritaire')['value']:0;
            $projet->confidentiel=($confidentiel=='oui' || $confidentiel==1)?1:0;
            $projet->prioritaire=($prioritaire=='oui' || $prioritaire==1)?1:0;
        }
        return $this->render('actions/filtre/index.html.twig', [
            'type_projet' => $typeProjetRepository->findAll(),
            'projects' => $projets,
            'secteurs'=>$secteurs,
            'listeSecteurs'=>$secteurDomain->getSecteurByUser(),
            'secteur_active'=>$secteur,
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("/{id}", name="actions_index", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function index(int $id=null,Request $request,TypeProjetRepository $typeProjetRepository, ProjetsRepository $projetsRepository): Response
    {
        $telecharger=$request->query->get('telecharger')==1?1:0;
        $data=new ActionsPartenaires(); 
        $projet = new Projets();
        $form = $this->createForm(ActionsPartenairesType::class, $data);
        $form->handleRequest($request);
        if($telecharger==1){
            $request->query->remove('telecharger');
            $this->telecharger($data);
        }

        $restrictions=$this->getUser()->getGroupe()->getRestrictions();
        $search=null;
        if($request->get('search')){
            $search=$request->get('search');
        }

        $secteurs=null;

        $secteur=null;
        $id=$request->get('secteur')?$request->get('secteur'):null;
        if($id){
            $secteur=$this->getDoctrine()->getRepository(Secteur::class)->findOneBy(['id'=>$id]);
        }
        $projets= $projetsRepository->findSearchPartenaireactions($data);
       
        foreach ($projets as $projet){
            $confidentiel=$projetsRepository->getValueField($projet->getId(),'Confidentiel')?$projetsRepository->getValueField($projet->getId(),'Confidentiel')['value']:0;
            $prioritaire=$projetsRepository->getValueField($projet->getId(),'Prioritaire')?$projetsRepository->getValueField($projet->getId(),'Prioritaire')['value']:0;
            $projet->confidentiel=($confidentiel=='oui' || $confidentiel==1)?1:0;
            $projet->prioritaire=($prioritaire=='oui' || $prioritaire==1)?1:0;

        }
        
        return $this->render('actions/index.html.twig', [
            'type_projet' => $typeProjetRepository->findAll(),
            'projects' => $projets,
            'projet' => $projet,
            'secteurs'=>$secteurs,
            'secteur_active'=>$secteur,
            'form'=>$form->createView()
        ]);
    }


    /**
     * @Route("/export/data", name="actions_export", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function export(Request $request,ProjetsRepository $projetsRepository): Response
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $num=1;
        $sheet->setCellValue('A'.$num, 'Projet');
        $sheet->setCellValue('B'.$num, 'Confidentiel');
        $sheet->setCellValue('C'.$num, 'Prioritaire');
        $sheet->setCellValue('D'.$num, 'Géré Par');
        $sheet->setCellValue('E'.$num, 'Compte');
        $sheet->setCellValue('F'.$num, 'Status');
        $sheet->setCellValue('G'.$num, 'Type');
        $sheet->setCellValue('H'.$num, 'GPAC');

        $projetsRepository->listProjets();

            $n = 1;
            foreach($projetsRepository->listProjets() as $row){
                $rowNum = $n + 1;
                $confidentiel=$projetsRepository->getValueField($row['id'],'Confidentiel')?($projetsRepository->getValueField($row['id'],'Confidentiel')['value']?'oui':'non'):'non';
                $prioritaire=$projetsRepository->getValueField($row['id'],'Prioritaire')?($projetsRepository->getValueField($row['id'],'Prioritaire')['value']?'oui':'non'):'non';
                $sheet->setCellValue('A'.$rowNum, $row['projet']);
                $sheet->setCellValue('B'.$rowNum, $confidentiel);
                $sheet->setCellValue('C'.$rowNum, $prioritaire);
                $sheet->setCellValue('D'.$rowNum, $row['nom_user']);
                $sheet->setCellValue('E'.$rowNum, $row['compte']);
                $sheet->setCellValue('F'.$rowNum, $row['status']);
                $sheet->setCellValue('G'.$rowNum, $row['type']);
                $sheet->setCellValue('H'.$rowNum, $row['is_gpac']?'oui':'non');
                $n++;
            }

        $filename = 'projet-'.time().'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');

    }


    private function telecharger($filtre): Response
    {
        $listeProjetByFiltre=$this->getDoctrine()->getRepository(Projets::class)->telechargerListProjets($filtre);
        $restrictions=$this->getUser()->getGroupe()->getRestrictions();
        if($restrictions){
            foreach ($restrictions as $restriction){
                switch ($restriction->getId()) {
                    case 6:
                        $listeProjetByFiltre=$this->getDoctrine()->getRepository(Projets::class)->telechargerListProjetsNonConf($filtre);
                        break;
                    }
                }
        }else{
            $listeProjetByFiltre=$this->getDoctrine()->getRepository(Projets::class)->telechargerListProjets($filtre);
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $num=1;
        $sheet->setCellValue('A'.$num, 'Projet');
        $sheet->setCellValue('B'.$num, 'Confidentiel');
        $sheet->setCellValue('C'.$num, 'Prioritaire');
        $sheet->setCellValue('D'.$num, 'Géré Par');
        $sheet->setCellValue('E'.$num, 'Compte');
        $sheet->setCellValue('F'.$num, 'Status');
        $sheet->setCellValue('G'.$num, 'Type');
        $sheet->setCellValue('H'.$num, 'GPAC');

        $n = 1;
        $projetsRepository=$this->getDoctrine()->getRepository(Projets::class);
        foreach($listeProjetByFiltre as $row){
            $rowNum = $n + 1;
            $confidentiel=$projetsRepository->getValueField($row['id'],'Confidentiel')?($projetsRepository->getValueField($row['id'],'Confidentiel')['value']?'oui':'non'):'non';
            $prioritaire=$projetsRepository->getValueField($row['id'],'Prioritaire')?($projetsRepository->getValueField($row['id'],'Prioritaire')['value']?'oui':'non'):'non';
            $sheet->setCellValue('A'.$rowNum, $row['projet']);
            $sheet->setCellValue('B'.$rowNum, $confidentiel);
            $sheet->setCellValue('C'.$rowNum, $prioritaire);
            $sheet->setCellValue('D'.$rowNum, $row['nom_user']);
            $sheet->setCellValue('E'.$rowNum, $row['compte']);
            $sheet->setCellValue('F'.$rowNum, $row['status']);
            $sheet->setCellValue('G'.$rowNum, $row['type']);
            $sheet->setCellValue('H'.$rowNum, $row['is_gpac']?'oui':'non');
            $n++;
        }

        $filename = 'projet-'.time().'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');

    }


    /**
     * @Route("/generate/pdf/{id}", name="actions_pdf", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function generatePdf(Pdf $pdf,Projets $projet,Request $request, FileUploader $fileUploader,EntityManagerInterface $em): Response
    {
        $path = $this->getParameter('forms_directory') . '/forms-projet.yml';
        $generateForm=new GenerateForm($projet->getTypeProjet()->getId(),$path,$em);
        $form_fields=$generateForm->getFields([1,2]);
        $this->setDataForm($form_fields,ProjetsData::class,$projet);
        $form = $this->createForm(ProjetDataType::class, $projet, array("schema_form" => $form_fields));
        $contacts=$this->getDoctrine()->getRepository(CarteVisite::class)->getCarteVistesByCompte($projet->getCompte()->getId());
        $url="actions/pdf/pdf.html.twig";
        $html=$this->renderView($url, [
            'projet' => $projet,
            'logs_projet' => $this->getDoctrine()->getRepository(LogProjet::class)->listLogsByProjet($projet->getId()),
            'list_status'=>$this->getDoctrine()->getRepository(EtatProjet::class)->findAll(),
            'data' =>   array("compte" => $projet->getCompte(), "contact" => $contacts),
            'form' => $form->createView(),
        ]);
       return new PdfResponse(
            $pdf->getOutputFromHtml($html),
            'detail_projet.pdf'
        );
    }
    private function setDataForm(&$form_fields,$table,$object){
        foreach ($form_fields as &$field){
            $options = $field["options"];
            $name=$field["name"];
            $type=$field["type"];
                $dataProject = $this->getDoctrine()->getRepository($table)->findOneBy(['projet' => $object->getId(), 'cle' => $name]);
                $options_data = $dataProject ? $dataProject->getValue() : null;
                if ($type == "FileType") {
                    if ($options_data) {
                        $field["options"]["data"] =  new File($this->getParameter('uploader_directory') . '/' . $options_data);
                    } else {
                        $field["options"]["data_class"] = null;
                    }
                } else if ($type == "CheckboxType") { 
                if ($options_data) {
                    $field["options"]["data"] = $options_data ? true : false;
                } else {
                    $field["options"]["data"] = false;
                }
                } else if ($type == "EntityType") {
                    $field["options"]["data"] = $this->getDoctrine()->getRepository($options["class"])->findOneBy(['id' => $options_data]);
                }
                else if ($type == "MultiSelectType") {
                    $field["options"]["data"] = $this->getDoctrine()->getRepository($options["class"])->findby(['id' => json_decode($options_data)]);
                }
                else if ($type == "DateType") { 
                    if($options_data){
                        $field["options"]["data"] =  new \DateTime($options_data);
                    }
                }else {
                    $field["options"]["data"] = $options_data;
                }
            }
    }
    private function formSaveData($form_fields,$form,$table,$objet,FileUploader $fileUploader){
        $entityManager=$this->getDoctrine()->getManager();
        foreach ($form_fields as $field) {
            $options = $field["options"];
            $name=$field["name"];
            $type=$field["type"];
           
            $getdataObject = $this->getDoctrine()->getRepository($table)->findOneBy(['projet' => $objet->getId(), 'cle' => $name]);
            if($getdataObject){
                if($type == "EntityType"){
                    $getdataObject->setValue($form[$name]->getData()->getId());
                    $entityManager->persist($getdataObject);
                    $entityManager->flush();
                }elseif ($type =="FileType"){
                    $file = $form->get($name)->getData();
                    if ($file) {
                        $newFilename = $fileUploader->upload($file);
                        $getdataObject->setValue($newFilename);
                        $entityManager->persist($getdataObject);
                        $entityManager->flush();
                    }
                }elseif($type =="DateType"){
                    $getdataObject->setCle($name);
                    $getdataObject->setValue($form[$name]->getViewData());
                    $getdataObject->setProjet($objet);
                    $entityManager->persist($getdataObject);
                    $entityManager->flush();
                
                }elseif($type =="MultiSelectType"){
                    $array_object=[];
                    foreach ($form[$name]->getData() as $object){
                        array_push($array_object,$object->getId());
                    }
                    $getdataObject->setCle($name);
                    $getdataObject->setValue(json_encode($array_object));
                    $getdataObject->setProjet($objet);
                    $entityManager->persist($getdataObject);
                    $entityManager->flush();

                
                }else{
                        if ($form[$name]->getData() == null) {
                            $getdataObject->setValue("");
                        } else {
                            $getdataObject->setValue($form[$name]->getData());
                        }
                        $entityManager->persist($getdataObject);
                        $entityManager->flush();
                }
            }else{
                if($type == "EntityType"){
                    // $newObjectData = new ProjetsData();
                    // $newObjectData->setCle($name);
                    // $newObjectData->setValue($form[$name]->getData()->getId());
                    // $newObjectData->setProjet($objet);
                    // $entityManager->persist($newObjectData);
                    // $entityManager->flush();
                }elseif ($type =="FileType"){
                    $brochureFile = $form->get($name)->getData();
                    if ($brochureFile) {
                        $newFilename = $fileUploader->upload($brochureFile);
                        $newObjectData = new ProjetsData();
                        $newObjectData->setCle($name);
                        $newObjectData->setValue($newFilename);
                        $newObjectData->setProjet($objet);
                        $entityManager->persist($newObjectData);
                        $entityManager->flush();
                    }
                }elseif($type =="DateType"){
                    $newObjectData = new ProjetsData();
                    $newObjectData->setCle($name);
                    $newObjectData->setValue($form[$name]->getViewData());
                    $newObjectData->setProjet($objet);
                    $entityManager->persist($newObjectData);
                    $entityManager->flush();
                }elseif($type =="MultiSelectType"){
                    $array_object=[];
                    foreach ($form[$name]->getData() as $object){
                        array_push($array_object,$object->getId());
                    }
                    $newObjectData = new ProjetsData();
                    $newObjectData->setCle($name);
                    $newObjectData->setValue(json_encode($array_object));
                    $newObjectData->setProjet($objet);
                    $entityManager->persist($newObjectData);
                }
                else{
                    if ($form[$name]->getData() != null) {
                        $newObjectData = new ProjetsData();
                        $newObjectData->setCle($name);
                        $newObjectData->setValue($form[$name]->getData());
                        $newObjectData->setProjet($objet);
                        $entityManager->persist($newObjectData);
                        $entityManager->flush();
                    }
                }
            }

        }
       

    }
     /**
     * @Route("/actionlogall", name="actions_log_filtre_all", methods={"GET","POST"})
     * 
     */
    public function projetlogfiltreall(Request $request): Response
    {
        $compteid = $request->request->get('projet');
        $logs_projet = $this->getDoctrine()->getRepository("App:LogProjet")
        ->listLogsByProjet($compteid);

        return $this->render('actions/detail_projet/logfiltreprojet.html.twig',array('logs_projet' => $logs_projet));
    }
     /**
     * @Route("/projetlogfiltre", name="projet_log_filtre", methods={"GET","POST"})
     * 
     */
    public function projetlogfiltre(Request $request): Response
    {
        $statu = $request->request->get('log_status');
        $startdate = $request->request->get('log_date');
        $enddate = $request->request->get('log_date_end');
        $compteid = $request->request->get('projet');
        
        $logs_projet = $this->getDoctrine()->getRepository("App:LogProjet")
        ->findlistLogsByProjet($compteid,$startdate,$enddate,$statu);

        return $this->render('actions/detail_projet/logfiltreprojet.html.twig',array('logs_projet' => $logs_projet));

    }


    /**
     * @Route("/form/{id}", name="projets_form", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function form(Projets $projet,Request $request,\App\Services\Form\CreateForm $myForm){
        $form_fields=$myForm->createFrom(
            [
                'type_form'=>$projet->getTypeProjet()->getId(),
                'form'=> ProjetDataType::class,
                'fields'=>[1,2],
                'path'=> 'forms-projet.yml'
            ]
            ,ProjetsData::class,
            ['projet'=>$projet->getId()]
        );
        $form = $this->createForm(ProjetDataType::class, $projet, array("schema_form" => $form_fields));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $titre = "";
            if ($projet->getTypeProjet()->getId() == "1") {
                $titre = $form["Denomination_projet"]->getData();
            } else if ($projet->getTypeProjet()->getId() == "2") {
                $titre = $form["intitule_projet"]->getData();
            } else if ($projet->getTypeProjet()->getId() == "3") {
                $titre = $form["intitule_projet"]->getData();
            }
            if($titre!=""){
                $projet->setTitre($titre);
            }
            $myForm->SaveData($form_fields,$form,ProjetsData::class,$projet,['projet'=>$projet->getId()]);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('projets_form',['id'=>$projet->getId()]);
        }

        return $this->render('actions/form_projet.html.twig', [
            'form' => $form->createView(), 
        ]);
    }

    /**
     * @Route("/action/{id}", name="actions_detail", methods={"GET","POST"})
     * @Security("is_granted('CONSULTER_LE_PROJET')")
     */
    public function detail_action(Projets $projet,Request $request, FileUploader $fileUploader,EntityManagerInterface $em,ProjetsRepository $projetsRepository): Response
    {

        $path = $this->getParameter('forms_directory') . '/forms-projet.yml';
        $generateForm=new GenerateForm($projet->getTypeProjet()->getId(),$path,$em);
        $form_fields=$generateForm->getFields([1,2,3]);
        $this->setDataForm($form_fields,ProjetsData::class,$projet);
        $form = $this->createForm(ProjetDataType::class, $projet, array("schema_form" => $form_fields));
        $contacts=$this->getDoctrine()->getRepository(CarteVisite::class)->getCarteVistesByCompte($projet->getCompte()->getId());
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $this->formSaveData($form_fields,$form,ProjetsData::class,$projet,$fileUploader);
            $titre = "";
            if ($projet->getTypeProjet()->getId() == "1") {
                $titre = $form["Denomination_projet"]->getData();
            } else if ($projet->getTypeProjet()->getId() == "2") {
                $titre = $form["intitule_projet"]->getData();
            } else if ($projet->getTypeProjet()->getId() == "3") {
                $titre = $form["intitule_projet"]->getData();
            } else if ($projet->getTypeProjet()->getId() == "4") {
                $titre = $form["Nomaction"]->getData();
            }
            $projet->setTitre($titre);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Ce projet a été modifié avec succès');
            // return $this->redirectToRoute('projets_detail',['id'=>$projet->getId()]);
         }

        $url="actions/detail_projet.html.twig";
        if ($projet->getTypeProjet()->getId() == "1") {
            $url="actions/detail_projet/projet_investissement.html.twig";
        } else if ($projet->getTypeProjet()->getId() == "2") {
            $url="actions/detail_projet/projet_sourcing.html.twig";
        } else if ($projet->getTypeProjet()->getId() == "3") {
            $url="actions/detail_projet/projet_export.html.twig";
        } else if ($projet->getTypeProjet()->getId() == "4") {
          $url="actions/detail_projet/actions.html.twig";
      }
        return $this->render($url, [
            'projet' => $projet,
            'jt_projet' => $this->getDoctrine()->getRepository(TinyJournal::class)->listJTByProjet($projet->getId()),
            'logs_projet' => $this->getDoctrine()->getRepository(LogProjet::class)->listLogsByProjet($projet->getId()),
            'list_status'=>$this->getDoctrine()->getRepository(EtatProjet::class)->findAll(),
            'data' =>   array("compte" => $projet->getCompte(), "contact" => $contacts),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ajax_projet", name="ajax_projet", methods={"GET"})
     */
    public function ajaxListsProjet(ProjetsRepository $projetsRepository, TranslatorInterface $translator)
    {
        $data = array();
        $projets =   $projetsRepository->findAll();
        foreach ($projets as $projet) {

            $edit = $this->generateUrl('projets_edit', [
                'id' => $projet->getId(),
            ]);
            $afficher = $this->generateUrl('actions_show', [
                'id' => $projet->getId(),
            ]);
            $actions = '<a class="dropdown-item" href=' . $afficher . '><i class="fa fa-eye"></i> ' . $translator->trans('compte.Show') . '</a>
            <a class="dropdown-item" href=' . $edit . '><i class="fa fa-edit"></i> ' . $translator->trans('compte.Edit') . '</a>';

            $liste_actions = '<div class="dropdown">
            <button class="btn btn-btn-blue dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">' .
                $actions
                . '</div>
            </div>';

            $data[] = array(
                "titre" => $projet->getTitre(),
                "logo_compte" => $projet->getCompte()->getLogo(),
                "date_creation" => $projet->getDateCreation(),
                "type" => $projet->getTypeProjet() ? $projet->getTypeProjet()->getNom() : "",
                "gpac" => $projet->getGerePar() ? "oui" : "non",
                "gere_par" => $projet->getGerePar() ? $projet->getGerePar()->getPrenom() . " " . $projet->getGerePar()->getNom() : "",
                "compte" => $projet->getCompte() ? $projet->getCompte()->getNomCompte() : "",
                "etat" => $projet->getEtatProjet() ? $projet->getEtatProjet()->getNom() : "",
                "actions" => $liste_actions
            );
        }

        $output = array(
            "TotalRecords" => count($projets),
            "TotalDisplayRecords" => 10,
            "data" => $data,
        );

        return new Response(json_encode($output));
    }

    /**
     * @Route("/new_convertion/{id}", name="projets_new_convertion", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function newHistorique(Projets $projet, Request $request): Response
    {
        $id=$projet->getTypeProjet()->getId();
        $type_projet = $this->formJson($id,"projets-historique-form");

        $form = $this->createForm(ProjetStatusType::class, null, array("schema_form" => $type_projet));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $projet->setType($id);
            $projet_type = $this->getDoctrine()->getRepository(TypeProjet::class)->findOneBy(['id' => $id]);
            $projet->setTypeProjet($projet_type);
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($type_projet["groupes"] as $key => $liste_groupes) {
                foreach ($liste_groupes["properties"] as $key => $propertie) {
                    if ($form[$propertie["nom"]]->getData() != "") {
                        if ($propertie["type"] == "entity") {
                            $data = new ProjetsData();
                            $data->setCle($propertie["nom"]);
                            $data->setValue($form[$propertie["nom"]]->getData()->getId());
                            $data->setProjet($projet);
                            $entityManager->persist($data);
                        } else {
                            $data = new ProjetsData();
                            $data->setCle($propertie["nom"]);
                            $data->setValue($form[$propertie["nom"]]->getData());
                            $data->setProjet($projet);
                            $entityManager->persist($data);
                        }
                    }
                }
            }


            $entityManager->persist($projet);
            $entityManager->flush();

            return $this->redirectToRoute('actions_index');
        }

        return $this->render('actions/new.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="actions_new", methods={"GET","POST"})
     * @Security("is_granted('CREATION_DE_PROJET')")
     */
    public function new($id, Request $request, FileUploader $fileUploader,ProjetWorkflowHandler $pwh,EntityManagerInterface $em): Response
    {
        $projet = new Projets();
        $projet->setCreePar($this->getUser());

        $path = $this->getParameter('forms_directory') . '/forms-projet.yml';
        $generateForm=new GenerateForm($id,$path,$em);
        $form_fields=$generateForm->getFields([1]);
        $this->setDataForm($form_fields,ProjetsData::class,$projet);
        $form = $this->createForm(ProjetsType::class, $projet, array("schema_form" => $form_fields));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $projet_type = $this->getDoctrine()->getRepository(TypeProjet::class)->findOneBy(['id' => $id]);
            $projet->setTypeProjet($projet_type);
            $projet->setType($projet_type->getId());

            foreach ($form_fields as $field) {
                    $name=$field["name"];
                    $type=$field["type"];
                    if ($form[$name]->getData() != "") {
                        if ($type == "EntityType") {
                            $data = new ProjetsData();
                            $data->setCle($name);
                            $data->setValue($form[$name]->getData()->getId());
                            $data->setProjet($projet);
                            $entityManager->persist($data);
                        } else if ($type == "FileType") {
                            $file = $form->get($name)->getData();
                            if ($file) {
                                $newFilename = $fileUploader->upload($file);

                                $data = new ProjetsData();

                                $data->setCle($name);
                                $data->setValue($newFilename);
                                $data->setProjet($projet);
                                $entityManager->persist($data);
                            }
                        } else if($type == "MultiSelectType"){
                          if($form[$name]->getData()){
                              $array_object=[];
                              foreach ($form[$name]->getData() as $object){
                                  array_push($array_object,$object->getId());
                              }
                              $data = new ProjetsData();
                              $data->setCle($name);
                              $data->setValue(json_encode($array_object));
                              $data->setProjet($projet);
                              $entityManager->persist($data);
                           }
                      } elseif($type =="DateType"){
                              $data = new ProjetsData();
                              $data->setCle($name);
                              $data->setValue($form[$name]->getViewData());
                              $data->setProjet($projet);
                              $entityManager->persist($data);
                    }else {
                            $data = new ProjetsData();
                            $data->setCle($name);
                            $data->setValue($form[$name]->getData());
                            $data->setProjet($projet);
                            $entityManager->persist($data);
                          }
                        }
                      }
            $titre = "";
            if ($projet->getTypeProjet()->getId() == "1") {
                $titre = $form["Denomination_projet"]->getData();
            } else if ($projet->getTypeProjet()->getId() == "2") {
                $titre = $form["intitule_projet"]->getData();
            } else if ($projet->getTypeProjet()->getId() == "3") {
                $titre = $form["intitule_projet"]->getData();
            } else if ($projet->getTypeProjet()->getId() == "4") {
                $titre = $form["Nomaction"]->getData();
            }

            $projet->setTitre($titre);
            $projet->setDateCreation(new \DateTimeImmutable());
            $projet->setIsDeleted(false);
            $entityManager->persist($projet);
            $entityManager->flush();
            $this->addFlash('success', 'Le nouveau projet a été créé avec succès');
            $pwh->handle($projet, $projet->getEtatProjet()->getNom());
            return $this->redirectToRoute('actions_index');
        }


        return $this->render('actions/new.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    } 

    /**
     * @Route("/change_statuts/{status}/{projet}", name="projet_change_status", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function switchWorkflow(EtatProjet $status,Projets $projet,ProjetWorkflowHandler $pwh)
    {
        try {
            $transition=$status->getNom();
            $projet->setEtatProjet($status);
            $pwh->handle($projet, $transition);

        } catch (LogicException $e) {
            $this->addFlash(
                'error',
                sprintf('Can not execute transition %s for PR: %d', $transition, $projet->getId())
            );
        }
        return $this->redirectToRoute('projets_detail',['id'=>$projet->getId()]);
    }
    /**
     * @Route("/change_gpac/{isgpac}/{projet}", name="projet_change_gpac", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function changegpac($isgpac,Projets $projet)
    { 

        $projet->setGPAC($isgpac);
        $em=$this->getDoctrine()->getManager();
        $em->persist($projet);
        $em->flush();
        // $message=$this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet (".$event->getSubject()->getTitre().") à ".$to->getNom();
        // $this->mailer->sendMail($this->user->getUser()->getEmail(),$message,"le projet : ".$event->getSubject()->getTitre()." (Changement Status)");

        return $this->redirectToRoute('projets_detail',['id'=>$projet->getId()]);
    }


    /**
     * @Route("/{id}", name="actions_show", methods={"GET","POST"})
     * @Security("is_granted('CONSULTER_LE_PROJET')")
     */
    public function show(Request $request, Projets $projet,EntityManagerInterface $em): Response
    {
        if ($request->isMethod('post')) {

            $path = $this->getParameter('forms_directory') . '/forms-projet.yml';
            $generateForm=new GenerateForm($projet->getTypeProjet()->getId(),$path,$em);
            $form_fields=$generateForm->getFields([1]);
            $this->setDataForm($form_fields,ProjetsData::class,$projet);
            $form = $this->createForm(ProjetDataType::class, $projet, array("schema_form" => $form_fields));
            return $this->render('actions/details.html.twig', [
                'projet' => $projet,
                'form' => $form->createView()
            ]);
        }

        return $this->render('actions/show.html.twig', [
            'projet' => $projet,
        ]);
    }


    private function formJson(int $id = null,string $schema="projets-form")
    {
        $form = $this->getParameter('data_directory') . '/'.$schema.'.json';
        $type_projets = json_decode(file_get_contents($form), true);;
        $type_projet = null;
        if ($id) {
            foreach ($type_projets["projets"] as $key => $value) {
                if ($value["type"] == $id) {
                    $type_projet = $value;
                    break;
                }
            }
        }

        return $type_projet;
    }



    /**
     * @Route("/{id}", name="actions_delete", methods={"DELETE"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function delete(Request $request, Projets $projet): Response
    {
        if ($this->isCsrfTokenValid('delete' . $projet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $projet->setIsDeleted(true);
            $entityManager->persist($projet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('actions_index');
    }

}
