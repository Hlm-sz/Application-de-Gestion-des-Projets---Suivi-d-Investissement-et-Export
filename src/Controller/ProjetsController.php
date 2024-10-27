<?php

namespace App\Controller;

use App\Domain\SecteurDomain;
use App\Entity\CarteVisite;
use App\Entity\Compte;
use App\Entity\Contact;
use App\Entity\Restriction;
use App\Entity\TinyJournal;
use App\Entity\CompteData;
//use App\Entity\DataGpac;
use App\Entity\Groupe;
use App\Entity\EtatProjet;
use App\Entity\LogProjet;
use App\Entity\Projets;
use App\Entity\ProjetsData;
use App\Entity\Secteur;
use App\Entity\TypeProjet;
use App\Entity\User;
use App\Entity\Region;
use App\Entity\Ville;
use App\Entity\Province;
use App\Entity\Zone;
use App\Entity\Pays;
use App\FiltreData\ProjetFiltre;
use App\Form\ContactType;
//use App\Form\DataGPACType;
use App\Form\DataProjetType;
use App\Form\FormProjectType;
use App\Form\ProjetDataType;
use App\Form\ProjetFiltreType;
use App\Form\ProjetStatusType;
use App\Form\ProjetsType;
use App\Entity\Event;
use App\Repository\ProjetsDataRepository;
use App\Repository\ProjetsRepository;
use App\Repository\TypeProjetRepository;
use App\Repository\SecteurRepository;
//use App\Service\CreateForm;
use App\Utils\GenerateForm;
use App\Utils\Uploader\FileUploader;
use App\Utils\Workflow\ProjetWorkflowHandler;
use App\Utils\Workflow\ProjetToCompteWorkflowHandler;
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
use Symfony\Component\Security\Core\Security as atom;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use App\Services\Mailer\Mailer;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * @Route("/projets")
 */
class ProjetsController extends AbstractController
{

    private $mailer;
    private $user;
    public function __construct(atom $security,Mailer $mailer)
    {
        $this->mailer=$mailer;
        $this->user=$security;
    }



    /**
     * @Route("/dashbord", name="projets_dashbord", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function dashbord(Request $request,SecteurDomain $secteurDomain,TypeProjetRepository $typeProjetRepository, ProjetsRepository $projetsRepository): Response
    {
        $telecharger=$request->query->get('telecharger')==1?1:0;
        $data=new ProjetFiltre();
        $form = $this->createForm(ProjetFiltreType::class, $data);
        $form->handleRequest($request);
        if($telecharger==1){
            $request->query->remove('telecharger');
            $this->telecharger($data);
        }
        $secteur=null;
        $id=$request->get('secteur')?$request->get('secteur'):null;
        if($id){
            $secteur=$this->getDoctrine()->getRepository(Secteur::class)->findOneBy(['id'=>$id]);
            $secteurs=$this->getDoctrine()->getRepository(Secteur::class)->findBy(['id'=>$id]);
        }else{
            $secteurs=$secteurDomain->getSecteurByUser();
        }
        foreach ($secteurs as $_secteur){
            $_secteur->projets=$projetsRepository->listeProjetBysecteur($_secteur->getId(),$data);
        }
        $restrictions=$this->getUser()->getGroupe()->getRestrictions();
        $rests = [];
        foreach ($restrictions as $restriction){
            if($restriction->getId() != 1 && $restriction->getId() != 5 ){
                
                array_push($rests,$restriction->getId());
            }
        }
        if($rests == [6]){

            foreach ($secteurs as $_secteur){
                $_secteur->projets=$projetsRepository->listeProjetNonConfBysecteur($_secteur->getId(),$data);
            }

        } elseif($rests == [7]){

            foreach ($secteurs as $_secteur){
                $_secteur->projets=$projetsRepository->listeProjetExpSourBysecteur($_secteur->getId(),$data);
            }
            
        } elseif($rests == [8]) {

            foreach ($secteurs as $_secteur) {
                $_secteur->projets = $projetsRepository->listeProjetInvestBysecteur($_secteur->getId(),$data);
            }

        } elseif($rests == [2,6]){
            $secteurs = $this->getUser()->getSecteurs();
            foreach ($secteurs as $_secteur){
                $_secteur->projets=$projetsRepository->listeProjetBysecteurUser($_secteur->getId(),$data,$this->getUser()->getId());
            }
            
        } elseif($rests == [2,7]){
            $secteurs = $this->getUser()->getSecteurs();
            foreach ($secteurs as $_secteur){
                $_secteur->projets=$projetsRepository->listeProjetExpSourBysecteurOwnNoConf($_secteur->getId(),$data,$this->getUser()->getId());
            }
 
        } elseif($rests == [2,6,7]){
            $secteurs = $this->getUser()->getSecteurs();
            foreach ($secteurs as $_secteur){
                $_secteur->projets=$projetsRepository->listeProjetExpSourBysecteurOwnConf($_secteur->getId(),$data,$this->getUser()->getId());
            }
 
        } elseif($rests == [2,8]){
            $secteurs = $this->getUser()->getSecteurs();
            foreach ($secteurs as $_secteur){
                $_secteur->projets=$projetsRepository->listeProjetInvestBysecteurOwnNoCOnf($_secteur->getId(),$data,$this->getUser()->getId());
                }
             
        } elseif($rests == [2,6,8]) {
            $secteurs = $this->getUser()->getSecteurs();
            foreach ($secteurs as $_secteur) {
                $_secteur->projets=$projetsRepository->listeProjetInvestBysecteurOwnCOnf(
                    $_secteur->getId(),$data,$this->getUser()->getId());
            }

        }else{
            //$secteurs = $this->getUser()->getSecteurs();
            foreach ($secteurs as $_secteur){
                //$_secteur->projets=$projetsRepository->listeProjetBysecteur($_secteur->getId(),$data);
                $_secteur->projets=$projetsRepository->listeProjetBysecteurNewOrg($_secteur->getId(),$data);
            }
        }
       
        return $this->render('projets/dashbord/index.html.twig', [
            'type_projet' => $typeProjetRepository->findAll(),
            'secteurs'=>$secteurs,
            'listeSecteurs'=>$secteurDomain->getSecteurByUser(),
            'secteur_active'=>$secteur,
            'form'=>$form->createView()
        ]);
    }


    /**
     * @Route("/filtre", name="projets_filtre", methods={"GET"})
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
        $data=new ProjetFiltre();
        $form = $this->createForm(ProjetFiltreType::class, $data);
        $form->handleRequest($request);
        if($telecharger==1){
            $request->query->remove('telecharger');
            $request->request->remove('telecharger');
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

       $projets= $projetsRepository->findSearch($data);
        foreach ($projets as $projet){
            $confidentiel=$projetsRepository->getValueField($projet->getId(),'Confidentiel')?$projetsRepository->getValueField($projet->getId(),'Confidentiel')['value']:0;
            $prioritaire=$projetsRepository->getValueField($projet->getId(),'Prioritaire')?$projetsRepository->getValueField($projet->getId(),'Prioritaire')['value']:0;
            $projet->confidentiel=($confidentiel=='oui' || $confidentiel==1)?1:0;
            $projet->prioritaire=($prioritaire=='oui' || $prioritaire==1)?1:0;
        }
        return $this->render('projets/filtre/index.html.twig', [
            'type_projet' => $typeProjetRepository->findAll(),
            'projects' => $projets,
            'secteurs'=>$secteurs,
            'listeSecteurs'=>$secteurDomain->getSecteurByUser(),
            'secteur_active'=>$secteur,
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("/{id}", name="projets_index", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function index(int $id=null,Request $request,TypeProjetRepository $typeProjetRepository, ProjetsRepository $projetsRepository): Response
    {
        $telecharger=$request->query->get('telecharger')==1?1:0;
        $data=new ProjetFiltre();
        $projet = new Projets();
        $form = $this->createForm(ProjetFiltreType::class, $data);
        $form->handleRequest($request);
        if($telecharger==1){
            $request->query->remove('telecharger');
            $request->request->remove('telecharger');
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
        $rests = [];
            
        $secteurs = $this->getUser()->getSecteurs();
        //$secteurs = $this->getDoctrine()->getRepository(Secteur::class)->findAll();
        $projets= $projetsRepository->findSearch($data);
        
        foreach ($restrictions as $restriction){
            if($restriction->getId() != 1 && $restriction->getId() != 5 ){
                array_push($rests,$restriction->getId());
            }
        }
           
            if($rests == [1]){

                $secteurs = $this->getUser()->getSecteurs();

            }elseif($rests == [2]){

                $secteurs = $this->getDoctrine()->getRepository(Secteur::class)->ListsSecteursByComptes($this->getUser()->getId());
                
            }elseif($rests == [6]){

                $projets = $projetsRepository->getNonConfid($data);

            }elseif($rests == [7]){

                $projets= $projetsRepository->getListeProjetExpoSourcing($data);
                
            }elseif($rests == [8]){

                $projets= $projetsRepository->getListeProjetInvest($data);
                
            }elseif($rests == [2,6]){

                $projets = $projetsRepository->getOwnConfid($data,$this->getUser()->getId());
                
            }elseif($rests == [2,7]){

                $projets= $projetsRepository->getListeProjetExpoSourcingOwnNoConf($data,$this->getUser()->getId());        

            }elseif($rests == [2,6,7]){
                
                $projets= $projetsRepository->getListeProjetExpoSourcingOwnConf($data,$this->getUser()->getId());                

                
            }elseif($rests == [2,8]){

                $projets= $projetsRepository->getListeProjetInvestOwnNoConf($data,$this->getUser()->getId());
                
            } elseif($rests == [2,6,8]){

                $projets= $projetsRepository->getListeProjetInvestOwnConf($data,$this->getUser()->getId());

            }else{
                 
                //$projets= $projetsRepository->findSearch($data);
                $projets= $projetsRepository->findSearchNewOrg($data, $this->getUser()->getSecteurs());
            }
           
            
        foreach ($projets as $projet){
            $confidentiel=$projetsRepository->getValueField($projet->getId(),'Confidentiel')?$projetsRepository->getValueField($projet->getId(),'Confidentiel')['value']:'0';
            $prioritaire=$projetsRepository->getValueField($projet->getId(),'Prioritaire')?$projetsRepository->getValueField($projet->getId(),'Prioritaire')['value']:'0';
            $projet->confidentiel=($confidentiel=='oui' || $confidentiel=='1')?1:0;
            $projet->prioritaire=($prioritaire=='oui' || $prioritaire=='1')?1:0;
        }
        
        return $this->render('projets/index.html.twig', [
            'type_projet' => $typeProjetRepository->findAll(),
            'projects' => $projets,
            'projet' => $projet,
            'secteurs'=>$secteurs,
            'secteur_active'=>$secteur,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/export/dataOld", name="projets_export_Old", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function exportOld(Request $request,ProjetsRepository $projetsRepository): Response
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
        $sheet->setCellValue('I'.$num, 'Date');
        $sheet->setCellValue('J'.$num, 'Secteurs');
        $n = 1;
        foreach($projetsRepository->listProjets() as $row){
            $rowNum = $n + 1;
            if($row->getStatus()){
                $status = array_keys($row->getStatus())[0];
            }else{
                $status = "";
            }
            if($row->getDateCreation()){
                $datecreation = $row->getDateCreation()->format('m-d-Y');
            }else{
                $datecreation = '';
            }
            // $confidentiel=$projetsRepository->getValueField($row['id'],'Confidentiel')?($projetsRepository->getValueField($row['id'],'Confidentiel')['value']?'oui':'non'):'non';
            $prioritaire=$projetsRepository->getValueField($row->getId(),'Prioritaire')?($projetsRepository->getValueField($row->getId(),'Prioritaire')['value']?'oui':'non'):'non';
            $sheet->setCellValue('A'.$rowNum, $row->getTitre());
            $sheet->setCellValue('B'.$rowNum, $row->getConfidentiel()?'oui':'non');
            $sheet->setCellValue('C'.$rowNum, $prioritaire);
            $sheet->setCellValue('D'.$rowNum, $row->getGerePar()->nomcomplet());
            $sheet->setCellValue('E'.$rowNum, $row->getCompte()->getNomCompte());
            $sheet->setCellValue('F'.$rowNum, $status);
            $sheet->setCellValue('G'.$rowNum, $row->getTypeProjet()->getNom());
            $sheet->setCellValue('H'.$rowNum, $row->getGPAC()?'oui':'non');
            $sheet->setCellValue('I'.$rowNum, $datecreation);
            $sheet->setCellValue('J'.$rowNum, $row->getCompte()->getSecteurs()[0]->getNom());
            $n++;
        }    
        // Create your Office 2007 Excel (XLSX Format)
        $writer = new Xlsx($spreadsheet);
        // Create a Temporary file in the system
        $fileName = 'Projets-'.time().'.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        // Create the excel file in the tmp directory of the system
        $writer->save($temp_file);
        // Return the excel file as an attachment
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
    }

    /**
     * @Route("/export/data", name="projets_export", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function export(Request $request, ProjetsRepository $projetsRep, SecteurRepository $secteurRepo): Response
    {
        $listeProjets=[];
        
        $projetsInfos = $projetsRep->findBy(['isDeleted' => false], ['date_creation' => 'DESC']);
        if(!empty($projetsInfos)){
            foreach ($projetsInfos as $projet) {
                $centreDecision = "";
                $mntInvest = 0;
                $nbEmploisDirects = 0;
                $nbEmploisIndirects = 0;
                $nbEmploisInduits = 0;
                $horizonProjet = "";
                $mecanismeAccomp = "";  
                $valCmdExpo = 0;
                $valCmdSou = 0;
                $valeurCmd = 0;
                $dateValeurCmd = "";
                $dateValCmdConf = "";
                $realise = "";
                $abouti = "";
                $convention = "";
                $depotCRI = "";
                $dateDepotCRI = "";
                $transfereAuMinistere = "";
                $dateSignatureConv = "";
                $datePVCloture = "";
                $dernierDetailsLibresDecision = "";
                $idSecteurPrj = "";
                $idSecteurPrjExpo = "";
                $idSecteurPrjSou = "";
                $prjPrioritaire = "";
                $idRegionPrj = "";
                $idVillePrj = "";
                $idProvincePrj = "";
                $idZoneGeo = "";
                $idPaysCommand = "";
                
                if(!is_null($projet->getCompte()) && !is_null($projet->getCompte()->getCentreDecision())) {
                    $centreDecision = $projet->getCompte()->getCentreDecision()->getNom();
                }
                
                /* Recherche dans projets_data */
                if(!empty($projet->getProjetsData())) {
                    foreach($projet->getProjetsData() as $projetData) {
                        if($projetData->getCle() == "mantant_invest") {
                            $mntInvest = $projetData->getValue();
                        }
                        if($projetData->getCle() == "nb_emplois_directs_invest") {
                            $nbEmploisDirects = $projetData->getValue();
                        }
                        if($projetData->getCle() == "nb_emplois_Indirects_invest") {
                            $nbEmploisIndirects = $projetData->getValue();
                        }
                        if($projetData->getCle() == "nb_emplois_Induits_invest") {
                            $nbEmploisInduits = $projetData->getValue();
                        }
                        if($projetData->getCle() == "horizon_projet_invest") {
                            $horizonProjet = $projetData->getValue();
                        }
                        if($projetData->getCle() == "mecanisme_accomp_invest") {
                            $mecanismeAccomp = $projetData->getValue();
                        }
                        if($projetData->getCle() == "valeur_cmd_expo") {
                            $valCmdExpo = $projetData->getValue();
                        }
                        if($projetData->getCle() == "valeur_cmd_sou") {
                            $valCmdSou = $projetData->getValue();
                        }
                        if($projetData->getCle() == "date_decision") {
                            $dateValeurCmd = $projetData->getValue();
                        }
                        if($projetData->getCle() == "Realise") {
                            $realise = $projetData->getValue();
                        }
                        if($projetData->getCle() == "Abouti") {
                            $abouti = $projetData->getValue();
                        }
                        if($projetData->getCle() == "Transfere_au_Ministere") {
                            $transfereAuMinistere = $projetData->getValue();
                        }
                        if($projetData->getCle() == "date_PV_decision") {
                            $datePVCloture = $projetData->getValue();
                        }
                        if($projetData->getCle() == "details_libres_decision") {
                            $dernierDetailsLibresDecision = $projetData->getValue();
                        }
                        if($projetData->getCle() == "Secteur") {
                            $idSecteurPrj = $projetData->getValue();
                        }
                        if($projetData->getCle() == "secteur_expo") {
                            $idSecteurPrjExpo = $projetData->getValue();
                        }
                        if($projetData->getCle() == "secteur_sou") {
                            $idSecteurPrjSou = $projetData->getValue();
                        }
                        if($projetData->getCle() == "Prioritaire") {
                            $prjPrioritaire = $projetData->getValue();
                        }
                        if($projetData->getCle() == "Localisation") {
                            $idRegionPrj = $projetData->getValue();
                        }
                        if($projetData->getCle() == "Ville") {
                            $idVillePrj = $projetData->getValue();
                        }
                        if($projetData->getCle() == "Province") {
                            $idProvincePrj = $projetData->getValue();
                        }
                        if($projetData->getCle() == "zone_cible") {
                            $idZoneGeo = $projetData->getValue();
                        }
                        if($projetData->getCle() == "pays_command") {
                            $idPaysCommand = $projetData->getValue();
                        }
                    }
                }
                
                /* Type du projet */
                $typeProjet = "";
                $typeProjetId = 0;
                if(!is_null($projet->getTypeProjet())) {
                    $typeProjet = $projet->getTypeProjet()->getNom();
                    $typeProjetId = $projet->getTypeProjet()->getId();
                }
                
                /* Tester et prendre les valeurs selon le type du projet */
                if($typeProjetId == 3) {
                    $valeurCmd = $valCmdExpo;
                    $idSecteurPrj = $idSecteurPrjExpo;
                } else if($typeProjetId == 2) {
                    $valeurCmd = $valCmdSou;
                    $idSecteurPrj = $idSecteurPrjSou;
                }
                /* ligne 535 : Filtrage sur ses secteurs --decalge de 10 lgines--*/
                $ProjTestSect = false;
                foreach ( $this->getUser()->getSecteurs() as $_sect ){
                    if ( $idSecteurPrj == $_sect->getId())
                        $ProjTestSect = true;
                }
                if ( $ProjTestSect == false )
                    continue ;
                /* Fin : Filtrage sur ses secteurs */
 
                if ($valeurCmd != 0) {
                    $dateValCmdConf = $dateValeurCmd;
                }
                
                /* Secteur du projet */
                $secteurProjet = "";
                if(!is_null($idSecteurPrj)) {
                    $secteur = $secteurRepo->findOneBy(['id' => $idSecteurPrj]);
                    if(!is_null($secteur)) {
                        $secteurProjet = $secteur->getNom();
                    }
                }
                
                /* Région du projet */
                $regionProjet = "";
                if(!is_null($idRegionPrj)) {
                    $region = $this->getDoctrine()->getRepository(Region::class)
                            ->findOneBy(['id' => $idRegionPrj,'isDeleted' => false]);
                    if(!is_null($region)) {
                        $regionProjet = $region->getNom();
                    }
                }
                
                /* Ville du projet */
                $villeProjet = "";
                if(!is_null($idVillePrj)) {
                    $ville = $this->getDoctrine()->getRepository(Ville::class)->findOneBy(['id' => $idVillePrj]);
                    if(!is_null($ville)) {
                        $villeProjet = $ville->getNom();
                    }
                }
                /* Province du projet */
                $provinceProjet = "";
                if(!is_null($idProvincePrj)) {
                    $province = $this->getDoctrine()->getRepository(Province::class)->findOneBy(['id' => $idProvincePrj]);
                    if(!is_null($province)) {
                        $provinceProjet = $province->getNom();
                    }
                }
                /* Zone Geographique */
                $zoneGeoPrj = "";
                if(!is_null($idZoneGeo)) {
                    $zoneGeo = $this->getDoctrine()->getRepository(Zone::class)->findOneBy(['id' => $idZoneGeo]);
                    if(!is_null($zoneGeo)) {
                        $zoneGeoPrj = $zoneGeo->getNom();
                    }
                }
                /* Pays Commanditaire */
                $paysCommandPrj = "";
                if(!is_null($idPaysCommand)) {
                    $paysCommand = $this->getDoctrine()->getRepository(Pays::class)->findBy(['id' => json_decode($idPaysCommand)]);
                    if(!empty($paysCommand)) {
                        foreach ($paysCommand as $pays) {
                            $paysCommandPrj .=" / ".$pays->getNom();
                        }
                    }
                }
                
                /* Date du changement statut Intérêt à Décision */
                $idStatutPrj = 0;
                $statutPrj = "";
                $datePassageDecision = "";
                if(!is_null($projet->getEtatProjet())) {
                    $idStatutPrj = $projet->getEtatProjet()->getId();
                    $statutPrj = $projet->getEtatProjet()->getNom();
                    /* Si le projet en Décision, on cherche la date du changement */
                    if ($idStatutPrj == 2) {
                        if(!is_null($projet->getLogProjets())) {
                            $maxId = 0;
                            foreach($projet->getLogProjets() as $logProjet) {
                                if($logProjet->getStatus() == "Décision") {
                                    if($maxId < $logProjet->getId()) {
                                        $maxId = $logProjet->getId();
                                        $datePassageDecision = $logProjet->getDateCreation()->format("d/m/Y");
                                    }
                                }
                            }
                        }
                    }
                }

                /* Recherche dans log_projet */
                $signatureLOI = "";
                $dateSignatureLOI = "";
                $moUEnCours = "";
                $dateMoUEnCours = "";
                $moUEnCoursPrep = "";
                $dateMoUEnCoursPrep = "";
                $cmdPrevExport = "";
                $dateCmdPrevExport = "";
                $cmdPrevSourcing = "";
                $dateCmdPrevSou = "";
                $loiSourcingRecue = "";
                $dateCmdPrev = "";
                $cmdPrev  = "";
                $cmdPrevTrouve  = false;
                $loiRecueTrouve = false;
                $signatureLOITrouve = false;
                $moUEnCoursTrouve = false;
                $moUEnCoursPrepTrouve = false;
                $dateFermeturePrj = "";
                $dateFermeturePrjTrouve = false;
                $tierPrj = "";
                $tierPrjTrouve = false;
                
                $LogProjetsList = $this->getDoctrine()->getRepository(LogProjet::class)->listLogsByProjet($projet->getId());
                
                if(!empty($LogProjetsList)) {
                    
                    foreach($LogProjetsList as $logProjet) {
                        
                        if($logProjet->getStatus() == "Action") {
                            $listeCommentaire = explode(" \n ", $logProjet->getCommentaire());
                            foreach($listeCommentaire as $commentaire) {
                                /* Pour les projets investissement */
                                if ((strpos($commentaire, "Loi Signe : Oui") === 0)
                                    && ($signatureLOITrouve == false) ) {
                                        
                                    $signatureLOI = "Oui";
                                    $signatureLOITrouve = true;
                                    
                                    $logProjetCommentaire = $logProjet->getCommentaire();
                                    $annee = substr($logProjetCommentaire,7,4);
                                    $mois = substr($logProjetCommentaire,12,2);
                                    $jour = substr($logProjetCommentaire,15,2);
                                    if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                        $dateSignatureLOI = $jour."/".$mois."/".$annee;
                                    }
                                }
                                if ((mb_substr($commentaire, 9, 27, 'utf8') === "MoU en cours de préparation")
                                    && ($moUEnCoursPrepTrouve == false)) {
                                        
                                    $moUEnCoursPrep = "Oui";
                                    $moUEnCoursPrepTrouve = true;
                                    $logProjetCommentaire = $logProjet->getCommentaire();
                                    $annee = substr($logProjetCommentaire,7,4);
                                    $mois = substr($logProjetCommentaire,12,2);
                                    $jour = substr($logProjetCommentaire,15,2);
                                    if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                        $dateMoUEnCoursPrep = $jour."/".$mois."/".$annee;
                                    }
                                }
                                if ((mb_substr($commentaire, 9, 25, 'utf8') === "MoU en cours de signature")
                                    && ($moUEnCoursTrouve == false)) {
                                    
                                    $moUEnCours = "Oui";
                                    $moUEnCoursTrouve = true;
                                    $logProjetCommentaire = $logProjet->getCommentaire();
                                    $annee = substr($logProjetCommentaire,7,4);
                                    $mois = substr($logProjetCommentaire,12,2);
                                    $jour = substr($logProjetCommentaire,15,2);
                                    if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                        $dateMoUEnCours = $jour."/".$mois."/".$annee;
                                    }
                                }
                                
                                /* Pour les projets Export et Sourcing */
                                if ((strpos($commentaire, "Val Cmd Prév :") === 0) 
                                    && ($cmdPrevTrouve == false) && (mb_strlen($commentaire, 'utf8') > 15) ) {
                                    
                                    $cmdPrevTemp = substr($commentaire, 15);
                                    $cmdPrevTemp = str_replace(",",".", $cmdPrevTemp);
                                    $cmdPrev = trim($cmdPrevTemp);
                                    $cmdPrevTrouve = true;

                                    $logProjetCommentaire = $logProjet->getCommentaire();
                                    $annee = substr($logProjetCommentaire,7,4);
                                    $mois = substr($logProjetCommentaire,12,2);
                                    $jour = substr($logProjetCommentaire,15,2);
                                    if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                        $dateCmdPrev = $jour."/".$mois."/".$annee;
                                    } else {
                                        $dateCmdPrev = "";
                                    }
                                }
                                if ((strpos($commentaire, "Loi Reçue : Oui") === 0)
                                    && ($loiRecueTrouve == false) ) {
                                        
                                    $loiSourcingRecue = "Oui";
                                    $loiRecueTrouve = true;
                                }
                                
                                /* Pour les projets Investissement */
                                if ((strpos($commentaire, "Tier :") === 0)
                                    && ($tierPrjTrouve == false) ) {
                                        
                                    $tierPrj = substr($commentaire,7);
                                    $tierPrjTrouve = true;
                                }
                                
                                
                            }  /* pour chaque partie du commentaire */
                        }  /* pour chaque log de type Action */
						
                        if($logProjet->getStatus() == "Fermé") {
                            /* Si le projet est au statut Fermé, on recupere la date de fermeture */
                            $idStatutPrjTemp = !empty($projet->getEtatProjet()) ? $projet->getEtatProjet()->getId() : 0;
                            if ((mb_substr($logProjet->getCommentaire(), -7, 7, 'utf8') === "à Fermé")
                                && ($dateFermeturePrjTrouve == false) 
                                && ($idStatutPrjTemp == 3)) {
                                    
                                if(!is_null($logProjet->getDateCreation())){
                                    $dateFermeturePrj = $logProjet->getDateCreation()->format("d/m/Y");
                                }
                                $dateFermeturePrjTrouve = true;
                            }
                        }  /* pour chaque log de type Fermé */
                    }
                }
                
                /* Recherche dans tiny_journal */
                $decisionConfirmee = "";   /* MoU signé */
                $dateSignatureMOU = "";
                $signatureMouTrouve = false;
                $standby = "";
                $dateStandby = "";
                $standbyTrouve = false;
                $dateStandbyTrouve = false;
                $raisonStandby = "";
                $raisonStandbyTrouve = false;
                $actionRequiseStandby = "";
                $actionRequiseStandbyTrouve = false;
                $bloque = "";
                $dateBloque = "";
                $bloqueTrouve = false;
                $dateBloqueTrouve = false;
                $raisonBloque = "";
                $raisonBloqueTrouve = false;
                $actionRequiseDebloquer = "";
                $actionRequiseDebloquerTrouve = false;
                $reactive = "";
                $reactiveTrouve = false;
                $dateReactivation = "";
                $dateReactivationTrouve = false;
                $debloque = "";
                $debloqueTrouve = false;
                $dateDeblocage = "";
                $dateDeblocageTrouve = false;
                $dateRealisation = "";
                $dateRealisationTrouve = false;
                $primesPrevues = "";
                $primesPrevuesTrouve = false;
                $primesOctroyees = "";
                $primesOctroyeesTrouve = false;
                $depotCRITrouve = false;
                $dateDepotCRITrouve = false;
                $approuveCRUI = "";
                $approuveCRUITrouve = false;
                $dateApprouveCRUI = "";
                $dateApprouveCRUITrouve = false;
                $valideCTPS = "";
                $valideCTPSTrouve = false;
                $dateValideCTPS = "";
                $dateValideCTPSTrouve = false;
                $ajourneCTPS = "";
                $ajourneCTPSTrouve = false;
                $dateAjournementCTPS = "";
                $dateAjournementCTPSTrouve = false;
                $rejeteCTPS = "";
                $rejeteCTPSTrouve = false;
                $dateRejetCTPS = "";
                $dateRejetCTPSTrouve = false;
                $motifRejetCTPS = "";
                $motifRejetCTPSTrouve = false;
                $comptabiliseCA = "";
                $comptabiliseCATrouve = false;
                $anneeNCA = "";
                $anneeNCATrouve = false;
                $statutNCA = "";
                $statutNCATrouve = false;
                $anneeN1CA = "";
                $anneeN1CATrouve = false;
                $statutN1CA = "";
                $statutN1CATrouve = false;
                $conventionTrouve = false;
                $dateSignatureConvTrouve = false;
                $approuveCNI = "";
                $approuveCNITrouve = false;
                $dateApprouveCNI = "";
                $dateApprouveCNITrouve = false;
                $capexConvention = "";
                $capexConventionTrouve = false;
                $nbEmploisDirectsCnv = "";
                $nbEmploisDirectsCnvTrouve = false;
                $nbEmploisIndirectsCnv = "";
                $nbEmploisIndirectsCnvTrouve = false;
                
                $prjTinyJournalList = $this->getDoctrine()->getRepository(TinyJournal::class)->listJTByProjet($projet->getId());
                
                if(!empty($prjTinyJournalList)) {
                    foreach($prjTinyJournalList as $tinyJournal) {
                        
                        $listeCommentaire = explode("\n", $tinyJournal->getCommentaire());
                        foreach($listeCommentaire as $commentaire) {
                            
                            if ((strpos($commentaire, "Signature de MoU") === 0)
                                && ($signatureMouTrouve == false) ) {
                                    
                                $decisionConfirmee = "Oui";
                                $signatureMouTrouve = true;
                                    
                                $tinyJournalCommentaire = $tinyJournal->getCommentaire();
                                $annee = substr($tinyJournalCommentaire,16,4);
                                $mois = substr($tinyJournalCommentaire,21,2);
                                $jour = substr($tinyJournalCommentaire,24,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateSignatureMOU = $jour."/".$mois."/".$annee;
                                }
                            }
                            
                            if ((strpos($commentaire, "Standby") === 0)
                                && ($standbyTrouve == false) ) {
                                    
                                $standby = "Oui";
                                $standbyTrouve = true;
                                    
                                /*$tinyJournalCommentaire = $tinyJournal->getCommentaire();
                                $annee = substr($tinyJournalCommentaire,16,4);
                                $mois = substr($tinyJournalCommentaire,21,2);
                                $jour = substr($tinyJournalCommentaire,24,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateStandby = $jour."/".$mois."/".$annee;
                                }*/
                            }
                            if ((strpos($commentaire, "Date Standby :") === 0)
                                && ($dateStandbyTrouve == false) ) {
                                    
                                $dateStandbyTrouve = true;
                                $dateStandbyTemp = mb_substr($commentaire, 15, null, 'utf8');
                                $annee = substr($dateStandbyTemp,0,4);
                                $mois = substr($dateStandbyTemp,5,2);
                                $jour = substr($dateStandbyTemp,8,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateStandby = $jour."/".$mois."/".$annee;
                                }
                            }
                            if (((strpos($commentaire, "Bloqué") === 0) || (strpos($commentaire, "Non Abouti") === 0))
                                && ($bloqueTrouve == false) ) {
                                    
                                $bloque = "Oui";
                                $bloqueTrouve = true;
                                    
                                /*$tinyJournalCommentaire = $tinyJournal->getCommentaire();
                                $annee = substr($tinyJournalCommentaire,16,4);
                                $mois = substr($tinyJournalCommentaire,21,2);
                                $jour = substr($tinyJournalCommentaire,24,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateBloque = $jour."/".$mois."/".$annee;
                                }*/
                            }
                            if ((strpos($commentaire, "Date de blocage :") === 0)
                                && ($dateBloqueTrouve == false) ) {
                                    
                                $dateBloqueTrouve = true;
                                $dateBloqueTemp = mb_substr($commentaire, 18, null, 'utf8');
                                $annee = substr($dateBloqueTemp,0,4);
                                $mois = substr($dateBloqueTemp,5,2);
                                $jour = substr($dateBloqueTemp,8,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateBloque = $jour."/".$mois."/".$annee;
                                }
                            }
                            if ((strpos($commentaire, "Raison :") === 0)
                                && ($raisonStandbyTrouve == false) ) {
                                    
                                $raisonStandby = mb_substr($commentaire, 9, null, 'utf8');
                                $raisonStandbyTrouve = true;
                            }
                            if ((strpos($commentaire, "Action requise :") === 0)
                                && ($actionRequiseStandbyTrouve == false) ) {
                                    
                                $actionRequiseStandby = mb_substr($commentaire, 17, null, 'utf8');
                                $actionRequiseStandbyTrouve = true;
                            }
                            if ((strpos($commentaire, "Raison de blocage :") === 0)
                                && ($raisonBloqueTrouve == false) ) {
                                    
                                $raisonBloque = mb_substr($commentaire, 20, null, 'utf8');
                                $raisonBloqueTrouve = true;
                            }
                            if ((strpos($commentaire, "Action requise pour le débloquer :") === 0)
                                && ($actionRequiseDebloquerTrouve == false) ) {
                                    
                                $actionRequiseDebloquer = mb_substr($commentaire, 35, null, 'utf8');
                                $actionRequiseDebloquerTrouve = true;
                            }
                            if ((strpos($commentaire, "Réactivé") === 0)
                                && ($reactiveTrouve == false) ) {

                                $reactive = "Oui";
                                $reactiveTrouve = true;
                            }
                            if ((strpos($commentaire, "Date de réactivation :") === 0)
                                && ($dateReactivationTrouve == false) ) {
                                    
                                $dateReactivationTrouve = true;
                                $dateReactivationTemp = mb_substr($commentaire, 23, null, 'utf8');
                                $annee = substr($dateReactivationTemp,0,4);
                                $mois = substr($dateReactivationTemp,5,2);
                                $jour = substr($dateReactivationTemp,8,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateReactivation = $jour."/".$mois."/".$annee;
                                }
                            }
                            if ((strpos($commentaire, "Débloqué") === 0)
                                && ($debloqueTrouve == false) ) {

                                $debloque = "Oui";
                                $debloqueTrouve = true;
                            }
                            if ((strpos($commentaire, "Date de déblocage :") === 0)
                                && ($dateDeblocageTrouve == false) ) {
                                    
                                $dateDeblocageTrouve = true;
                                $dateDeblocageTemp = mb_substr($commentaire, 20, null, 'utf8');
                                $annee = substr($dateDeblocageTemp,0,4);
                                $mois = substr($dateDeblocageTemp,5,2);
                                $jour = substr($dateDeblocageTemp,8,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateDeblocage = $jour."/".$mois."/".$annee;
                                }
                            }
                            if ((strpos($commentaire, "Date de Réalisation :") === 0)
                                && ($dateRealisationTrouve == false) ) {
                                    
                                $dateRealisationTrouve = true;
                                $dateRealisationTemp = mb_substr($commentaire, 22, null, 'utf8');
                                $annee = substr($dateRealisationTemp,0,4);
                                $mois = substr($dateRealisationTemp,5,2);
                                $jour = substr($dateRealisationTemp,8,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateRealisation = $jour."/".$mois."/".$annee;
                                }
                            }
                            if ((strpos($commentaire, "Engagées :") === 0)
                                && ($primesPrevuesTrouve == false) && (mb_strlen($commentaire, 'utf8') > 11) ) {
                                    
                                $primesPrevuesTemp = mb_substr($commentaire, 11, null, 'utf8');
                                $primesPrevuesTemp = str_replace(",",".", $primesPrevuesTemp);
                                $primesPrevues = trim($primesPrevuesTemp);
                                $primesPrevuesTrouve = true;
                            }
                            if ((strpos($commentaire, "Déboursées :") === 0)
                                && ($primesOctroyeesTrouve == false) && (mb_strlen($commentaire, 'utf8') > 13) ) {
                                    
                                $primesOctroyeesTemp = mb_substr($commentaire, 13, null, 'utf8');
                                $primesOctroyeesTemp = str_replace(",",".", $primesOctroyeesTemp);
                                $primesOctroyees = trim($primesOctroyeesTemp);
                                $primesOctroyeesTrouve = true;
                            }
                            if ((strpos($commentaire, "Dépôt CRI") === 0)
                                && ($depotCRITrouve == false) ) {
                                    
                                $depotCRI = "Oui";
                                $depotCRITrouve = true;
                            }
                            if ((strpos($commentaire, "Date de dépôt CRI :") === 0)
                                && ($dateDepotCRITrouve == false) ) {
                                        
                                $dateDepotCRITrouve = true;
                                $dateDepotCRITemp = mb_substr($commentaire, 20, null, 'utf8');
                                $annee = substr($dateDepotCRITemp,0,4);
                                $mois = substr($dateDepotCRITemp,5,2);
                                $jour = substr($dateDepotCRITemp,8,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateDepotCRI = $jour."/".$mois."/".$annee;
                                }
                            }
                            if ((strpos($commentaire, "Approuvé CRUI") === 0)
                                && ($approuveCRUITrouve == false) ) {
                                    
                                $approuveCRUI = "Oui";
                                $approuveCRUITrouve = true;
                            }
                            if ((strpos($commentaire, "Date d'approbation CRUI :") === 0)
                                && ($dateApprouveCRUITrouve == false) ) {
                                        
                                $dateApprouveCRUITrouve = true;
                                $dateApprouveCRUITemp = mb_substr($commentaire, 26, null, 'utf8');
                                $annee = substr($dateApprouveCRUITemp,0,4);
                                $mois = substr($dateApprouveCRUITemp,5,2);
                                $jour = substr($dateApprouveCRUITemp,8,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateApprouveCRUI = $jour."/".$mois."/".$annee;
                                }
                            }
                            if ((strpos($commentaire, "Validé CTPS") === 0)
                                && ($valideCTPSTrouve == false) ) {
                                    
                                $valideCTPS = "Oui";
                                $valideCTPSTrouve = true;
                            }
                            if ((strpos($commentaire, "Date de validation CTPS :") === 0)
                                && ($dateValideCTPSTrouve == false) ) {
                                        
                                $dateValideCTPSTrouve = true;
                                $dateValideCTPSTemp = mb_substr($commentaire, 26, null, 'utf8');
                                $annee = substr($dateValideCTPSTemp,0,4);
                                $mois = substr($dateValideCTPSTemp,5,2);
                                $jour = substr($dateValideCTPSTemp,8,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateValideCTPS = $jour."/".$mois."/".$annee;
                                }
                            }
                            if ((strpos($commentaire, "Ajourné CTPS") === 0)
                                && ($ajourneCTPSTrouve == false) ) {
                                    
                                $ajourneCTPS = "Oui";
                                $ajourneCTPSTrouve = true;
                            }
                            if ((strpos($commentaire, "Date d'ajournement CTPS :") === 0)
                                && ($dateAjournementCTPSTrouve == false) ) {
                                        
                                $dateAjournementCTPSTrouve = true;
                                $dateAjournementCTPSTemp = mb_substr($commentaire, 26, null, 'utf8');
                                $annee = substr($dateAjournementCTPSTemp,0,4);
                                $mois = substr($dateAjournementCTPSTemp,5,2);
                                $jour = substr($dateAjournementCTPSTemp,8,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateAjournementCTPS = $jour."/".$mois."/".$annee;
                                }
                            }
                            if ((strpos($commentaire, "Rejeté CTPS") === 0)
                                && ($rejeteCTPSTrouve == false) ) {
                                    
                                $rejeteCTPS = "Oui";
                                $rejeteCTPSTrouve = true;
                            }
                            if ((strpos($commentaire, "Date de rejet CTPS :") === 0)
                                && ($dateRejetCTPSTrouve == false) ) {
                                        
                                $dateRejetCTPSTrouve = true;
                                $dateRejetCTPSTemp = mb_substr($commentaire, 21, null, 'utf8');
                                $annee = substr($dateRejetCTPSTemp,0,4);
                                $mois = substr($dateRejetCTPSTemp,5,2);
                                $jour = substr($dateRejetCTPSTemp,8,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateRejetCTPS = $jour."/".$mois."/".$annee;
                                }
                            }
                            if ((strpos($commentaire, "Motif de rejet CTPS :") === 0)
                                && ($motifRejetCTPSTrouve == false) ) {
                                    
                                $motifRejetCTPS = mb_substr($commentaire, 22, null, 'utf8');
                                $motifRejetCTPSTrouve = true;
                            }
                            if ((strpos($commentaire, "Comptabilisé en CA") === 0)
                                && ($comptabiliseCATrouve == false) ) {
                                    
                                $comptabiliseCA = "Oui";
                                $comptabiliseCATrouve = true;
                            }
                            if ((strpos($commentaire, "Année N :") === 0)
                                && ($anneeNCATrouve == false) ) {
                                    
                                $anneeNCA = mb_substr($commentaire, 10, null, 'utf8');
                                $anneeNCATrouve = true;
                            }
                            if ((strpos($commentaire, "Année N+1 :") === 0)
                                && ($anneeN1CATrouve == false) ) {
                                    
                                $anneeN1CA = mb_substr($commentaire, 12, null, 'utf8');
                                $anneeN1CATrouve = true;
                            }
                            if ((strpos($commentaire, "Statut N :") === 0)
                                && ($statutNCATrouve == false) ) {
                                    
                                $statutNCA = mb_substr($commentaire, 11, null, 'utf8');
                                $statutNCATrouve = true;
                            }
                            if ((strpos($commentaire, "Statut N+1 :") === 0)
                                && ($statutN1CATrouve == false) ) {
                                    
                                $statutN1CA = mb_substr($commentaire, 13, null, 'utf8');
                                $statutN1CATrouve = true;
                            }
                            if ((strpos($commentaire, "Approuvé CNI") === 0)
                                && ($approuveCNITrouve == false) ) {
                                    
                                $approuveCNI = "Oui";
                                $approuveCNITrouve = true;
                            }
                            if ((strpos($commentaire, "Date d'approbation CNI :") === 0)
                                && ($dateApprouveCNITrouve == false) ) {
                                        
                                $dateApprouveCNITrouve = true;
                                $dateApprouveCNITemp = mb_substr($commentaire, 25, null, 'utf8');
                                $annee = substr($dateApprouveCNITemp,0,4);
                                $mois = substr($dateApprouveCNITemp,5,2);
                                $jour = substr($dateApprouveCNITemp,8,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateApprouveCNI = $jour."/".$mois."/".$annee;
                                }
                            }
                            if ((strpos($commentaire, "Convention") === 0)
                                && ($conventionTrouve == false) ) {
                                    
                                $convention = "Oui";
                                $conventionTrouve = true;
                            }
                            if ((strpos($commentaire, "Date signature convention :") === 0)
                                && ($dateSignatureConvTrouve == false) ) {
                                        
                                $dateSignatureConvTrouve = true;
                                $dateSignatureConvTemp = mb_substr($commentaire, 28, null, 'utf8');
                                $annee = substr($dateSignatureConvTemp,0,4);
                                $mois = substr($dateSignatureConvTemp,5,2);
                                $jour = substr($dateSignatureConvTemp,8,2);
                                if(is_numeric($annee) && is_numeric($mois) && is_numeric($jour)) {
                                    $dateSignatureConv = $jour."/".$mois."/".$annee;
                                }
                            }
                            if ((strpos($commentaire, "Capex (Millions/DHs) :") === 0)
                                && ($capexConventionTrouve == false) && (mb_strlen($commentaire, 'utf8') > 23) ) {
                                    
                                $capexConventionTemp = mb_substr($commentaire, 23, null, 'utf8');
                                $capexConventionTemp = str_replace(",",".", $capexConventionTemp);
                                $capexConvention = trim($capexConventionTemp);
                                $capexConventionTrouve = true;
                            }
                            if ((strpos($commentaire, "Nb d’emplois directs :") === 0)
                                && ($nbEmploisDirectsCnvTrouve == false) && (mb_strlen($commentaire, 'utf8') > 23) ) {
                                        
                                $nbEmploisDirectsCnvTemp = mb_substr($commentaire, 23, null, 'utf8');
                                $nbEmploisDirectsCnvTemp = str_replace(",",".", $nbEmploisDirectsCnvTemp);
                                $nbEmploisDirectsCnv = trim($nbEmploisDirectsCnvTemp);
                                $nbEmploisDirectsCnvTrouve = true;
                            }
                            if ((strpos($commentaire, "Nb d’emplois indirects :") === 0)
                                && ($nbEmploisIndirectsCnvTrouve == false) && (mb_strlen($commentaire, 'utf8') > 25) ) {
                                    
                                $nbEmploisIndirectsCnvTemp = mb_substr($commentaire, 25, null, 'utf8');
                                $nbEmploisIndirectsCnvTemp = str_replace(",",".", $nbEmploisIndirectsCnvTemp);
                                $nbEmploisIndirectsCnv = trim($nbEmploisIndirectsCnvTemp);
                                $nbEmploisIndirectsCnvTrouve = true;
                            }
                        }
                    }
                }
                
                /* Tester et prendre les valeurs selon le type du projet */
                if($typeProjetId == 3) {
                    $cmdPrevExport = $cmdPrev;
                    $dateCmdPrevExport = $dateCmdPrev;
                } else if($typeProjetId == 2) {
                    $cmdPrevSourcing = $cmdPrev;
                    $dateCmdPrevSou = $dateCmdPrev;
                }
                
                /* Géré par */
                $prjGerePar = "";
                if(!empty($projet->getGerePar())) {
                    $prjGerePar = $projet->getGerePar()->getPrenom(). ' ' . $projet->getGerePar()->getNom();
                }
                
                /* Liste des secteurs du comptes */
                $listeSecteurs = "";
                if(!empty($projet->getCompte()) && !empty($projet->getCompte()->getSecteurs())) {
                    foreach ($projet->getCompte()->getSecteurs() as $secteur) {
                        $listeSecteurs .=" / ".$secteur->getNom();
                    }
                }
                
                /* Collecte les informations sur le projet */
                array_push($listeProjets,["id" => $projet->getId() , "titreProjet" => $projet->getTitre(),
                    "typeProjet" => $typeProjet,
                    "prjConfidentiel" => $projet->getConfidentiel() ? 'Oui':'Non',
                    "prjPrioritaire" => $prjPrioritaire == '1' ? 'Oui' : 'Non',
                    "prjGerePar" => $prjGerePar,
                    "nomCompte" => !empty($projet->getCompte()) ? $projet->getCompte()->getNomCompte() : '',
                    "statutProjet" => !empty($projet->getEtatProjet()) ? $projet->getEtatProjet()->getNom() : '',
                    "typeProjet" => $typeProjet,
                    "GPAC" => $projet->getGPAC() ? 'Oui':'Non',
                    "dateCreation" => $projet->getDateCreation()->format("d-m-Y h:i"),
                    "listeSecteursCompte" => $listeSecteurs,
                    "secteurProjet" => $secteurProjet,
                    "centreDecision" => $centreDecision,
                    "regionProjet" => $regionProjet,
                    "villeProjet" => $villeProjet,
                    "provinceProjet" => $provinceProjet,
                    "zoneGeoPrj" => $zoneGeoPrj,
                    "paysCommandPrj" => $paysCommandPrj,
                    "mntInvest" => $mntInvest,
                    "nbEmploisDirects" => $nbEmploisDirects,
                    "nbEmploisIndirects" => $nbEmploisIndirects,
                    "nbEmploisInduits" => $nbEmploisInduits,
                    "horizonProjet" => $horizonProjet,
                    "mecanismeAccomp" => $mecanismeAccomp,
                    "valCmdPrevExport" => $cmdPrevExport,
                    "dateCmdPrevExport" => $dateCmdPrevExport,
                    "valCmdPrevSourcing" => $cmdPrevSourcing,
                    "dateCmdPrevSou" => $dateCmdPrevSou,
                    "LOISourcingRecue" => $loiSourcingRecue,
                    "valCmdConf" => $valeurCmd,
                    "dateValCmdConf" => $dateValCmdConf,
                    "signatureLOI" => $signatureLOI,
                    "dateSignatureLOI" => $dateSignatureLOI,
                    "moUEnCoursPrep" => $moUEnCoursPrep,
                    "dateMoUEnCoursPrep" => $dateMoUEnCoursPrep,
                    "moUEnCours" => $moUEnCours,
                    "dateMoUEnCours" => $dateMoUEnCours,
                    "datePassageDecision" => $datePassageDecision,
                    "abouti" => $abouti,
                    "convention" => $convention,
                    "primesPrevues" => $primesPrevues,
                    "primesOctroyees" => $primesOctroyees,
                    "dateSignatureMOU" => $dateSignatureMOU,
                    "decisionConfirmee" => $decisionConfirmee,
                    "depotCRI" => $depotCRI,
                    "dateDepotCRI" => $dateDepotCRI,
                    "transfAuMinistere" => $transfereAuMinistere,
                    "dateSignatureConv" => $dateSignatureConv,
                    "datePVCloture" => $datePVCloture,    /*Date de dépôt CRI*/
                    "dernierDetailsLibresDecision" => $dernierDetailsLibresDecision,
                    "realise" => $realise,
                    "dateRealisation" => $dateRealisation,
                    "dateFermeturePrj" => $dateFermeturePrj,
                    "tierPrj" => $tierPrj,
                    "standby" => $standby,
                    "dateStandby" => $dateStandby,
                    "raisonStandby" => $raisonStandby,
                    "actionRequiseStandby" => $actionRequiseStandby,
                    "reactive" => $reactive,
                    "dateReactivation" => $dateReactivation,
                    "bloque" => $bloque,
                    "dateBloque" => $dateBloque,
                    "raisonBloque" => $raisonBloque,
                    "actionRequiseDebloquer" => $actionRequiseDebloquer,
                    "debloque" => $debloque,
                    "dateDeblocage" => $dateDeblocage,
                    "approuveCRUI" => $approuveCRUI,
                    "dateApprouveCRUI" => $dateApprouveCRUI,
                    "valideCTPS" => $valideCTPS,
                    "dateValideCTPS" => $dateValideCTPS,
                    "ajourneCTPS" => $ajourneCTPS,
                    "dateAjournementCTPS" => $dateAjournementCTPS,
                    "rejeteCTPS" => $rejeteCTPS,
                    "dateRejetCTPS" => $dateRejetCTPS,
                    "motifRejetCTPS" => $motifRejetCTPS,
                    "comptabiliseCA" => $comptabiliseCA,
                    "anneeNCA" => $anneeNCA,
                    "statutNCA" => $statutNCA,
                    "anneeN1CA" => $anneeN1CA,
                    "statutN1CA" => $statutN1CA,
                    "approuveCNI" => $approuveCNI,
                    "dateApprouveCNI" => $dateApprouveCNI,
                    "capexConvention" => $capexConvention,
                    "nbEmploisDirectsCnv" => $nbEmploisDirectsCnv,
                    "nbEmploisIndirectsCnv" => $nbEmploisIndirectsCnv
                    
                ]);
               
            }
        }
        
        /* Traitement du fichier en sortie */
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $num=1;
        $sheet->setCellValue('A'.$num, 'Projet');
        $sheet->setCellValue('B'.$num, 'Confidentiel');
        $sheet->setCellValue('C'.$num, 'Stratégique');
        $sheet->setCellValue('D'.$num, 'Géré Par');
        $sheet->setCellValue('E'.$num, 'Compte');
        $sheet->setCellValue('F'.$num, 'Statut');
        $sheet->setCellValue('G'.$num, 'Type Projet');
        $sheet->setCellValue('H'.$num, 'GPAC');
        $sheet->setCellValue('I'.$num, 'Date Création');
        $sheet->setCellValue('J'.$num, 'Secteurs Compte');
        $sheet->setCellValue('K'.$num, 'Secteur Projet');
        $sheet->setCellValue('L'.$num, 'Centre Décision');
        $sheet->setCellValue('M'.$num, 'Région');
        $sheet->setCellValue('N'.$num, 'Province');
        $sheet->setCellValue('O'.$num, 'Zone géo');
        $sheet->setCellValue('P'.$num, 'Pays Command');
        $sheet->setCellValue('Q'.$num, 'Montant Investissement');
        $sheet->setCellValue('R'.$num, 'Nombre emplois directs');
        $sheet->setCellValue('S'.$num, 'Nombre emplois indirects');
        $sheet->setCellValue('T'.$num, 'Nombre emplois induits');
        $sheet->setCellValue('U'.$num, 'Horizon projet');
        $sheet->setCellValue('V'.$num, 'Mécanisme Accomp');
        /* Début : Pour les projets Export et Sourcing */
        $sheet->setCellValue('W'.$num, 'Commande prév. à l’export (MDhs)');
        $sheet->setCellValue('X'.$num, 'Date Commande prév. à l’export');
        $sheet->setCellValue('Y'.$num, 'Commande prév. au sourcing (MDhs)');
        $sheet->setCellValue('Z'.$num, 'Date Commande prév. au sourcing');
        $sheet->setCellValue('AA'.$num, 'LOI sourcing reçue');
        $sheet->setCellValue('AB'.$num, 'Commande confirmée (MDhs)');
        $sheet->setCellValue('AC'.$num, 'Date Valeur de la commande');
        /* Fin : Pour les projets Export et Sourcing */
        $sheet->setCellValue('AD'.$num, 'Tier');
        $sheet->setCellValue('AE'.$num, 'Signature LOI');
        $sheet->setCellValue('AF'.$num, 'Date Signature LOI');
        $sheet->setCellValue('AG'.$num, 'MOU En préparation');
        $sheet->setCellValue('AH'.$num, 'Date MOU En préparation');
        $sheet->setCellValue('AI'.$num, 'MOU En signature');
        $sheet->setCellValue('AJ'.$num, 'Date MOU En signature');
        $sheet->setCellValue('AK'.$num, 'Date Passage Décision');
        $sheet->setCellValue('AL'.$num, 'Standby');
        $sheet->setCellValue('AM'.$num, 'Date Standby');
        $sheet->setCellValue('AN'.$num, 'Raison Standby');
        $sheet->setCellValue('AO'.$num, 'Action requise');
        $sheet->setCellValue('AP'.$num, 'Réactivé');
        $sheet->setCellValue('AQ'.$num, 'Date de réactivation');
        $sheet->setCellValue('AR'.$num, 'Bloqué');
        $sheet->setCellValue('AS'.$num, 'Date blocage');
        $sheet->setCellValue('AT'.$num, 'Raison de blocage');
        $sheet->setCellValue('AU'.$num, 'Action requise débloquer');
        $sheet->setCellValue('AV'.$num, 'Débloqué');
        $sheet->setCellValue('AW'.$num, 'Date de déblocage');
        $sheet->setCellValue('AX'.$num, 'Dernier Détails Libres Décision');
        $sheet->setCellValue('AY'.$num, 'Comptabilisé en CA');
        $sheet->setCellValue('AZ'.$num, 'Année N CA');
        $sheet->setCellValue('BA'.$num, 'Statut N CA');
        $sheet->setCellValue('BB'.$num, 'Année N+1 CA');
        $sheet->setCellValue('BC'.$num, 'Statut N+1 CA');
        $sheet->setCellValue('BD'.$num, 'MoU signé');
        $sheet->setCellValue('BE'.$num, 'Date de signature de MoU');
        $sheet->setCellValue('BF'.$num, 'Dépôt CRI');
        $sheet->setCellValue('BG'.$num, 'Date Dépôt CRI');
        $sheet->setCellValue('BH'.$num, 'Approuvé CRUI');
        $sheet->setCellValue('BI'.$num, 'Date approbation CRUI');
        $sheet->setCellValue('BJ'.$num, 'Validé CTPS');
        $sheet->setCellValue('BK'.$num, 'Date validation CTPS');
        $sheet->setCellValue('BL'.$num, 'Ajourné CTPS');
        $sheet->setCellValue('BM'.$num, 'Date ajournement CTPS');
        $sheet->setCellValue('BN'.$num, 'Rejeté CTPS');
        $sheet->setCellValue('BO'.$num, 'Date rejet CTPS');
        $sheet->setCellValue('BP'.$num, 'Motif rejet CTPS');
        $sheet->setCellValue('BQ'.$num, 'Approuvé CNI');
        $sheet->setCellValue('BR'.$num, 'Date approbation CNI');
        $sheet->setCellValue('BS'.$num, 'Convention signée');
        $sheet->setCellValue('BT'.$num, 'Date signature Convention');        
        $sheet->setCellValue('BU'.$num, 'Capex Convention');
        $sheet->setCellValue('BV'.$num, 'Nb Emplois Directs Convention');
        $sheet->setCellValue('BW'.$num, 'Nb Emplois Indirects Convention');
        $sheet->setCellValue('BX'.$num, 'Primes engagées');
        $sheet->setCellValue('BY'.$num, 'Primes déboursées');
        $sheet->setCellValue('BZ'.$num, 'Réalisé');
        $sheet->setCellValue('CA'.$num, 'Date de Réalisation');
        $sheet->setCellValue('CB'.$num, 'Date Fermeture');
        
        foreach($listeProjets as $projet){
            $rowNum = $num + 1;
            
            $projetRealise = $projet['realise'] == '1' ? 'Oui' : '';
            //$projetAbouti = (($projet['abouti'] == '1') && ($projet['convention'] == '1')) ? 'Oui' : '';
            $projetDepotCRI = $projet['depotCRI'] == '1' ? 'Oui' : '';
            $projetTransfAuMinistere = $projet['transfAuMinistere'] == '1' ? 'Oui' : '';
            
            $sheet->setCellValue('A'.$rowNum, $projet['titreProjet']);
            
            $sheet->setCellValue('B'.$rowNum, $projet['prjConfidentiel']);
            $sheet->setCellValue('C'.$rowNum, $projet['prjPrioritaire']);
            $sheet->setCellValue('D'.$rowNum, $projet['prjGerePar']);
            $sheet->setCellValue('E'.$rowNum, $projet['nomCompte']);
            $sheet->setCellValue('F'.$rowNum, $projet['statutProjet']);
            $sheet->setCellValue('G'.$rowNum, $projet['typeProjet']);
            $sheet->setCellValue('H'.$rowNum, $projet['GPAC']);
            $sheet->setCellValue('I'.$rowNum, $projet['dateCreation']);
            $sheet->setCellValue('J'.$rowNum, $projet['listeSecteursCompte']);
            $sheet->setCellValue('K'.$rowNum, $projet['secteurProjet']);
            $sheet->setCellValue('L'.$rowNum, $projet['centreDecision']);
            $sheet->setCellValue('M'.$rowNum, $projet['regionProjet']);
            $sheet->setCellValue('N'.$rowNum, $projet['provinceProjet']);
            $sheet->setCellValue('O'.$rowNum, $projet['zoneGeoPrj']);
            $sheet->setCellValue('P'.$rowNum, $projet['paysCommandPrj']);
            $sheet->setCellValue('Q'.$rowNum, $projet['mntInvest']);
            $sheet->setCellValue('R'.$rowNum, $projet['nbEmploisDirects']);
            $sheet->setCellValue('S'.$rowNum, $projet['nbEmploisIndirects']);
            $sheet->setCellValue('T'.$rowNum, $projet['nbEmploisInduits']);
            $sheet->setCellValue('U'.$rowNum, $projet['horizonProjet']);
            $sheet->setCellValue('V'.$rowNum, $projet['mecanismeAccomp']);
            /* Début : Pour les projets Export et Sourcing */
            $sheet->setCellValue('W'.$rowNum, $projet['valCmdPrevExport']);
            $sheet->setCellValue('X'.$rowNum, $projet['dateCmdPrevExport']);
            $sheet->setCellValue('Y'.$rowNum, $projet['valCmdPrevSourcing']);
            $sheet->setCellValue('Z'.$rowNum, $projet['dateCmdPrevSou']);
            $sheet->setCellValue('AA'.$rowNum, $projet['LOISourcingRecue']);
            $sheet->setCellValue('AB'.$rowNum, $projet['valCmdConf']);
            $sheet->setCellValue('AC'.$rowNum, $projet['dateValCmdConf']);
            /* Fin : Pour les projets Export et Sourcing */
            $sheet->setCellValue('AD'.$rowNum, $projet['tierPrj']);
            $sheet->setCellValue('AE'.$rowNum, $projet['signatureLOI']);
            $sheet->setCellValue('AF'.$rowNum, $projet['dateSignatureLOI']);
            $sheet->setCellValue('AG'.$rowNum, $projet['moUEnCoursPrep']);
            $sheet->setCellValue('AH'.$rowNum, $projet['dateMoUEnCoursPrep']);
            $sheet->setCellValue('AI'.$rowNum, $projet['moUEnCours']);
            $sheet->setCellValue('AJ'.$rowNum, $projet['dateMoUEnCours']);
            $sheet->setCellValue('AK'.$rowNum, $projet['datePassageDecision']);
            $sheet->setCellValue('AL'.$rowNum, $projet['standby']);
            $sheet->setCellValue('AM'.$rowNum, $projet['dateStandby']);
            $sheet->setCellValue('AN'.$rowNum, $projet['raisonStandby']);
            $sheet->setCellValue('AO'.$rowNum, $projet['actionRequiseStandby']);
            $sheet->setCellValue('AP'.$rowNum, $projet['reactive']);
            $sheet->setCellValue('AQ'.$rowNum, $projet['dateReactivation']);
            $sheet->setCellValue('AR'.$rowNum, $projet['bloque']);
            $sheet->setCellValue('AS'.$rowNum, $projet['dateBloque']);
            $sheet->setCellValue('AT'.$rowNum, $projet['raisonBloque']);
            $sheet->setCellValue('AU'.$rowNum, $projet['actionRequiseDebloquer']);
            $sheet->setCellValue('AV'.$rowNum, $projet['debloque']);
            $sheet->setCellValue('AW'.$rowNum, $projet['dateDeblocage']);
            $sheet->setCellValue('AX'.$rowNum, $projet['dernierDetailsLibresDecision']);
            $sheet->setCellValue('AY'.$rowNum, $projet['comptabiliseCA']);
            $sheet->setCellValue('AZ'.$rowNum, $projet['anneeNCA']);
            $sheet->setCellValue('BA'.$rowNum, $projet['statutNCA']);
            $sheet->setCellValue('BB'.$rowNum, $projet['anneeN1CA']);
            $sheet->setCellValue('BC'.$rowNum, $projet['statutN1CA']);
            $sheet->setCellValue('BD'.$rowNum, $projet['decisionConfirmee']);   /* MoU signé */
            $sheet->setCellValue('BE'.$rowNum, $projet['dateSignatureMOU']);
            $sheet->setCellValue('BF'.$rowNum, $projet['depotCRI']);
            $sheet->setCellValue('BG'.$rowNum, $projet['dateDepotCRI']);
            $sheet->setCellValue('BH'.$rowNum, $projet['approuveCRUI']);
            $sheet->setCellValue('BI'.$rowNum, $projet['dateApprouveCRUI']);
            $sheet->setCellValue('BJ'.$rowNum, $projet['valideCTPS']);
            $sheet->setCellValue('BK'.$rowNum, $projet['dateValideCTPS']);
            $sheet->setCellValue('BL'.$rowNum, $projet['ajourneCTPS']);
            $sheet->setCellValue('BM'.$rowNum, $projet['dateAjournementCTPS']);
            $sheet->setCellValue('BN'.$rowNum, $projet['rejeteCTPS']);
            $sheet->setCellValue('BO'.$rowNum, $projet['dateRejetCTPS']);
            $sheet->setCellValue('BP'.$rowNum, $projet['motifRejetCTPS']);
            $sheet->setCellValue('BQ'.$rowNum, $projet['approuveCNI']);
            $sheet->setCellValue('BR'.$rowNum, $projet['dateApprouveCNI']);
            $sheet->setCellValue('BS'.$rowNum, $projet['convention']);
            $sheet->setCellValue('BT'.$rowNum, $projet['dateSignatureConv']);
            $sheet->setCellValue('BU'.$rowNum, $projet['capexConvention']);
            $sheet->setCellValue('BV'.$rowNum, $projet['nbEmploisDirectsCnv']);
            $sheet->setCellValue('BW'.$rowNum, $projet['nbEmploisIndirectsCnv']);
            $sheet->setCellValue('BX'.$rowNum, $projet['primesPrevues']);
            $sheet->setCellValue('BY'.$rowNum, $projet['primesOctroyees']);
            $sheet->setCellValue('BZ'.$rowNum, $projetRealise);
            $sheet->setCellValue('CA'.$rowNum, $projet['dateRealisation']);
            $sheet->setCellValue('CB'.$rowNum, $projet['dateFermeturePrj']);
            
            $num++;
        }
		
        if( (32 === $this->getUser()->getGroupe()->getId()) or (46 === $this->getUser()->getGroupe()->getId())
            or (48 === $this->getUser()->getGroupe()->getId()) )
        {
            foreach ( [ 'CB','CA','BZ','BY','BX','BC','BB','BA','AZ','AY','AX','AW','AU','AT','AS','AR','AQ','AP','AO','AN',
                'AM','AK','AC','AB','AA','Z','Y','X','W','T','P','H','B'] as $col )
            {
                $sheet->removeColumn($col,1);
            }
        }
        
        // Create your Office 2007 Excel (XLSX Format)
        $writer = new Xlsx($spreadsheet);
        
        // Create a Temporary file in the system
        $fileName = 'ProjetsInfos-'.time().'.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        
        // Create the excel file in the tmp directory of the system
        $writer->save($temp_file);
        
        // Return the excel file as an attachment
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);

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
        $sheet->setCellValue('I'.$num, 'Date');

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
            $sheet->setCellValue('I'.$rowNum, $row['date']);


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
     * @Route("/generate/pdf/{id}", name="projets_pdf", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function generatePdf(Pdf $pdf,Projets $projet,Request $request, FileUploader $fileUploader,EntityManagerInterface $em): Response
    {
        $path = $this->getParameter('forms_directory') . '/forms-projet.yml';
        $generateForm=new GenerateForm($projet->getTypeProjet()->getId(),$path,$em);
        $form_fields=$generateForm->getFields([1,4]);
        $this->setDataForm($form_fields,ProjetsData::class,$projet);
        $form = $this->createForm(ProjetDataType::class, $projet, array("schema_form" => $form_fields));
        $contacts=$this->getDoctrine()->getRepository(CarteVisite::class)->getCarteVistesByCompte($projet->getCompte()->getId());
        $url="projets/pdf/pdf.html.twig";
        $html=$this->renderView($url, [
            'projet' => $projet,
            'logs_projet' => $this->getDoctrine()->getRepository(LogProjet::class)->listLogsByProjet($projet->getId()),
            'list_status'=>$this->getDoctrine()->getRepository(EtatProjet::class)->findAll(),
            'listComptes' => $this->getDoctrine()->getRepository(Compte::class)->findAll(),
            'Localisation' => $this->getDoctrine()->getRepository(Region::class)->findAll(),
             'Ville' => $this->getDoctrine()->getRepository(Ville::class)->findAll(),
             'Pays' => $this->getDoctrine()->getRepository(Pays::class)->findAll(),
             'Secteur' => $this->getDoctrine()->getRepository(Secteur::class)->findAll(),
            'data' =>   array("compte" => $projet->getCompte(), "contact" => $contacts),
            'form' => $form->createView(),
        ]);

        return new PdfResponse(
             $pdf->setOption('footer-center' , '[page]')->getOutputFromHtml($html),
              'Projet_Details.pdf'

   );
//          return $this->render($url, [
//             'projet' => $projet,
//             'logs_projet' => $this->getDoctrine()->getRepository(LogProjet::class)->listLogsByProjet($projet->getId()),
//             'list_status'=>$this->getDoctrine()->getRepository(EtatProjet::class)->findAll(),
//             'data' =>   array("compte" => $projet->getCompte(), "contact" => $contacts),
//             'Localisation' => $this->getDoctrine()->getRepository(Region::class)->findAll(),
//             'Ville' => $this->getDoctrine()->getRepository(Ville::class)->findAll(),
//             'Pays' => $this->getDoctrine()->getRepository(Pays::class)->findAll(),
//             'form' => $form->createView(),
//         ]);
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
                } else if ($type == "NumberType") { 
                    if($options_data ==""){
                        $field["options"]["data"] = 0;
                    }else{
                        $field["options"]["data"] = $options_data;

                    }
                }else {
                    $field["options"]["data"] = $options_data;
                }
            }
    }
    // Journal Decision
    private function formSaveData($form_fields,$form,$table,$objet,FileUploader $fileUploader){
        $entityManager=$this->getDoctrine()->getManager();
        foreach ($form_fields as $field) {
            $options = $field["options"];
            $name=$field["name"];
            $type=$field["type"];
            $label=$options["label"];
            // dump($name);
            // dump($type);
            // dump($form[$name]->getData());
            
            $getdataObject = $this->getDoctrine()->getRepository($table)->findOneBy(['projet' => $objet->getId(), 'cle' => $name]);
            if($getdataObject){
                if($type == "EntityType"){
                    if($form[$name]->getData()){
                    $getdataObject->setValue($form[$name]->getData()->getId());
                    $entityManager->persist($getdataObject);
                    $entityManager->flush();
                    }
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
                }elseif ($type =="CheckboxType"){

                    $getdataObject->setCle($name);
                    $getdataObject->setValue($form[$name]->getData());
                    $getdataObject->setProjet($objet);
                    $entityManager->persist($getdataObject);
                    $entityManager->flush();
                }else{
                        if ($form[$name]->getData() == null) {
                            if ($type =="NumberType"){
                                $getdataObject->setValue("0");
                            } else {
                                $getdataObject->setValue("");
                            }
                        } else {
                            $getdataObject->setValue($form[$name]->getData());
                        }
                        $entityManager->persist($getdataObject);
                        $entityManager->flush();
                }
            }else{
                if($type == "EntityType"){
                  if($form[$name]->getData()){
                    $newObjectData = new ProjetsData();
                    $newObjectData->setCle($name);
                    $newObjectData->setValue($form[$name]->getData()->getId());
                    $newObjectData->setProjet($objet);
                    $entityManager->persist($newObjectData);
                    $entityManager->flush();
                  }

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
                elseif ($type =="CheckboxType"){
                    $abouti = "";
                    $newObjectData = new ProjetsData();
                    $newObjectData->setCle($name);
                    $newObjectData->setValue($form[$name]->getData());
                    $newObjectData->setProjet($objet);
                    $entityManager->persist($newObjectData);
                    $entityManager->flush();
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
    private function formSaveTiny($form_fields,$form,$table,$objet,FileUploader $fileUploader){
        $entityManager=$this->getDoctrine()->getManager();
        $journal=[];
        foreach ($form_fields as $field) {
            $options = $field["options"];
            $name=$field["name"];
            $type=$field["type"];
            $label=$options["label"];
            // dump($name);
            // dump($label);
            // dump($type);
            // dump($form[$name]->getData());
            
            $getdataObject = $this->getDoctrine()->getRepository($table)->findOneBy(['projet' => $objet->getId(), 'cle' => $name]);
            if($getdataObject){
                if($type == "EntityType"){
                    if($form[$name]->getData()){
                    $getdataObject->setValue($form[$name]->getData()->getId());
                    $entityManager->persist($getdataObject);
                    $entityManager->flush();
                    }
                }elseif($type =="DateType"){
                    $getdataObject->setCle($name);
                    $getdataObject->setValue($form[$name]->getViewData());
                    $getdataObject->setProjet($objet);
                    $entityManager->persist($getdataObject);
                    $entityManager->flush();
                    if($form[$name]->getData() != null){
                        $data = $label ." : ".$form[$name]->getViewData();                     
                        array_push($journal,$data);
                    }

                }elseif($type =="ChoiceType"){
                    if($form[$name]->getData() != null){

                        $getdataObject->setCle($name);
                        $getdataObject->setValue($form[$name]->getData());
                        $getdataObject->setProjet($objet);
                        $entityManager->persist($getdataObject);
                        $entityManager->flush();
                        if($form[$name]->getData() != null){
                            $data = $label ." : ".$form[$name]->getViewData();                     
                            array_push($journal,$data);
                        }
                    }
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
                }elseif ($type =="TextareaType"){
                    if($form[$name]->getData() != null){
                        $getdataObject->setCle($name);
                        $getdataObject->setValue($form[$name]->getData());
                        $getdataObject->setProjet($objet);
                        $entityManager->persist($getdataObject);
                        $entityManager->flush();
                        if($form[$name]->getData() != null){
                            $data = $label ." : ".$form[$name]->getViewData();                     
                            array_push($journal,$data);
                        }
                    }
                }elseif ($type =="CheckboxType"){

                    $getdataObject->setCle($name);
                    $getdataObject->setValue($form[$name]->getData());
                    $getdataObject->setProjet($objet);
                    $entityManager->persist($getdataObject);
                    $entityManager->flush();

                   if($form[$name]->getData() == true){                       
                       $data = $label;                        
                       array_push($journal,$data);
                   }
                }else{
                    if($form[$name]->getData() != null){
                        if($type !="FileType"){
                            $data = $label ." : ".$form[$name]->getViewData();                     
                            array_push($journal,$data);   
                        }
                    }
                    
                        // if ($form[$name]->getData() == null) {
                        //     $getdataObject->setValue("");
                        // } else {
                        //     $getdataObject->setValue($form[$name]->getData());
                        // }
                        // $entityManager->persist($getdataObject);
                        // $entityManager->flush();
                }
            }else{
                if($type == "EntityType"){
                  if($form[$name]->getData()){
                    $newObjectData = new ProjetsData();
                    $newObjectData->setCle($name);
                    $newObjectData->setValue($form[$name]->getData()->getId());
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
                    if($form[$name]->getData() != null){
                       $data = $label ." : ".$form[$name]->getViewData(); 
                       dd($data);                    
                       array_push($journal,$data);
                   }
                }elseif($type =="ChoiceType"){
                    if($form[$name]->getData() != null){
                        $newObjectData = new ProjetsData();
                        $newObjectData->setCle($name);
                        $newObjectData->setValue($form[$name]->getData());
                        $newObjectData->setProjet($objet);
                        $entityManager->persist($newObjectData);
                        $entityManager->flush();
                        if($form[$name]->getData() != null){
                            $data = $label ." : ".$form[$name]->getViewData();                     
                            array_push($journal,$data);
                        }
                    }
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
                }elseif ($type =="CheckboxType"){
                    $newObjectData = new ProjetsData();
                    $newObjectData->setCle($name);
                    $newObjectData->setValue($form[$name]->getData());
                    $newObjectData->setProjet($objet);
                    $entityManager->persist($newObjectData);
                    $entityManager->flush();
                    if($form[$name]->getData() == true){                       
                        $data = $label;                        
                        array_push($journal,$data);
                    }
                }elseif ($type =="TextareaType"){
                    if($form[$name]->getData() != null){                        
                        $newObjectData = new ProjetsData();
                        $newObjectData->setCle($name);
                        $newObjectData->setValue($form[$name]->getData());
                        $newObjectData->setProjet($objet);
                        $entityManager->persist($newObjectData);
                        $entityManager->flush();
                        if($form[$name]->getData() != null){
                            $data = $label ." : ".$form[$name]->getData();                     
                            array_push($journal,$data);
                        }
                    }
                }
                else{
                    if ($form[$name]->getData() != null) {
                        $newObjectData = new ProjetsData();
                        $newObjectData->setCle($name);
                        $newObjectData->setValue($form[$name]->getData());
                        $newObjectData->setProjet($objet);
                        $entityManager->persist($newObjectData);
                        $entityManager->flush();
                        if($form[$name]->getData() != null){
                            $data = $label ." : ".$form[$name]->getViewData();                     
                            array_push($journal,$data);
                        }
                    }
                }
            }
            
        }
        // die();
        $dernierjournal = $this->getDoctrine()->getRepository(TinyJournal::class)->listJTByProjetRecent($objet->getId());
        $tyny = array_unique($journal);
        $comma_separated = implode("\n", $tyny);
        if(($comma_separated != "") 
            && ((!$dernierjournal) || ($dernierjournal->getCommentaire() != $comma_separated))) {
            
            $newJT = new TinyJournal();
            $newJT->setStatus("journal");
            $newJT->setProjet($objet);
            $newJT->setCommentaire($comma_separated);
            $newJT->setCreePar($this->getUser());
            $newJT->setDateCreation(new \DateTimeImmutable());
            
            /* Traitement pour attacher le fichier document MOU dans pipeline */
            foreach ($form_fields as $field) {
                $name=$field["name"];

                if(($name == "document_signature_mou") && (!is_null($form["signature_mou"]))) {
                    /* Le checkbox est activé et le champ file non vide */
                    if(!is_null($form[$name]->getData()) && ($form["signature_mou"]->getData() == true)) {
                        
                        /* Déjà fichier enregistré et nom calculé et enregistré dans ProjetsData */
                        $docMouName = $this->getDoctrine()->getRepository(Projets::class)
                                ->getValueField($objet->getId(),'document_signature_mou');
                        
                        /* Est ce qu'il est déjà enregisté */
                        $fichierMouExiste = false;
                        foreach($objet->getTinyJournals() as $tinyJournal) {
                            if(!is_null($tinyJournal->getDocMou()) && !is_null($docMouName)
                                && ($tinyJournal->getDocMou() == $docMouName['value'])) {
                                
                                $fichierMouExiste = true;
                                break;
                            }
                        }
                        if($fichierMouExiste == false) {
                            if(!is_null($docMouName) && !is_null($docMouName['value'])) {
                                $newJT->setDocMou($docMouName['value']);
                            }
                        }
                    }
                }
            }

            /* Traitement pour attacher le fichier document Convention dans pipeline */
            foreach ($form_fields as $field) {
                $name=$field["name"];
                
                if(($name == "document_convention") && (!is_null($form["Convention"]))) {
                    /* Le checkbox est activé et le champ file non vide */
                    if(!is_null($form[$name]->getData()) && ($form["Convention"]->getData() == true)) {
                        
                        /* Déjà fichier enregistré et nom calculé et enregistré dans ProjetsData */
                        $docCnvName = $this->getDoctrine()->getRepository(Projets::class)
                                ->getValueField($objet->getId(),'document_convention');
                        
                        /* Est ce qu'il est déjà enregisté */
                        $fichierCnvExiste = false;
                        foreach($objet->getTinyJournals() as $tinyJournal) {
                            if(!is_null($tinyJournal->getDocCnv()) && !is_null($docCnvName)
                                && ($tinyJournal->getDocCnv() == $docCnvName['value'])) {
                                    
                                    $fichierCnvExiste = true;
                                    break;
                                }
                        }
                        if($fichierCnvExiste == false) {
                            if(!is_null($docCnvName) && !is_null($docCnvName['value'])) {
                                $newJT->setDocCnv($docCnvName['value']);
                            }
                        }
                    }
                }
            }

            $entityManager->persist($newJT);
            $entityManager->flush();
        } /*else {
            if($dernierjournal->getCommentaire() != $comma_separated){
                
                $newJT = new TinyJournal();
                $newJT->setStatus("journal");
                $newJT->setProjet($objet);
                $newJT->setCommentaire($comma_separated);
                $newJT->setCreePar($this->getUser());
                $newJT->setDateCreation(new \DateTimeImmutable());
                $entityManager->persist($newJT);
                $entityManager->flush();
            }
        } */
        
        // die();

    }
    private function HistoriqueJT($objet,$value,$name,$label){
        // dump($value);
        // dd($name);
        if($value){
           
            $message = $name ."  ". $value;
            $em=$this->getDoctrine()->getManager();
            $newJT = new TinyJournal();
            $newJT->setStatus("Historique");
            $newJT->setProjet($objet);
            $newJT->setCommentaire($message);
            $newJT->setCreePar($this->getUser());
            $newJT->setDateCreation(new \DateTimeImmutable());
            $em->persist($newJT);
            $em->flush();
        }
     
    }
     /**
     * @Route("/projetlogall", name="projet_log_filtre_all", methods={"GET","POST"})
     * 
     */
    public function projetlogfiltreall(Request $request): Response
    {
        $compteid = $request->request->get('projet');
        $logs_projet = $this->getDoctrine()->getRepository("App:LogProjet")
        ->listLogsByProjet($compteid);

        return $this->render('projets/detail_projet/logfiltreprojet.html.twig',array('logs_projet' => $logs_projet));
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

        return $this->render('projets/detail_projet/logfiltreprojet.html.twig',array('logs_projet' => $logs_projet));

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

        return $this->render('projets/form_projet.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/projet/{id}", name="projets_detail", methods={"GET","POST"})
     * @Security("is_granted('CONSULTER_LE_PROJET')")
     */
    public function detail_projet(Projets $projet,Request $request, FileUploader $fileUploader,EntityManagerInterface $em,ProjetsRepository $projetsRepository): Response
    {

        $path = $this->getParameter('forms_directory') . '/forms-projet.yml';
        $generateForm=new GenerateForm($projet->getTypeProjet()->getId(),$path,$em);
        $form_fields=$generateForm->getFields([1,2,3,4]);
        $form_decision=$generateForm->getFields([4]);
        $this->setDataForm($form_fields,ProjetsData::class,$projet);
        $this->setDataForm($form_decision,ProjetsData::class,$projet);
        $form = $this->createForm(ProjetDataType::class, $projet, array("schema_form" => $form_fields));
        $contacts=$this->getDoctrine()->getRepository(CarteVisite::class)->getCarteVistesByCompte($projet->getCompte()->getId());
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $this->formSaveData($form_fields,$form,ProjetsData::class,$projet,$fileUploader);
            $this->formSaveTiny($form_decision,$form,ProjetsData::class,$projet,$fileUploader);

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
            $conf = $form["Confidentiel"]->getData();
            $projet->setConfidentiel($conf);
            $projet->setTitre($titre);
            $entityManager->flush();
            $this->addFlash('success', 'Ce projet a été modifié avec succès');
            // return $this->redirectToRoute('projets_detail',['id'=>$projet->getId()]);
         }

        $url="projets/detail_projet.html.twig";
        if ($projet->getTypeProjet()->getId() == "1") {
            $url="projets/detail_projet/projet_investissement.html.twig";
        } else if ($projet->getTypeProjet()->getId() == "2") {
            $url="projets/detail_projet/projet_sourcing.html.twig";
        } else if ($projet->getTypeProjet()->getId() == "3") {
            $url="projets/detail_projet/projet_export.html.twig";
        } else if ($projet->getTypeProjet()->getId() == "4") {
          $url="projets/detail_projet/actions.html.twig";
      }
        return $this->render($url, [
            'projet' => $projet,
            'logs_projet' => $this->getDoctrine()->getRepository(LogProjet::class)->listLogsByProjet($projet->getId()),
            'jt_projet' => $this->getDoctrine()->getRepository(TinyJournal::class)->listJTByProjet($projet->getId()),
            'list_status'=>$this->getDoctrine()->getRepository(EtatProjet::class)->getEtatProjets(),
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
            $afficher = $this->generateUrl('projets_show', [
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

            return $this->redirectToRoute('projets_index');
        }

        return $this->render('projets/new.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="projets_new", methods={"GET","POST"})
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
            $conf = $form["Confidentiel"]->getData();

            $projet->setConfidentiel($conf);
            $projet->setTitre($titre);
            $projet->setDateCreation(new \DateTimeImmutable());
            $projet->setIsDeleted(false);
            $entityManager->persist($projet);
            $entityManager->flush();
            $this->addFlash('success', 'Le nouveau projet a été créé avec succès');
            $pwh->handle($projet, $projet->getEtatProjet()->getNom());
            return $this->redirectToRoute('projets_index');
        }


        return $this->render('projets/new.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
        ]);
    } 

    /**
     * @Route("/change_statuts/{status}/{projet}", name="projet_change_status", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function switchWorkflow(EtatProjet $status,Projets $projet,ProjetWorkflowHandler $pwh,ProjetToCompteWorkflowHandler $aqw)
    {
         
        try {
            $transition=$status->getNom();
            $projet->setEtatProjet($status);
            $pwh->handle($projet, $transition);
            $aqw->hello($projet->getCompte());

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

        if($isgpac == 0){
            // $message=$this->getUser()->getPrenom()." ".$this->getUser()->getNom()." a désactivé le Gpac pour ce projet";
            $message="";
        }else{
            $message=$this->getUser()->getPrenom()." ".$this->getUser()->getNom()." a adressé une demande GPAC";
        }
        $log = new LogProjet();
        $log->setCommentaire($message); 
        $log->setProjet($projet);
        $log->setStatus("Gpac");
        $log->setCreePar($this->getUser());
        $log->setDateCreation(new \DateTimeImmutable());
        $em->persist($log);
        $em->flush();
        $this->addFlash('success', 'Vos modifications ont été enregistrées avec succès');

        return $this->redirectToRoute('projets_detail',['id'=>$projet->getId()]);
    }

    /**
     * @Route("/remplirprovfromregion/", name="remplir_province_from_region", methods={"GET","POST"})
     *
     */
    public function remplirProvinceFromRegion(Request $request): Response
    {
        $idRegion = $request->request->get('id_region');
        
        
        if(!is_null($idRegion)){
            
            $provinces = $this->getDoctrine()->getRepository(Province::class)->findBy(['isDeleted' => false, 
                                                                                        'region' => $idRegion]);
            $tabProvinces = array();
            $i = 0;
            foreach($provinces as $province) {
                $tabProvinces[$i]['idProvince'] = $province->getId();
                $tabProvinces[$i]['nomProvince'] = $province->getNom();
                $i++;
            }
            
            return new JsonResponse($tabProvinces, 200);
        }
        
        return new JsonResponse([]);
    }

    /**
     * @Route("/{id}", name="projets_show", methods={"GET","POST"})
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
            return $this->render('projets/details.html.twig', [
                'projet' => $projet,
                'form' => $form->createView()
            ]);
        }

        return $this->render('projets/show.html.twig', [
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
     * @Route("/{id}", name="projets_delete", methods={"DELETE"})
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

        return $this->redirectToRoute('projets_index');
    }


    /**
     * @Route("/logmanzana/", name="log_manzana", methods={"GET","POST"})
     *
     */
    public function log_manzana(Request $request): Response 
    {
        $em = $this->getDoctrine()->getManager();
        $date = $request->request->get('date');
        $action = $request->request->get('action');
        $event_id = $request->request->get('event');
        $detail = $request->request->get('detail');
        $projet_id = $request->request->get('pid');
        $loisigne = $request->request->get('loisigne');
        $loisignedoc = $request->files->get('loisignedoc');
        $tier = $request->request->get('tier');
        
        if(!is_null($loisignedoc)){
            $loiSigneFileName = md5(uniqid()) . '.' . $loisignedoc->guessExtension();
            $loisignedoc->move($this->getParameter('uploader_directory'), $loiSigneFileName);
        } else {
            $loiSigneFileName = null;
        }
        
        $event="";
        $projet=$this->getDoctrine()->getRepository(Projets::class)->findOneBy(['id'=>$projet_id]);
        if($action == "Event"){
            $eventObj=$this->getDoctrine()->getRepository(Event::class)->findOneBy(['id'=>$event_id]);
            $event=$eventObj->getNom();
        }
        
        /*$commentaire =
            "Date : ".$date." \n ".
            "Action : ".$action." ".$event." \n ".
            "Détails Libres : ".$detail;*/
        
        $commentaire = "";
        if(!empty($date)) {
            $commentaire = $commentaire." \n ".
                "Date : ".$date;
        }
        if(!empty($action)) {
            $commentaire = $commentaire." \n ".
                "Action : ".$action;
        }
        if(!empty($detail)) {
            $commentaire = $commentaire." \n ".
                "Détails Libres : ".$detail;
        }
        
        if($loisigne == 'Oui') {
            $commentaire = $commentaire." \n ".
                "Loi Signe : ".$loisigne;
        }
        if(!empty($tier)) {
            $commentaire = $commentaire." \n ".
                "Tier : ".$tier;
        }
        
        if(mb_substr($commentaire, 0, 3, 'utf8') === " \n ") {
            $commentaire = mb_substr($commentaire, 3, null, 'utf8');
        }
        
        $log = new LogProjet();
        $log->setCommentaire($commentaire); 
        $log->setProjet($projet);
        $log->setStatus("Action");
        $log->setCreePar($this->getUser());
        $log->setDateCreation(new \DateTimeImmutable($date));
        if(!is_null($loiSigneFileName)) {
            $log->setDocument($loiSigneFileName);
        }
        
        $em->persist($log);
        $em->flush();

        return new JsonResponse(["projet_id" => $projet_id]);
    }

    /**
     * @Route("/logmanzanaexport/", name="log_manzanaexport", methods={"GET","POST"})
     *
     */
    public function log_manzanaexport(Request $request): Response 
    {
        $em = $this->getDoctrine()->getManager();
        $date = $request->request->get('date');
        $action = $request->request->get('action');
        $objet = $request->request->get('objet');

        // $event_id = $request->request->get('event');
        $detail = $request->request->get('detail');
        $projet_id = $request->request->get('pid');
        $cmdprevexpo = $request->request->get('cmdprevexpo');
        

        $event="";
        $projet=$this->getDoctrine()->getRepository(Projets::class)->findOneBy(['id'=>$projet_id]);
        // if($action == "Event"){
        //     $eventObj=$this->getDoctrine()->getRepository(Event::class)->findOneBy(['id'=>$event_id]);
        //     $event=$eventObj->getNom();
        // }
        
        /*$commentaire=
            "Date : ".$date." \n ".
            "Action : ".$action." \n ".
            "Objet : ".$objet." \n ".
            "Détails Libres : ".$detail;*/
        
        $commentaire = "";
        if(!empty($date)) {
            $commentaire = $commentaire." \n ".
                "Date : ".$date;
        }
        if(!empty($action)) {
            $commentaire = $commentaire." \n ".
                "Action : ".$action;
        }
        if(!empty($objet)) {
            $commentaire = $commentaire." \n ".
                "Objet : ".$objet;
        }
        if(!empty($detail)) {
            $commentaire = $commentaire." \n ".
                "Détails Libres : ".$detail;
        }

        if(!empty($cmdprevexpo)) {
            $cmdprevexpo = str_replace(",",".",$cmdprevexpo);
            
            $commentaire = $commentaire." \n ".
                "Val Cmd Prév : ".$cmdprevexpo;
        }
        
        if(mb_substr($commentaire, 0, 3, 'utf8') === " \n ") {
            $commentaire = mb_substr($commentaire, 3, null, 'utf8');
        }
        
        if(is_numeric($cmdprevexpo)) {
            $log = new LogProjet();
            $log->setCommentaire($commentaire); 
            $log->setProjet($projet);
            $log->setStatus("Action");
            $log->setCreePar($this->getUser());
            $log->setDateCreation(new \DateTimeImmutable($date));
            $em->persist($log);
            $em->flush();
            
            return new JsonResponse(["projet_id" => $projet_id],200);
        } else {
            
            return new JsonResponse(["projet_id" => $projet_id], 400);
        }

        
    }

    /**
     * @Route("/logmanzanasourcing/", name="log_manzanasourcing", methods={"GET","POST"})
     *
     */
    public function log_manzanasour(Request $request): Response 
    {
        $em = $this->getDoctrine()->getManager();
        $date = $request->request->get('date');
        $action = $request->request->get('action');
        $objet = $request->request->get('objet');

        // $event_id = $request->request->get('event');
        $detail = $request->request->get('detail');
        $projet_id = $request->request->get('pid');
        $cmdprevsou = $request->request->get('cmdprevsou');
        $loirecue = $request->request->get('loirecue');
        $loirecuedoc = $request->files->get('loirecuedoc');

        if(!is_null($loirecuedoc)){
            $loiRecueFileName = md5(uniqid()) . '.' . $loirecuedoc->guessExtension();
            $loirecuedoc->move($this->getParameter('uploader_directory'), $loiRecueFileName);
        } else {
            $loiRecueFileName = null;
        }

        $event="";
        $projet=$this->getDoctrine()->getRepository(Projets::class)->findOneBy(['id'=>$projet_id]);
        // if($action == "Event"){
        //     $eventObj=$this->getDoctrine()->getRepository(Event::class)->findOneBy(['id'=>$event_id]);
        //     $event=$eventObj->getNom();
        // }
        
        /*$commentaire=
            "Date : ".$date." \n ".
            "Action : ".$action." \n ".
            "Objet : ".$objet." \n ".
            "Détails Libres : ".$detail;*/
        
        $commentaire = "";
        if(!empty($date)) {
            $commentaire = $commentaire." \n ".
                "Date : ".$date;
        }
        if(!empty($action)) {
            $commentaire = $commentaire." \n ".
                "Action : ".$action;
        }
        if(!empty($objet)) {
            $commentaire = $commentaire." \n ".
                "Objet : ".$objet;
        }
        if(!empty($detail)) {
            $commentaire = $commentaire." \n ".
                "Détails Libres : ".$detail;
        }

        if($loirecue == 'Oui') {
            $commentaire = $commentaire." \n ".
                "Loi Reçue : ".$loirecue;
        }
        if(!empty($cmdprevsou)) {
            $cmdprevsou = str_replace(",",".",$cmdprevsou);
            $commentaire = $commentaire." \n ".
                "Val Cmd Prév : ".$cmdprevsou;
        }

        if(mb_substr($commentaire, 0, 3, 'utf8') === " \n ") {
            $commentaire = mb_substr($commentaire, 3, null, 'utf8');
        }

        if(is_numeric($cmdprevsou)) {
            $log = new LogProjet();
            $log->setCommentaire($commentaire); 
            $log->setProjet($projet);
            $log->setStatus("Action");
            $log->setCreePar($this->getUser());
            $log->setDateCreation(new \DateTimeImmutable($date));
            if(!is_null($loiRecueFileName)) {
                $log->setDocument($loiRecueFileName);
            }
        
            $em->persist($log);
            $em->flush();

            return new JsonResponse(["projet_id" => $projet_id], 200);
            
        } else {
            
            return new JsonResponse(["projet_id" => $projet_id], 400);
        }
    }

    /**
     * @Route("/gpacsourcing/", name="gpac_sourcing", methods={"GET","POST"})
     *
     */
    public function gpac_sourcing(Request $request): Response 
    {

        $em = $this->getDoctrine()->getManager();
        $statut_projet = $request->request->get('statut_projet');
        $requetes_compte = $request->request->get('requetes_compte');
        $type_requete = $request->request->get('type_requete');
        $exportateur = $request->request->get('exportateur');
        $montant_projet = $request->request->get('montant_projet');
        $informations_supplementaires = $request->request->get('informations');
        $projet_id = $request->request->get('pid');
        $projet=$this->getDoctrine()->getRepository(Projets::class)->findOneBy(['id'=>$projet_id]);

        $data=array();
       
        $data = array_merge($data, array("statut_projet"=>$statut_projet,"requetes_compte"=>$requetes_compte,"type_requete"=>$type_requete,"exportateur"=>$exportateur,"montant_projet"=>$montant_projet,"informations_supplementaires"=>$informations_supplementaires));
        
 
        foreach($data as $x => $val) {
            $ProjetData = new ProjetsData();
            $ProjetData->setCle($x);
            $ProjetData->setValue($val);
            $ProjetData->setProjet($projet);
            $em->persist($ProjetData);
            $em->flush();
        }
        $groupe = $this->getDoctrine()->getRepository(Groupe::class)->findOneBy(['nom'=> 'Directeur GPAC']);
        $responsable = $this->getDoctrine()->getRepository(User::class)->findOneBy(['groupe'=> $groupe->getId()]);
        

        $commentaire= $this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet (".$projet->getTitre().") à GPAC";
        $log = new LogProjet();
        $log->setCommentaire($commentaire); 
        $log->setProjet($projet);
        $log->setStatus("GPAC");
        $log->setCreePar($this->getUser());
        $log->setDateCreation(new \DateTimeImmutable());
        $em->persist($log);
        $em->flush();
        $projet->setActionGPAC(1);
        $em=$this->getDoctrine()->getManager();
        $em->persist($projet);
        $em->flush();
        
        $message= "Bonjour, " .$this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet (".$projet->getTitre().") à GPAC,  Cordialement";
        $this->mailer->sendMail($responsable->getEmail(),$message,"le projet : ".$projet->getTitre()." (Changement Status)");
        
    
       
        return new JsonResponse(["projet_id" => $projet_id]);
    }
    /**
     * @Route("/gpacexport/", name="gpac_export", methods={"GET","POST"})
     *
     */
    public function gpac_export(Request $request): Response 
    {
        $em = $this->getDoctrine()->getManager();
        $statut_projet = $request->request->get('statut_projet');
        $requetes_compte = $request->request->get('requetes_compte');
        $type_requete = $request->request->get('type_requete');
        $donneur_ordre = $request->request->get('donneur_ordre');
        $montant_projet = $request->request->get('montant_projet');
        $informations_supplementaires = $request->request->get('informations');
        $programme_appui = $request->request->get('programme_appui');
        $projet_id = $request->request->get('pid');
        $projet=$this->getDoctrine()->getRepository(Projets::class)->findOneBy(['id'=>$projet_id]);

        $data=array();
       
        $data = array_merge($data, array("statut_projet"=>$statut_projet,"requetes_compte"=>$requetes_compte,"type_requete"=>$type_requete,"donneur_ordre"=>$donneur_ordre,"montant_projet"=>$montant_projet,"informations_supplementaires"=>$informations_supplementaires,"programme_appui"=>$programme_appui));
        
        foreach($data as $x => $val) {
            $ProjetData = new ProjetsData();
            $ProjetData->setCle($x);
            $ProjetData->setValue($val);
            $ProjetData->setProjet($projet);
            $em->persist($ProjetData);
            $em->flush();
        }
        $groupe = $this->getDoctrine()->getRepository(Groupe::class)->findOneBy(['nom'=> 'Directeur GPAC']);
        $responsable = $this->getDoctrine()->getRepository(User::class)->findOneBy(['groupe'=> $groupe->getId()]);
        $commentaire= $this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet (".$projet->getTitre().") à GPAC";
        $log = new LogProjet();
        $log->setCommentaire($commentaire); 
        $log->setProjet($projet);
        $log->setStatus("GPAC");
        $log->setCreePar($this->getUser());
        $log->setDateCreation(new \DateTimeImmutable());
        $em->persist($log);
        $em->flush();
        $projet->setActionGPAC(1);
        $em=$this->getDoctrine()->getManager();
        $em->persist($projet);
        $em->flush();
       
        
        $message= "Bonjour, " .$this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet (".$projet->getTitre().") à GPAC,  Cordialement";
        $this->mailer->sendMail($responsable->getEmail(),$message,"le projet : ".$projet->getTitre()." (Changement Status)");
    
       
        return new JsonResponse(["projet_id" => $projet_id]);
    }

    /**
     * @Route("/gpacinvestisseure/", name="gpac_investisseure", methods={"GET","POST"})
     *
     */
    public function gpac_investisseure(Request $request): Response 
    {
        $em = $this->getDoctrine()->getManager();
        $statut_projet = $request->request->get('statut_projet');
        $requetes_compte = $request->request->get('requetes_compte');
        $incitations_sollicitees = $request->request->get('incitations_sollicitees');
        $programme_investissement = $request->request->get('programme_investissement');
        $mode_financement = $request->request->get('mode_financement');
        $informations_supplementaires = $request->request->get('informations_supplementaires');
        $projet_id = $request->request->get('pid');
        $projet=$this->getDoctrine()->getRepository(Projets::class)->findOneBy(['id'=>$projet_id]);

        $data=array();
       
        $data = array_merge($data, array("statut_projet"=>$statut_projet,"requetes_compte"=>$requetes_compte,"incitations_sollicitees"=>$incitations_sollicitees,"programme_investissement"=>$programme_investissement,"mode_financement"=>$mode_financement,"informations_supplementaires"=>$informations_supplementaires));
        
        foreach($data as $x => $val) {
            $ProjetData = new ProjetsData();
            $ProjetData->setCle($x);
            $ProjetData->setValue($val);
            $ProjetData->setProjet($projet);
            $em->persist($ProjetData);
            $em->flush();
        }
        $groupe = $this->getDoctrine()->getRepository(Groupe::class)->findOneBy(['nom'=> 'Directeur GPAC']);
        $responsable = $this->getDoctrine()->getRepository(User::class)->findOneBy(['groupe'=> $groupe->getId()]);
        $commentaire= $this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet (".$projet->getTitre().") à GPAC";
        $log = new LogProjet();
        $log->setCommentaire($commentaire); 
        $log->setProjet($projet);
        $log->setStatus("GPAC");
        $log->setCreePar($this->getUser());
        $log->setDateCreation(new \DateTimeImmutable());
        $em->persist($log);
        $em->flush();
        $projet->setActionGPAC(1);
        $em=$this->getDoctrine()->getManager();
        $em->persist($projet);
        $em->flush();
        
        
        $message= "Bonjour, " .$this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet (".$projet->getTitre().") à GPAC,  Cordialement";
        $this->mailer->sendMail($responsable->getEmail(),$message,"le projet : ".$projet->getTitre()." (Changement Status)");   
        return new JsonResponse(["projet_id" => $projet_id]);
    }

    /**
     * @Route("/gpacsourcingaction/", name="gpac_sourcing_action", methods={"GET","POST"})
     *
     */
    public function gpac_sourcing_action(Request $request): Response 
    {
        $em = $this->getDoctrine()->getManager();
 
        $date_actions_gpac_sourcing = $request->request->get('date_actions_gpac_sourcing');
        $details_libres_actions_gpac_sourcing = $request->request->get('details_libres_actions_gpac_sourcing');
        $Type_accompagnement_actions_gpac_sourcing = $request->request->get('Type_accompagnement_actions_gpac_sourcing');
        $Solution = $request->request->get('Solution');
        $situation_projet_actions_gpac_sourcing = $request->request->get('situation_projet_actions_gpac_sourcing');
        $informations_supplementaires_actions_gpac_sourcing = $request->request->get('informations_supplementaires_actions_gpac_sourcing');
       
        $projet_id = $request->request->get('pid');
        $projet=$this->getDoctrine()->getRepository(Projets::class)->findOneBy(['id'=>$projet_id]);

        $data=array();
       
        $data = array_merge($data, array("date_actions_gpac_sourcing"=>$date_actions_gpac_sourcing,"details_libres_actions_gpac_sourcing"=>$details_libres_actions_gpac_sourcing,"Type_accompagnement_actions_gpac_sourcing"=>$Type_accompagnement_actions_gpac_sourcing,"Solution"=>$Solution,"situation_projet_actions_gpac_sourcing"=>$situation_projet_actions_gpac_sourcing,"informations_supplementaires_actions_gpac_sourcing"=>$informations_supplementaires_actions_gpac_sourcing));
         foreach($data as $x => $val) {
            $ProjetData = new ProjetsData();
            $ProjetData->setCle($x);
            $ProjetData->setValue($val);
            $ProjetData->setProjet($projet);
            $em->persist($ProjetData);
            $em->flush();
        }
        $groupe = $this->getDoctrine()->getRepository(Groupe::class)->findOneBy(['nom'=> 'Responsable GPAC']);
        $responsable = $this->getDoctrine()->getRepository(User::class)->findOneBy(['groupe'=> $groupe->getId()]);
        // $commentaire= $this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet (".$projet->getTitre().") à GPAC";
          $commentaire= "L'entité GPAC a donné suite à votre requête";

        $log = new LogProjet();
        $log->setCommentaire($commentaire); 
        $log->setProjet($projet);
        $log->setStatus("Action GPAC");
        $log->setCreePar($this->getUser());
        $log->setDateCreation(new \DateTimeImmutable());
        $em->persist($log);
        $em->flush();
        $projet->setActionGPAC(1);
        $em=$this->getDoctrine()->getManager();
        $em->persist($projet);
        $em->flush();
        
        // $message= "Bonjour, " .$this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet (".$projet->getTitre().") à Action GPAC,  Cordialement";
           $message= "Bonjour, L'entité GPAC a donné suite à votre requête,  Cordialement";

        $this->mailer->sendMail($responsable->getEmail(),$message,"le projet : ".$projet->getTitre()." (Changement Status)");   
        return new JsonResponse(["projet_id" => $projet_id]);
    }
    /**
     * @Route("/gpacinvestisseureaction/", name="gpac_investisseure_action", methods={"GET","POST"})
     *
     */
    public function gpac_investisseure_action(Request $request): Response 
    {
        $em = $this->getDoctrine()->getManager();
        $date_actions_gpac = $request->request->get('date_actions_gpac');
        $details_libres_actions_gpac = $request->request->get('details_libres_actions_gpac');
        $Type_accompagnement_actions_gpac = $request->request->get('Type_accompagnement_actions_gpac');
        $incitations = $request->request->get('incitations');
        $informations_supplementaires_actions_gpac = $request->request->get('informations_supplementaires_actions_gpac');
        $situation_projet_actions_gpac = $request->request->get('situation_projet_actions_gpac');

        $projet_id = $request->request->get('pid');
        $projet=$this->getDoctrine()->getRepository(Projets::class)->findOneBy(['id'=>$projet_id]);

        $data=array();
       
        $data = array_merge($data, array("date_actions_gpac"=>$date_actions_gpac,"details_libres_actions_gpac"=>$details_libres_actions_gpac,"Type_accompagnement_actions_gpac"=>$Type_accompagnement_actions_gpac,"incitations"=>$incitations,"informations_supplementaires_actions_gpac"=>$informations_supplementaires_actions_gpac,"situation_projet_actions_gpac"=>$situation_projet_actions_gpac));
        
        foreach($data as $x => $val) {
            $ProjetData = new ProjetsData();
            $ProjetData->setCle($x);
            $ProjetData->setValue($val);
            $ProjetData->setProjet($projet);
            $em->persist($ProjetData);
            $em->flush();
        }
        $groupe = $this->getDoctrine()->getRepository(Groupe::class)->findOneBy(['nom'=> 'Responsable GPAC']);
        $responsable = $this->getDoctrine()->getRepository(User::class)->findOneBy(['groupe'=> $groupe->getId()]);
        // $commentaire= $this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet (".$projet->getTitre().") à GPAC";
        $commentaire= "L'entité GPAC a donné suite à votre requête";

        $log = new LogProjet();
        $log->setCommentaire($commentaire); 
        $log->setProjet($projet);
        $log->setStatus("Action GPAC");
        $log->setCreePar($this->getUser());
        $log->setDateCreation(new \DateTimeImmutable());
        $em->persist($log);
        $em->flush();
        $projet->setActionGPAC(1);
        $em=$this->getDoctrine()->getManager();
        $em->persist($projet);
        $em->flush();
                
        // $message= "Bonjour, " .$this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet (".$projet->getTitre().") à Action GPAC,  Cordialement";
        $message= "Bonjour, L'entité GPAC a donné suite à votre requête,  Cordialement";

        $this->mailer->sendMail($responsable->getEmail(),$message,"le projet : ".$projet->getTitre()." (Changement Status)");   
        return new JsonResponse(["projet_id" => $projet_id]);
    }
     /**
     * @Route("/gpacexportaction/", name="gpac_export_action", methods={"GET","POST"})
     *
     */
    public function gpac_export_action(Request $request): Response 
    { 
        $em = $this->getDoctrine()->getManager();

 
        $date_actions_gpac_export = $request->request->get('date_actions_gpac_export');
        $details_libres_actions_gpac_export = $request->request->get('details_libres_actions_gpac_export');
        $Type_accompagnement_actions_gpac_export = $request->request->get('Type_accompagnement_actions_gpac_export');
        $Appui_Obtenu = $request->request->get('Appui_Obtenu');
        $situation_projet_actions_gpac_export = $request->request->get('situation_projet_actions_gpac_export');
        $informations_supplementaires_actions_gpac_export = $request->request->get('informations_supplementaires_actions_gpac_export');
       
        $projet_id = $request->request->get('pid');
        $projet=$this->getDoctrine()->getRepository(Projets::class)->findOneBy(['id'=>$projet_id]);

        $data=array();
       
        $data = array_merge($data, array("date_actions_gpac_export"=>$date_actions_gpac_export,"details_libres_actions_gpac_export"=>$details_libres_actions_gpac_export,"Type_accompagnement_actions_gpac_export"=>$Type_accompagnement_actions_gpac_export,"Appui_Obtenu"=>$Appui_Obtenu,"situation_projet_actions_gpac_export"=>$situation_projet_actions_gpac_export,"informations_supplementaires_actions_gpac_export"=>$informations_supplementaires_actions_gpac_export));
        
        foreach($data as $x => $val) {
            $ProjetData = new ProjetsData();
            $ProjetData->setCle($x);
            $ProjetData->setValue($val);
            $ProjetData->setProjet($projet);
            $em->persist($ProjetData);
            $em->flush();
        }
        $groupe = $this->getDoctrine()->getRepository(Groupe::class)->findOneBy(['nom'=> 'Responsable GPAC']);
        $responsable = $this->getDoctrine()->getRepository(User::class)->findOneBy(['groupe'=> $groupe->getId()]);
        // $commentaire= $this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet (".$projet->getTitre().") à Action GPAC";
        $commentaire= "L'entité GPAC a donné suite à votre requête";
        $log = new LogProjet();
        $log->setCommentaire($commentaire); 
        $log->setProjet($projet);
        $log->setStatus("Action GPAC");
        $log->setCreePar($this->getUser());
        $log->setDateCreation(new \DateTimeImmutable());
        $em->persist($log);
        $em->flush();
        $projet->setActionGPAC(1);
        $em=$this->getDoctrine()->getManager();
        $em->persist($projet);
        $em->flush();
        
        // $message= "Bonjour, " .$this->user->getUser()->getPrenom()." ".$this->user->getUser()->getNom()." a changé le statut un projet (".$projet->getTitre().") à GPAC,  Cordialement";
           $message= "Bonjour, L'entité GPAC a donné suite à votre requête,  Cordialement";

        $this->mailer->sendMail($responsable->getEmail(),$message,"le projet : ".$projet->getTitre()." (Changement Status)");   
        return new JsonResponse(["projet_id" => $projet_id]);
    }


    /**
     * @Route("/newfromcompte/{id}/{compte}", name="projets_new_from_compte", methods={"GET","POST"})
     * @Security("is_granted('CREATION_DE_PROJET')")
     */
    public function NewFromCompte($id, Request $request,Compte $compte, FileUploader $fileUploader,ProjetWorkflowHandler $pwh,EntityManagerInterface $em): Response
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
            $projet->setCompte($compte);

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
            
            $conf = $form["Confidentiel"]->getData();
            $projet->setConfidentiel($conf);

            $projet->setTitre($titre);
            $projet->setDateCreation(new \DateTimeImmutable());
            $projet->setIsDeleted(false);
            $entityManager->persist($projet);
            $entityManager->flush();
            $this->addFlash('success', 'Le nouveau projet a été créé avec succès');
            $pwh->handle($projet, $projet->getEtatProjet()->getNom());
            if ($projet->getTypeProjet()->getId() == "4") {
                return $this->redirectToRoute('actions_index');
            }else{
                return $this->redirectToRoute('projets_index');
            }
        }


        return $this->render('projets/new_compte.html.twig', [
            'projet' => $projet,
            'form' => $form->createView(),
            'compte' => $compte
        ]);
    }  

     /**
     * @Route("/docprojet/{id}", name="delete_doc_projet", methods={"GET"})
     */
    public function deletecv(Request $request, ProjetsData $projetsData): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($projetsData);
        $entityManager->flush();
        return $this->redirectToRoute('projets_detail', ['id' => $projetsData->getProjet()->getId()]);
    }

    /**
     * @Route("/listecomptesdecision/", name="liste_comptes_decision", methods={"GET","POST"})
     *
     */
    public function listecomptes(Request $request): Response
    {

        $comptetype = $request->request->get('comptetype');
        if($comptetype == "Compte Exportateur"){
            $comptes = $this->getDoctrine()->getRepository(Compte::class)->getCompteslisteExp();
        }
        elseif($comptetype == "Compte Investisseur"){
            $comptes = $this->getDoctrine()->getRepository(Compte::class)->getCompteslisteInv();
        }
        elseif($comptetype == "Compte DO"){
            $comptes = $this->getDoctrine()->getRepository(Compte::class)->getCompteslisteDo();
        }  
        elseif($comptetype == "Compte Partenaire"){
            $comptes = $this->getDoctrine()->getRepository(Compte::class)->getListsPartenaires();
        }
        foreach ($comptes as $compte) {
        $data[] = array(
            "id" => $compte->getId(),
            "nom" => $compte->getNomCompte(),
        );
        }
        $output = array(
            "data" => $data,
        );
        return new Response(json_encode($output));
    }
     /**
     * @Route("/listecomptesdecisiongpac/", name="liste_comptes_decisiongpac", methods={"GET","POST"})
     *
     */
    public function listecomptesgpac(Request $request,ProjetsRepository $projetsRepository): Response
    {
        $pid = $request->request->get('pid');
        $projet = $this->getDoctrine()->getRepository(Projets::class)->findOneBy(['id'=>$pid]);

        $DO = $projetsRepository->getValueField($projet->getId(),'donneur_ordre');
        $comptes = $this->getDoctrine()->getRepository(Compte::class)->getCompteslisteDo();
        foreach ($DO as $compte) {
        $data[] = array(
            "id" => $compte->getId(),
            "nom" => $compte->getNomCompte(),
        );
        }
        $output = array(
            "data" => $data,
        );
        return new Response(json_encode($output));
    }
    


}
 
