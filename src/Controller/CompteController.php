<?php

namespace App\Controller;

use Knp\Snappy\Pdf;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Component\HttpFoundation\BinaryFileResponse; 
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use App\Entity\Pays;
use App\Entity\User;
use App\Entity\Event;
use App\Entity\Compte;
use App\Entity\Contact;
use App\Entity\Profils;
use App\Entity\Fonction;
use App\Entity\Projets;
use App\Entity\Secteur;
use App\Form\CompteType;
use App\Entity\LogCompte;
use App\Form\ContactType;
use App\Form\ProjetsType;
use App\Entity\CompteData;
use App\Entity\EtatCompte;
use App\Entity\EtatProjet;
use App\Entity\TypeCompte;
use App\Entity\TypeProjet;
use App\Entity\CarteVisite;
use App\Entity\ProjetsData;
use App\Utils\GenerateForm;
use App\Form\CompteDataType;
use App\Domain\SecteurDomain;
use App\Form\CarteVisiteType;
use App\Form\CompteFiltreType;
use App\FiltreData\CompteFiltre;
use App\FiltreData\PartenaireFiltre;
use App\Form\PartenaireFiltreType;
use App\Form\ActionFiltreType;
use App\FiltreData\ActionsFiltre;
use App\Entity\EcosystemeFiliere;
use App\Services\Form\CreateForm;
use App\Repository\CompteRepository;
use App\Repository\LogCompteRepository;
use App\Utils\Uploader\FileUploader;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Repository\EtatCompteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Serializer;
use App\Utils\Workflow\CompteWorkflowHandler;
use App\Utils\Workflow\ProjetWorkflowHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Services\Mailer\Mailer;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Validator\Constraints\File as ConstraintsFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


 
class CompteController extends AbstractController
{

    private $mailer;
    private $user;

    public function __construct(Mailer $mailer)
    {
        $this->mailer=$mailer;

    }

    /**
     * @Route("/comptes/importer", name="compte_importer", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
    */
    
    public function import(Request $request, EntityManagerInterface $em,CompteWorkflowHandler $pwh): Response
    {
        $CA_EXPORT;
        $form = $this->createFormBuilder()
            ->add('files', FileType::class, array(
                'constraints' =>
                    [
                        new ConstraintsFile([
                            'mimeTypes' => [
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                            ],
                            'mimeTypesMessage' => 'Le type du fichier est invalide. Les types autorisés sont "Xls,Xlsx".'
                        ])
                    ],
                'label' => 'Fichier à importer'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Importer', 'attr' => ['class' => 'btn btn-btn-blue']
            ))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->getData()['files'];

            try {
                if ($brochureFile) {
                    $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $originalFilename;
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessClientExtension();
                    try {
                        $brochureFile->move(
                            $this->getParameter('data_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                    }
                    $file = $this->getParameter('data_directory') . '/' . $newFilename;

                    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
                    $reader->setReadDataOnly(TRUE);
                    $spreadsheet = $reader->load($file);
                    $spreadsheet->getActiveSheet()->removeRow(1);
                    $worksheet = $spreadsheet->getActiveSheet();
                    $em = $this->getDoctrine()->getManager();
                    foreach ($worksheet->getRowIterator() as $row) {

                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(FALSE);
                        $compte = (new Compte());
                        $compte->setResponsableCompte($this->getUser());
                        $compte->setSignalement(false);
                        $compte->setCategorie(false);
                        $compte->setIsDeleted(false);
                        $etatcom = $this->getDoctrine()->getRepository(EtatCompte::class)->findBy(['id' => 1]);  
                        if($etatcom){
                            $compte->setEtatCompte($etatcom[0]);
                        }
                        foreach ($cellIterator as $key => $cell) {
                            $getValue = $cell->getValue();
                            if ($key == "A") {
                                if(isset($getValue)){
                                    $compte->setNomCompte($getValue);
                                }
                            } else if ($key == "B") {
                                $isInstall = ($getValue == "oui") ? true : false;
                                $compte->setCategorie($isInstall);
                            } else if ($key == "C") {
                                if(isset($getValue)){
                                    if($getValue == "Exportateur"){
                                        $type = $this->getDoctrine()->getRepository(TypeCompte::class)->findOneBy(['id' => 1]);                                        
                                    }elseif($getValue == "Investisseur"){
                                        $type = $this->getDoctrine()->getRepository(TypeCompte::class)->findOneBy(['id' => 2]);                                        
                                    }elseif($getValue == "DO"){
                                        $type = $this->getDoctrine()->getRepository(TypeCompte::class)->findOneBy(['id' => 3]);   
                                    }elseif($getValue == "Partenaire"){
                                        $type = $this->getDoctrine()->getRepository(TypeCompte::class)->findOneBy(['id' => 4]);   
                                    }
                                    if ($type) {
                                        $compte->setType($type);
                                    }  
                                }
                            } else if ($key == "D") {
                                if(isset($getValue)){
                                    if ($getValue != "") {
                                        $payssiege = $this->getDoctrine()->getRepository(Pays::class)->findOneBy(['nom' => $getValue]);
                                        if ($payssiege) {
                                            $compte->setPaysSiege($payssiege);
                                        } 
                                    }
                                }
                            } else if ($key == "E") {
                                // echo "pays de implantaion : " . $getValue . " <br>";
                                if(isset($getValue)){
                                    if ($getValue != "") {
                                        $valuePaysImplantaion = explode(', ', $getValue);
                                        foreach ($valuePaysImplantaion as $keys => $paysImplantaion) {
                                            $pays = $this->getDoctrine()->getRepository(Pays::class)->findOneBy(['nom' => $paysImplantaion]);
                                            if ($pays) {
                                                $compte->addPaysImplantationSuccursale($pays);
                                            } 
                                        }
                                    }
                                }
                            } else if ($key == "F") {
                                if ($getValue != "") {
                                    $listeSecteurs = explode(', ', $getValue);
                                    foreach ($listeSecteurs as $keys => $mysecteur) {
                                        $secteur = $this->getDoctrine()->getRepository(Secteur::class)->findOneBy(['nom' => $mysecteur]);
                                        if ($secteur) {
                                            $compte->addSecteur($secteur);
                                        }
                                    }
                                }
                            } else if ($key == "G") {
                                if ($getValue != "") {
                                    $centre_decision = $this->getDoctrine()->getRepository(Pays::class)->findOneBy(['nom' => $getValue]);
                                    if ($centre_decision) {
                                        $compte->setCentreDecision($centre_decision);
                                    } 
                                }
                            } else if ($key == "H") {
                                if ($getValue != "") {
                                    $compte->setChiffreAffaires($getValue);
                                }
                            } else if ($key == "I") {
                                if ($getValue != "") {
                                    $data = new CompteData();
                                    $data->setCle('CA_Export');
                                    $data->setValue($getValue);
                                    $data->setCompte($compte);
                                    $em->persist($data);
                                    $em->flush();
                                }
                            } else if ($key == "J") {
                                if ($getValue != ""){
                                    $compte->setDetailLibre($getValue);
                                }
                            } else if ($key == "K") {
                                if($getValue == "Considération"){
                                    $etatCompte=$this->getDoctrine()->getRepository(EtatCompte::class)->findOneBy(['id'=>8]);
                                    $compte->setEtatCompte($etatCompte);
                                }elseif($getValue == "Prospection"){
                                    $etatCompte=$this->getDoctrine()->getRepository(EtatCompte::class)->findOneBy(['id'=>9]);
                                    $compte->setEtatCompte($etatCompte);
                                }else{
                                    $etatCompte=$this->getDoctrine()->getRepository(EtatCompte::class)->findOneBy(['id'=>7]);
                                    $compte->setEtatCompte($etatCompte);
                                }
                            }
                        } 
                        if($compte->getNomCompte()){
                            $em->persist($compte);              
                        }
                        $pwh->handle($compte, $compte->getEtatCompte()->getNomConstant());
                    }
                    $em->flush();

                } 
                $this->addFlash('success', 'Nouveaux comptes ont été bien enregistrés avec succès');
                return $this->redirectToRoute('compte_index');

                $this->addFlash(
                    'success',
                    'Des comptes ont été bien enregistrés'
                );

            } catch (\Throwable $th) {
                $this->addFlash('danger', 'Problème d\'en coordonner de compte');

                return $this->redirectToRoute('compte_index');

                $this->addFlash(
                    'danger',
                    'Problème d\'en coordonner de compte'
                );
            }
        }
        return $this->render(
            'compte/import.html.twig',
            ['form' => $form->createView()]
        );
    }

    private function telecharger($comptes){
        $spreadsheet = new Spreadsheet();
      //  $spreadsheet = new
        $sheet = $spreadsheet->getActiveSheet();
        $num=1;
        $sheet->setCellValue('A'.$num, 'Compte');
        $sheet->setCellValue('B'.$num, 'Categorie');
        $sheet->setCellValue('C'.$num, 'Type');
        $sheet->setCellValue('D'.$num, 'Pays de siege');
        $sheet->setCellValue('E'.$num, 'Pays de implantaion');
        $sheet->setCellValue('F'.$num, 'Liste de secteur');
        $sheet->setCellValue('G'.$num, 'Liste des filiere');
        $sheet->setCellValue('H'.$num, 'Centre de decision');
        $sheet->setCellValue('I'.$num, 'Chiffre affaires');
        $sheet->setCellValue('J'.$num, 'Ca export');
        $sheet->setCellValue('K'.$num, 'Detail libre');

        $n = 1;
        foreach($comptes as $row){
            $rowNum = $n + 1;
            $secteurs="";

            foreach ($row->getSecteurs() as $secteur)
            {
               // dd($secteur->getNom());
                $secteurs.=" ".$secteur->getNom();
            }
            $sheet->setCellValue('A'.$rowNum, $row->getNomCompte());
            $sheet->setCellValue('B'.$rowNum, $row->getCategorie()?"Installés au Maroc":"Non Installés au Maroc");
            $sheet->setCellValue('C'.$rowNum, $row->getType()->getNom());
            $sheet->setCellValue('D'.$rowNum, $row->getEtatCompte()->getNom());
            $sheet->setCellValue('E'.$rowNum, $secteurs);
            $sheet->setCellValue('F'.$rowNum, $row->getSignalement()?"Oui":"Non");
            $sheet->setCellValue('G'.$rowNum, $row->getResponsableCompte()->getNom().' '.$row->getResponsableCompte()->getPrenom());
            $n++;
        }

        $filename = 'comptes-'.time().'.xlsx';
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
     * @Route("/comptes/comptecsv", name="compte_model_csv", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function modelCSV(CompteRepository $compteRepository): Response
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $num = 1;
        $sheet->setCellValue('A'.$num, 'Compte');
        $sheet->setCellValue('B'.$num, 'Categorie');
        $sheet->setCellValue('C'.$num, 'Type');
        $sheet->setCellValue('D'.$num, 'Pays de siege');
        $sheet->setCellValue('E'.$num, 'Pays de implantaion');
        $sheet->setCellValue('F'.$num, 'Liste de secteur');
        $sheet->setCellValue('G'.$num, 'Liste des filiere');
        $sheet->setCellValue('H'.$num, 'Centre de decision');
        $sheet->setCellValue('I'.$num, 'Chiffre affaires');
        $sheet->setCellValue('J'.$num, 'Ca export');
        $sheet->setCellValue('K'.$num, 'Detail libre');

        $filename = 'model_compte.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
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
     * @Route("/comptes/filtre", name="compte_filtre", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function filtre(Request $request,SecteurDomain $secteurDomain,compteRepository $compteRepository): Response
    {
        $telecharger=$request->query->get('telecharger')==1?1:0;
        $id=$request->get('secteur')?$request->get('secteur'):null;
        $data=new CompteFiltre();
        $form = $this->createForm(CompteFiltreType::class, $data);
        $form->handleRequest($request);
        $comptes=$compteRepository->getListsComptes($id,$data);
        if($telecharger){
            $this->telecharger($comptes);
        }
        $secteur=null;
        if($id){
            $secteur=$this->getDoctrine()->getRepository(Secteur::class)->findOneBy(['id'=>$id]);
        }
        $secteurs=$secteurDomain->getSecteurByUser();
        return $this->render('compte/filtre/index.html.twig',[
            'comptes'=> $comptes,
            'secteurs'=>$secteurs,
            'secteur_active'=>$secteur,
            'form'=>$form->createView()
        ]);
    }



    /**
     * @Route("/comptes", name="compte_index", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function index(Request $request,SecteurDomain $secteurDomain,compteRepository $compteRepository): Response
    {
        $compte = new Compte();
        $data=new CompteFiltre();
        $form = $this->createForm(CompteFiltreType::class, $data);
        $form->handleRequest($request);
        $secteur=null;
        $id=$request->get('secteur')?$request->get('secteur'):null;
        if($id){
            $secteur=$this->getDoctrine()->getRepository(Secteur::class)->findOneBy(['id'=>$id]);
        }
        $secteurs=$secteurDomain->getSecteurByUser();
        return $this->render('compte/index.html.twig',[
            'comptes'=> $compteRepository->getListsComptes($id,$data),
            'secteurs'=>$secteurs,
            'secteur_active'=>$secteur,
            'compte' =>$compte,
            'form'=>$form->createView()
        ]);
    }

     /**
     * @Route("/comptes/export", name="compte_export", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function exporttoexcel(Request $request,SecteurDomain $secteurDomain,compteRepository $compteRepository): Response
    {

        $compte = new Compte();
        $data=new CompteFiltre();
        $form = $this->createForm(CompteFiltreType::class, $data);
        $form->handleRequest($request);
        $secteur=null;
        $id=$request->get('secteur')?$request->get('secteur'):null;
        if($id){
            $secteur=$this->getDoctrine()->getRepository(Secteur::class)->findOneBy(['id'=>$id]);
        }
        $secteurs=$secteurDomain->getSecteurByUser();
        $comptes = $compteRepository->getListsComptes($id,$data);

        $spreadsheet = new Spreadsheet();        
        $sheet = $spreadsheet->getActiveSheet();
        $num=1;
        $sheet->setCellValue('A'.$num, 'Compte');
        $sheet->setCellValue('B'.$num, 'Categorie');
        $sheet->setCellValue('C'.$num, 'Type');
        $sheet->setCellValue('D'.$num, 'Pays de siege');
        $sheet->setCellValue('E'.$num, 'Pays de implantaion');
        $sheet->setCellValue('F'.$num, 'Liste de secteur');
        $sheet->setCellValue('G'.$num, 'Centre de decision');
        $sheet->setCellValue('H'.$num, 'Chiffre affaires');
        $sheet->setCellValue('I'.$num, 'Ca export');
        $sheet->setCellValue('J'.$num, 'Etat Compte');
        $sheet->setCellValue('K'.$num, 'Résponsable Compte');
        $sheet->setCellValue('L'.$num, 'Date de création');
        $sheet->setCellValue('M'.$num, 'Date Passage Prospection');
        $sheet->setCellValue('N'.$num, 'Date Passage Intérêt');
        $sheet->setCellValue('O'.$num, 'Noms contacts');
        $sheet->setCellValue('P'.$num, 'Fonctions contacts');
        $sheet->setCellValue('Q'.$num, 'Emails contacts');
        
        $n = 1;
          foreach($comptes as $row){
            $rowNum = $n + 1;
            $im = $row->getCategorie();
            $secteurs="";
            foreach ($row->getSecteurs() as $secteur)
            {
                $secteurs.=" / ".$secteur->getNom();
            }
            $pays="";
            foreach ($row->getPaysImplantationSuccursales() as $pay)
            {
                $pays.=" / ".$pay->getNom();
            }
            // $filieres="";
            // foreach ($row->getEcosystemeFiliere() as $filiere)
            // {
            //     $filieres.=" / ".$filiere->getNom();
            // }
            if(!is_null($row->getEtatCompte())){
                $etat_id = $row->getEtatCompte()->getId();
            }else{
                $etat_id = 7;
            }
            if(!$row->getPaysSiege()){
                $payeValue="";
            }else{
                $payeValue = $row->getPaysSiege()->getNom();
            }
            if(!$row->getCentreDecision()){
                $centreValue="";
            }else{
                $centreValue = $row->getCentreDecision()->getNom();
            }
            $etat = $this->getDoctrine()->getRepository(EtatCompte::class)->findOneBy(['id'=> $etat_id]);
			
            /* On recherche la date du passage au statut Prospection */
            $datePassageProspection = "";
            if(!is_null($row->getLogComptes())) {
                $maxId = 0;
                foreach($row->getLogComptes() as $logCompte) {
                    if($logCompte->getStatus() == "Prospection") {
                        if($maxId < $logCompte->getId()) {
                            $maxId = $logCompte->getId();
                            $datePassageProspection = $logCompte->getDateCreation()->format("d-m-Y");
                        }
                    }
                }
            }
            /* On recherche la date du passage au statut Intérêt */
            $datePassageInteret = "";
            if(!is_null($row->getProjets())) {
                $minDateCreation = null;
                foreach($row->getProjets() as $projet) {
                    if(!$projet->getIsDeleted()) {
                        if ($minDateCreation == null) {
                            $minDateCreation = $projet->getDateCreation();
                        } else if($projet->getDateCreation() < $minDateCreation) {
                            $minDateCreation = $projet->getDateCreation();
                        }
                    }
                }
                if(!is_null($minDateCreation)) {
                    $datePassageInteret = $minDateCreation->format("d-m-Y");
                }
            }
            /* On recherche la liste des contacts associés */
            $nomsContacts="";
            $fonctionsContacts="";
            $emailsContacts="";
            foreach ($row->getCarteVisites() as $carteVisite)
            {
                if(!empty($carteVisite->getContact()->getNom()) && !empty($carteVisite->getContact()->getPrenom())) {
                    $nomsContacts.=" / ".$carteVisite->getContact()->getNom().' '.$carteVisite->getContact()->getPrenom();
                } else if (!empty($carteVisite->getContact()->getNom()) && empty($carteVisite->getContact()->getPrenom())) {
                    $nomsContacts.=" / ".$carteVisite->getContact()->getNom();
                }
                if(!is_null($carteVisite->getFonction())) {
                    $fonctionsContacts.=" / ".$carteVisite->getFonction()->getNom();
                } else {
                    $fonctionsContacts.=" / ";
                }
                if(!empty($carteVisite->getEmail())) {
                    $emailsContacts.=" / ".$carteVisite->getEmail();
                } else {
                    $emailsContacts.=" / ";
                }
            }
			
            $sheet->setCellValue('A'.$rowNum, $row->getNomCompte());
            $sheet->setCellValue('B'.$rowNum, $im ?'Installé au Maroc':'Non Installé au Maroc');
            $sheet->setCellValue('C'.$rowNum, $row->getType()->getNom());
            $sheet->setCellValue('D'.$rowNum, $payeValue);
            $sheet->setCellValue('E'.$rowNum, $pays);
            $sheet->setCellValue('F'.$rowNum, $secteurs);
            $sheet->setCellValue('G'.$rowNum, $centreValue);
            $sheet->setCellValue('H'.$rowNum, $row->getChiffreAffaires());
            $sheet->setCellValue('I'.$rowNum, $row->getCaExport());
            $sheet->setCellValue('J'.$rowNum, $etat->getNom());
            $sheet->setCellValue('K'.$rowNum, $row->getResponsableCompte()->getNom().' '.$row->getResponsableCompte()->getPrenom());
            $sheet->setCellValue('L'.$rowNum, $row->getDateCreation());
            $sheet->setCellValue('M'.$rowNum, $datePassageProspection);
            $sheet->setCellValue('N'.$rowNum, $datePassageInteret);
            $sheet->setCellValue('O'.$rowNum, $nomsContacts);
            $sheet->setCellValue('P'.$rowNum, $fonctionsContacts);
            $sheet->setCellValue('Q'.$rowNum, $emailsContacts);
			
            $n++;
        }
        // Create your Office 2007 Excel (XLSX Format)
        $writer = new Xlsx($spreadsheet);
        
        // Create a Temporary file in the system
        $fileName = 'Comptes-'.time().'.xlsx';
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
     * @Route("/partenaires/export_partenaires", name="partenaires_export", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function exporttoexcelpartenaires(Request $request,SecteurDomain $secteurDomain,compteRepository $compteRepository): Response
    {

        $compte = new Compte();
        $data=new PartenaireFiltre();
        $form = $this->createForm(PartenaireFiltreType::class, $data);
        $form->handleRequest($request);
        $secteur=null;
        $id=$request->get('secteur')?$request->get('secteur'):null;
        if($id){
            $secteur=$this->getDoctrine()->getRepository(Secteur::class)->findOneBy(['id'=>$id]);
        }
        $secteurs=$secteurDomain->getSecteurByUser();
        $comptes = $compteRepository->getListsPartenaires($id,$data);
        $spreadsheet = new Spreadsheet();
       
        $sheet = $spreadsheet->getActiveSheet();
        $sheet = $spreadsheet->getActiveSheet();
        $num=1;
        $sheet->setCellValue('A'.$num, 'Partenaire');
        $sheet->setCellValue('B'.$num, 'Type');
        $sheet->setCellValue('C'.$num, 'Engagement');
        $sheet->setCellValue('D'.$num, 'Type d’Engagement');
        $sheet->setCellValue('E'.$num, 'Pays cible');
        $sheet->setCellValue('F'.$num, 'Pays origine');
        $sheet->setCellValue('G'.$num, 'Secteur');
        $sheet->setCellValue('H'.$num, 'Description activité');
        $sheet->setCellValue('I'.$num, 'Résponsable partenaire');
        $sheet->setCellValue('K'.$num, 'Date de création');

        $n = 1;
         foreach($comptes as $row){
            $Typeparte=$compteRepository->getValueField($row->getId(),'TypePartenaire')?($compteRepository->getValueField($row->getId(),'TypePartenaire')['value']):'non';
            $EngagementPart=$compteRepository->getValueField($row->getId(),'EngagementPart')?($compteRepository->getValueField($row->getId(),'EngagementPart')['value']?'oui':'non'):'non';
            $rowNum = $n + 1;
            $im = $row->getCategorie();
            $secteurs="";
            foreach ($row->getSecteurs() as $secteur)
            {
                $secteurs.=" / ".$secteur->getNom();
            }
            $pays="";
            foreach ($row->getPaysImplantationSuccursales() as $pay)
            {
                $pays.=" / ".$pay->getNom();
            }
            $sheet->setCellValue('A'.$rowNum, $row->getNomCompte());
            $sheet->setCellValue('B'.$rowNum, $row->getType()->getNom());
            $sheet->setCellValue('C'.$rowNum, $EngagementPart);
            $sheet->setCellValue('D'.$rowNum, $Typeparte);
            $sheet->setCellValue('E'.$rowNum, $pays);
            if(!empty($row->getPaysSiege())) {
                $sheet->setCellValue('F'.$rowNum, $row->getPaysSiege()->getNom());
            } else {
                $sheet->setCellValue('F'.$rowNum, "");
            }
            $sheet->setCellValue('G'.$rowNum, $secteurs);
            $sheet->setCellValue('H'.$rowNum, $row->getDetailLibre());
            $sheet->setCellValue('I'.$rowNum, $row->getResponsableCompte()->getNom().' '.$row->getResponsableCompte()->getPrenom());
            $sheet->setCellValue('K'.$rowNum, $row->getDateCreation());

            $n++;
        }
        
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Partenaires-'.time().'.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);

        /*return $this->render('compte/indexparte.html.twig',[
            'comptes'=> $compteRepository->getListsComptes($id,$data),
            'secteurs'=>$secteurs,
            'secteur_active'=>$secteur,
            'compte' =>$compte,
            'form'=>$form->createView()
        ]);*/
    }

    /**
     * @Route("/partenaires", name="partenaire_list", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function partenaire_index(Request $request,SecteurDomain $secteurDomain,compteRepository $compteRepository): Response
    {
        $compte = new Compte();
        $data=new PartenaireFiltre(); 
        $form = $this->createForm(PartenaireFiltreType::class, $data);
        $form->handleRequest($request);
        $secteur=null;
        $id=$request->get('secteur')?$request->get('secteur'):null;
        if($id){
            $secteur=$this->getDoctrine()->getRepository(Secteur::class)->findOneBy(['id'=>$id]);
        }
        $secteurs=$secteurDomain->getSecteurByUser();
        return $this->render('compte/indexparte.html.twig',[
            'comptes'=> $compteRepository->getListsPartenaires($id,$data),
            'secteurs'=>$secteurs,
            'secteur_active'=>$secteur,
            'compte' =>$compte,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/comptes/new/{id}", name="compte_new", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function new($id, Request $request, FileUploader $fileUploader,CompteWorkflowHandler $pwh,EntityManagerInterface $em): Response

    {
        // $compte = new Compte();
        // $entityname = 'compte';
        // $form_fields=$formBuilder->createFrom(
        //     [
        //         'type_form'=>$id,
        //         'form'=> CompteDataType::class,
        //         'fields'=>[1,2],
        //         'path'=> 'forms-compte.yml'
        //     ]
        //     ,CompteData::class,
        //     ['compte'=>$compte->getId()],
        //     $entityname
        // );
        // $form = $this->createForm(CompteDataType::class, $compte, array("schema_form" => $form_fields),$entityname);
        // $form->handleRequest($request);
        // if ($form->isSubmitted() && $form->isValid()) {
        //     $entityManager = $this->getDoctrine()->getManager();
        //     $compte->setIsDeleted(false);
        //     $entityManager->persist($compte);
        //     $formBuilder->SaveData($form_fields,$form,CompteData::class,$compte,['compte'=>$compte->getId()],$entityname);
        //     $entityManager->flush();
        //     $this->addFlash('success', 'Le nouveau compte a été créé avec succès');
        //     return $this->redirectToRoute('compte_index');
        // }

        // return $this->render('compte/new.html.twig', [
        //     'compte' => $compte,
        //     'form' => $form->createView(),
        // ]);
        $compte = new Compte();

        $compte->setCreePar($this->getUser());

        $this->denyAccessUnlessGranted('CREATION_DE_COMPTE', $compte);

        $path = $this->getParameter('forms_directory') . '/forms-compte.yml';
        $generateForm=new GenerateForm($id,$path,$em);
        $form_fields=$generateForm->getFields([1,2]);
        $this->setDataForm($form_fields,CompteData::class,$compte);
        $form = $this->createForm(CompteType::class, $compte, array("schema_form" => $form_fields));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($form_fields as $field) {

                    $name=$field["name"];
                    $type=$field["type"];
                    if ($form[$name]->getData() != "") {
                        if ($type == "EntityType") {
                            $data = new CompteData();
                            $data->setCle($name);
                            $data->setValue($form[$name]->getData()->getId());
                            $data->setCompte($compte);
                            $entityManager->persist($data);
                        } else if ($type == "FileType") {
                            $file = $form->get($name)->getData();
                            if ($file) {
                                $newFilename = $fileUploader->upload($file);
                                $data = new CompteData();
                                $data->setCle($name);
                                $data->setValue($newFilename);
                                $data->setCompte($compte);
                                $entityManager->persist($data);
                            }
                        } else if($type == "MultiSelectType"){
                            if($form[$name]->getData()){
                                $array_object=[];
                                foreach ($form[$name]->getData() as $object){
                                    array_push($array_object,$object->getId());
                                }
                                $data = new CompteData();
                                $data->setCle($name);
                                $data->setValue(json_encode($array_object));
                                $data->setCompte($compte);
                                $entityManager->persist($data);
                             }
                        }else {
                            $data = new CompteData();
                            $data->setCle($name);
                            $data->setValue($form[$name]->getData());
                            $data->setCompte($compte);
                            $entityManager->persist($data); 
                        }
                    }
            }
           
            $compte->setDateCreation(new \DateTimeImmutable());
            $compte->setIsDeleted(false);
            $entityManager->persist($compte);
            $entityManager->flush();
            $this->addFlash('success', 'Le nouveau compte a été créé avec succès');
            $pwh->handle($compte, $compte->getEtatCompte()->getNomConstant());
            return $this->redirectToRoute('compte_index');
        }
          return $this->render('compte/new.html.twig', [
            'compte' => $compte,
            'form' => $form->createView(),
        ]);
    }

    
    /**
     * @Route("/partenaires/new/{id}", name="part_new", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function newpartenaire($id, Request $request, FileUploader $fileUploader,CompteWorkflowHandler $pwh,EntityManagerInterface $em): Response

    {
        $compte = new Compte();
        $compte->setCreePar($this->getUser());
        $this->denyAccessUnlessGranted('CREATION_DE_COMPTE', $compte);
        $path = $this->getParameter('forms_directory') . '/forms-compte.yml';
        $generateForm=new GenerateForm($id,$path,$em);
        $form_fields=$generateForm->getFields([1,2]);
        $this->setDataForm($form_fields,CompteData::class,$compte);
        $form = $this->createForm(CompteType::class, $compte, array("schema_form" => $form_fields));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($form_fields as $field) {

                    $name=$field["name"];
                    $type=$field["type"];
                    if ($form[$name]->getData() != "") {
                        if ($type == "EntityType") {
                            $data = new CompteData();
                            $data->setCle($name);
                            $data->setValue($form[$name]->getData()->getId());
                            $data->setCompte($compte);
                            $entityManager->persist($data);
                        } else if ($type == "FileType") {
                            $file = $form->get($name)->getData();
                            if ($file) {
                                $newFilename = $fileUploader->upload($file);

                                $data = new CompteData();

                                $data->setCle($name);
                                $data->setValue($newFilename);
                                $data->setCompte($compte);
                                $entityManager->persist($data);
                            }
                        } else if($type == "MultiSelectType"){
                            if($form[$name]->getData()){
                                $array_object=[];
                                foreach ($form[$name]->getData() as $object){
                                    array_push($array_object,$object->getId());
                                }
                                $data = new CompteData();
                                $data->setCle($name);
                                $data->setValue(json_encode($array_object));
                                $data->setCompte($compte);
                                $entityManager->persist($data);
                             }
                        }else {
                            $data = new CompteData();
                            $data->setCle($name);
                            $data->setValue($form[$name]->getData());
                            $data->setCompte($compte);
                            $entityManager->persist($data);
                        }
                    }
            }
            $compte->setDateCreation(new \DateTimeImmutable());
            $tcompte = $this->getDoctrine()->getRepository(TypeCompte::class)->find(4);
            $compte->setType($tcompte);
            $compte->setIsDeleted(false);
            $entityManager->persist($compte);
            $entityManager->flush();
            $this->addFlash('success', 'Nouveau partenaire a été créé avec succès');
            $pwh->handle($compte, $compte->getEtatCompte()->getNomConstant());
            return $this->redirectToRoute('partenaire_list');
        }
          return $this->render('compte/newpartenaire.html.twig', [
            'compte' => $compte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/comptes/compte/{id}", name="compte_detail", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function compte(Compte $compte,Request $request,CreateForm $buildForm,EntityManagerInterface $em,FileUploader $fileUploader): Response
    {
        $this->denyAccessUnlessGranted('CONSULTER_COMPTE', $compte);

        $datalogs=new ActionsFiltre();
        $formfiltre = $this->createForm(ActionFiltreType::class, $datalogs);
        $formfiltre->handleRequest($request);

        $secteurs=$this->getUser()->getSecteurs();
        $entityname = 'compte';
        $form_fields=$buildForm->createFrom(
            [
                'type_form'=>$compte->getType()->getId(),
                'form'=> CompteDataType::class,
                'fields'=>[1,2,3],
                'path'=> 'forms-compte.yml'
            ]
            ,CompteData::class,
            ['compte'=>$compte->getId()],
            $entityname
        );
        $form = $this->createForm(CompteType::class, $compte, array("schema_form" => $form_fields),$entityname);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $buildForm->SaveData($form_fields,$form,CompteData::class,$compte,['compte'=>$compte->getId()],$entityname);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compte);
            $entityManager->flush();
            $this->addFlash('success', 'Ce compte a été modifié avec succès');
            return $this->redirectToRoute('compte_detail',['id'=>$compte->getId()]);
        }
        $contactslists = $this->getDoctrine()->getRepository(Contact::class)->findAll();
         
        $projets_list=$this->getDoctrine()->getRepository(Projets::class)->getListeProjetListeByCompte($compte);
 
        return $this->render('compte/detail_compte/compte.html.twig', [
            'compte' => $compte,
            'list_status' => $this->getDoctrine()->getRepository(EtatCompte::class)->statutliste(), 
            'type_compte' => $this->getDoctrine()->getRepository(TypeCompte::class)->findAll(),
            'contacts' => $this->getDoctrine()->getRepository(CarteVisite::class)->getCVByCompte($compte),
            'form' => $form->createView(),
            'formfiltre' => $formfiltre->createView(),
            'logs_compte' => $this->getDoctrine()->getRepository(LogCompte::class)->listLogsByCompte($compte->getId()),
            "type_projet" => $this->getDoctrine()->getRepository(TypeProjet::class)->findAll(),
            "projets_list"=>$projets_list,
            "contactslists" => $contactslists
         ]);
    }
     /**
     * @Route("/partenaires/partenaire/{id}", name="partenaire_detail", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function partenaire(Compte $compte,Request $request,CreateForm $buildForm,EntityManagerInterface $em,FileUploader $fileUploader): Response
    {
        $this->denyAccessUnlessGranted('CONSULTER_COMPTE', $compte);

        $datalogs=new ActionsFiltre();
        $formfiltre = $this->createForm(ActionFiltreType::class, $datalogs);
        $formfiltre->handleRequest($request);

        $secteurs=$this->getUser()->getSecteurs();
        $entityname = 'compte';
        $form_fields=$buildForm->createFrom(
            [
                'type_form'=>$compte->getType()->getId(),
                'form'=> CompteDataType::class,
                'fields'=>[1],
                'path'=> 'forms-compte.yml'
            ]
            ,CompteData::class,
            ['compte'=>$compte->getId()],
            $entityname
        );
        $form = $this->createForm(CompteType::class, $compte, array("schema_form" => $form_fields),$entityname);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $buildForm->SaveData($form_fields,$form,CompteData::class,$compte,['compte'=>$compte->getId()],$entityname);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compte);
            $entityManager->flush();
            $this->addFlash('success', 'Ce partenaire a été modifié avec succès');
            return $this->redirectToRoute('partenaire_detail',['id'=>$compte->getId()]);
        }
        $contactslists = $this->getDoctrine()->getRepository(Contact::class)->findAll();

        return $this->render('compte/detail_compte/partenaire.html.twig', [
            'compte' => $compte,
            'list_status' => $this->getDoctrine()->getRepository(EtatCompte::class)->findAll(),
            'type_compte' => $this->getDoctrine()->getRepository(TypeCompte::class)->findAll(),
            'contacts' => $this->getDoctrine()->getRepository(CarteVisite::class)->getCVByCompte($compte),
            'form' => $form->createView(),
            'formfiltre' => $formfiltre->createView(),
            'logs_compte' => $this->getDoctrine()->getRepository(LogCompte::class)->listLogsByCompte($compte->getId()),
            "type_projet" => $this->getDoctrine()->getRepository(TypeProjet::class)->findAll(),
            "contactslists" => $contactslists
         ]);
    }
     /**
     * @Route("/comptelogall", name="compte_log_filtre_all", methods={"GET","POST"})
     * 
     */
    public function comptelogfiltreall(Request $request): Response
    {
        $compteid = $request->request->get('compte');

        $logs_compte = $this->getDoctrine()->getRepository("App:LogCompte")
        ->listLogsByCompte($compteid);

        return $this->render('compte/detail_compte/logcomptefiltre.html.twig',array('logs_compte' => $logs_compte));
    }
     /**
     * @Route("/comptelogfiltre", name="compte_log_filtre", methods={"GET","POST"})
     * 
     */
    public function comptelogfiltre(Request $request): Response
    {
        $statu = $request->request->get('log_status');
        $startdate = $request->request->get('log_date');
        $enddate = $request->request->get('log_date_end');
        $compteid = $request->request->get('compte');
        
        $logs_compte = $this->getDoctrine()->getRepository("App:LogCompte")
        ->findlistLogsByCompte($compteid,$startdate,$enddate,$statu);

        return $this->render('compte/detail_compte/logcomptefiltre.html.twig',array('logs_compte' => $logs_compte));

    }

    /**
     * @Route("/comptes/{id}", name="compte_show", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function show(Compte $compte,Request $request,EntityManagerInterface $em,CreateForm $buildForm): Response
    {
        $this->denyAccessUnlessGranted('CONSULTER_COMPTE', $compte);

        if ($request->isMethod('post')) {
            $entityname = 'compte';
            $form_fields=$buildForm->createFrom(
                [
                    'type_form'=>$compte->getType()->getId(),
                    'form'=> CompteDataType::class,
                    'fields'=>[1],
                    'path'=> 'forms-compte.yml'
                ]
                ,CompteData::class,
                ['compte'=>$compte->getId()],
                $entityname
            );
            $form = $this->createForm(CompteType::class, $compte, array("schema_form" => $form_fields),$entityname);
            return $this->render('compte/details.html.twig', [
                'compte' => $compte,
                'form' => $form->createView()
            ]);
        }

        return $this->render('compte/show.html.twig', [
            'compte' => $compte,
        ]);
    }

    /**
     * @Route("/comptes/{id}/edit", name="compte_edit", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function edit(Request $request, Compte $compte,FileUploader $fileUploader): Response
    {

        $form = $this->createForm(CompteType::class, $compte);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Ce compte a été modifié avec succès');
            return $this->redirectToRoute('compte_edit',['id'=>$compte->getId()]);
        }
        $this->denyAccessUnlessGranted('MODIFIER_COMPTE', $compte);


        return $this->render('compte/edit.html.twig', [
            'compte' => $compte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/change_statuts/{status}/{compte}", name="compte_change_status", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function switchWorkflow(EtatCompte $status,Compte $compte,CompteWorkflowHandler $cwh,EntityManagerInterface $em)
    {
        try {
          if($status->getNomConstant()=="prospection"){
            $compte->setDateCreation(new \DateTimeImmutable());
            $em->persist($compte);
          }
            $transition=$status->getNomConstant();
            $compte->setEtatCompte($status);
            $cwh->handle($compte, $transition);

        } catch (LogicException $e) {
            $this->addFlash(
                'error',
                sprintf('Can not execute transition %s for PR: %d', $transition, $compte->getId())
            );
        }
        return $this->redirectToRoute('compte_detail',['id'=>$compte->getId()]);
    }

    /**
     * @Route("/comptes/{id}", name="compte_delete", methods={"DELETE"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function delete(Request $request, Compte $compte): Response
    {
        if ($this->isCsrfTokenValid('delete' . $compte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $compte->setIsDeleted(true);
            $entityManager->persist($compte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('compte_index');
    }
     /**
     * @Route("/partenaires/{id}", name="partenaires_delete", methods={"DELETE"}) 
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function delete_partenaires(Request $request, Compte $compte): Response
    {
        if ($this->isCsrfTokenValid('delete' . $compte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $compte->setIsDeleted(true);
            $entityManager->persist($compte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('partenaire_list');
    }
    /**
     * @Route("/handleSearchcompte/{_query?}", name="handle_search_compte", methods={"POST", "GET"})
     */
    public function handleSearchRequest(Request $request, $_query)
    {
        $em = $this->getDoctrine()->getManager();

        if ($_query)
        {
            $data = $em->getRepository(Compte::class)->searchCompteByName($_query);
        } else {
            $data = $em->getRepository(Compte::class)->listeCompteWhitName();
        }
        return new JsonResponse(json_encode($data), 200, [], true);
    }
    /**
     * @Route("/ajax_compte/{compte}", name="ajax_compte", methods={"GET"})
     */
    public function getCompte(Request $req): JsonResponse
    {
        $compte = $req->get('compte');
        $data = [];
        if($compte != null){
            $compteEntity =  $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['id' => $compte]);

            if(!empty($compteEntity)){
                $data['id'] = $compte;
                $data['name'] = $compteEntity->getNomCompte();
                $data['logo'] =  $compteEntity->getLogo() != null && $compteEntity->getLogo()->getFilename()!= null ? $compteEntity->getLogo()->getFilename() : 'logo_default.png';

                $data['secteurs'] = [];

                if(!empty($compteEntity->getSecteurs())){
                    foreach($compteEntity->getSecteurs() as $secteur){
                        $data['secteurs'][] = $secteur->getNom();
                    }

                }
            }
        }


        return new JsonResponse($data, Response::HTTP_CREATED, [], false);
    }
    private function setDataForm(&$form_fields,$table,$object){
        foreach ($form_fields as &$field){
            $options = $field["options"];
            $name=$field["name"];
            $type=$field["type"];
                $dataProject = $this->getDoctrine()->getRepository($table)->findOneBy(['compte' => $object->getId(), 'cle' => $name]);
                $options_data = $dataProject ? $dataProject->getValue() : null;
                if ($type == "FileType") {
                    if ($options_data) {
                        $field["options"]["data"] =  new File($this->getParameter('uploader_directory') . '/' . $options_data);
                    } else {
                        $field["options"]["data_class"] = null;
                    }
                }
                else if ($type == "MultiSelectType") {

                    $field["options"]["data"] = $this->getDoctrine()->getRepository($options["class"])->findby(['id' => json_decode($options_data)]);
    
                }
                else if ($type == "CheckboxType") {
                if ($options_data) {
                    $field["options"]["data"] = $options_data ? true : false;
                } else {
                    $field["options"]["data"] = false;
                }
            } else if ($type == "EntityType") {
                    $field["options"]["data"] = $this->getDoctrine()->getRepository($options["class"])->findOneBy(['id' => $options_data]);
                } else {
                    $field["options"]["data"] = $options_data;
                }
            }
    }

    /**
     * @Route("/generate/pdf/{id}", name="compte_pdf", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function generatePdf(Pdf $pdf,Compte $compte,Request $request, FileUploader $fileUploader,EntityManagerInterface $em): Response
    {

        $path = $this->getParameter('forms_directory') . '/forms-compte.yml';
        $generateForm=new GenerateForm($compte->getType()->getId(),$path,$em);
        $form_fields=$generateForm->getFields([1,2,3]);
        $this->setDataForm($form_fields,CompteData::class,$compte);
        $form = $this->createForm(CompteType::class, $compte, array("schema_form" => $form_fields));
        $contacts=$this->getDoctrine()->getRepository(Contact::class)->getContactByCompte($compte->getId());

        $url="compte/pdf/pdf.html.twig";

        $html=$this->renderView($url, [
            'compte' => $compte,
            'contacts' => $this->getDoctrine()->getRepository(CarteVisite::class)->getCVByCompte($compte),
            'logs_compte' => $this->getDoctrine()->getRepository(LogCompte::class)->listLogsByCompte($compte->getId()),
            'list_status'=>$this->getDoctrine()->getRepository(EtatCompte::class)->findAll(),
            'data' =>   array("projets" => $compte->getProjets(), "contact" => $contacts, "compte" => $compte),
            "type_projet" => $this->getDoctrine()->getRepository(TypeProjet::class)->findAll(),
            'form' => $form->createView(),

        ]);
        return new PdfResponse(
            $pdf->getOutputFromHtml($html),
            $compte->getNomCompte().'.pdf'
        );
        // return $this->render($url, [
        //     'compte' => $compte,
        //     'contacts' => $this->getDoctrine()->getRepository(CarteVisite::class)->getCVByCompte($compte),
        //     "type_projet" => $this->getDoctrine()->getRepository(TypeProjet::class)->findAll(),
        //     'logs_compte' => $this->getDoctrine()->getRepository(LogCompte::class)->listLogsByCompte($compte->getId()),
        //     'list_status'=>$this->getDoctrine()->getRepository(EtatCompte::class)->findAll(),
        //     'data' =>   array("projets" => $compte->getProjets(), "contact" => $contacts, "compte" => $compte),
        //     'form' => $form->createView(),
        //  ]);
       
    }
    /**
     * @Route("/change_signalement/{signal}/{compte}", name="compte_change_signalement", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function changesignal($signal,Compte $compte)
    {
        $compte->setSignalement($signal);
        $em=$this->getDoctrine()->getManager();
        $em->persist($compte);
        $em->flush();
        return $this->redirectToRoute('compte_detail',['id'=>$compte->getId()]);
    }


    /**
     * @Route("/addnewcontact/", name="add_new_contact", methods={"GET","POST"})
     *
     */
    public function contactnewadd(Request $request): Response
    {
        $contactname = $request->request->get('nomcompte');
        $id = $request->request->get('cid');
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($contactname);
        $compte = $this->getDoctrine()->getRepository(Compte::class)->find($id);
        return $this->get('router')->generate('carte_visite_new', array('contact' => '$contact','compte'=>'$compte'));       
    }

    /**
     * @Route("/change_princibale/{isprin}/{contact}/{compte}", name="change_princibale", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function changeprince($isprin,Contact $contact,Compte $compte)
    {

        $carteve = $this->getDoctrine()->getRepository(CarteVisite::class)->getCarteVistesByCompteContact($compte,$contact);
        $carte = $carteve[0];
        $carte->setIsPrincipale($isprin);
        $em = $this->getDoctrine()->getManager();
        $em->persist($carte);
        $em->flush();
        return $this->redirectToRoute('compte_detail',['id'=>$compte->getId()]);
    }

    /**
     * @Route("/filtrelog", name="compte_filtre_log", methods={"GET","POST"})
     *
     */
    public function filtrelog(Request $request): Response
    {

        $id=$request->get('secteur')?$request->get('secteur'):null;
        $data=new CompteFiltre();
        $form = $this->createForm(CompteFiltreType::class, $data);
        $form->handleRequest($request);
        $comptes=$compteRepository->getListsComptes($id,$data);
        if($telecharger){
            $this->telecharger($comptes);
        }
        $secteur=null;
        if($id){
            $secteur=$this->getDoctrine()->getRepository(Secteur::class)->findOneBy(['id'=>$id]);
        }
        $secteurs=$secteurDomain->getSecteurByUser();
        return $this->render('compte/filtre/index.html.twig',[
            'comptes'=> $comptes,
            'secteurs'=>$secteurs,
            'secteur_active'=>$secteur,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/comptes/newprospectionlog/", name="log_compteprospection", methods={"GET","POST"})
     *
     */
    public function log_compte_prospection_(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $date = $request->request->get('date');
        $action = $request->request->get('action');
        $event_id = $request->request->get('event');
        $detail = $request->request->get('detail');
        $compte_id = $request->request->get('cid');
        $compteRenduAct = $request->files->get('cradoc');
        
        if(!is_null($compteRenduAct)){
            $crFileName = md5(uniqid()) . '.' . $compteRenduAct->guessExtension();
            $compteRenduAct->move($this->getParameter('uploader_directory'), $crFileName);
        } else {
            $crFileName = null;
        }
        
        $event="";
        $compte=$this->getDoctrine()->getRepository(Compte::class)->findOneBy(['id'=>$compte_id]);
        if($action == "Event"){
            $eventObj=$this->getDoctrine()->getRepository(Event::class)->findOneBy(['id'=>$event_id]);
            $event=$eventObj->getNom();
        }
        
        $commentaire =
            "Date : ".$date." \n ".
            "Action : ".$action." ".$event." \n ".
            "Détails Libres : ".$detail;
        
        $log = new LogCompte();
        $log->setCommentaire($commentaire); 
        $log->setCompte($compte);
        $log->setStatus("Action");
        $log->setCreePar($this->getUser());
        $log->setDateCreation(new \DateTimeImmutable($date));
        if(!is_null($crFileName)) {
            $log->setDocument($crFileName);
        }
        
        $em->persist($log);
        $em->flush();

        return new JsonResponse(["compte_id" => $compte->getId()]);
    }

     /**
     * @Route("/nouveau_contact/{compte}", name="nouveau_contact_compte", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function NouveauContactCompte(Compte $compte,Request $request): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
       

        if ($form->isSubmitted() && $form->isValid()) {
            $postData = $request->request->get('contact');
            $fonction_id = $postData['fonction'];
            $tel = $postData['tel'];
            $email = $postData['email'];
            $profilid = $postData['profil'];
            $profil=$this->getDoctrine()->getRepository(Profils::class)->findOneBy(['id'=>$profilid]);

            $fonction=$this->getDoctrine()->getRepository(Fonction::class)->findOneBy(['id'=>$fonction_id]);
            $contact->setResponsableContact($this->getUser());
            $contact->setType(1);
            $contact->setIsPartenaire(0);
            $contact->setisActive(0);
            $contact->setDateCreation(new \DateTimeImmutable());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);

            $carteVisite = new CarteVisite();
            $carteVisite->setContact($contact);
            $carteVisite->setCompte($compte);
            $carteVisite->setFonction($fonction);
            $carteVisite->setTel($tel);
            $carteVisite->setEmail($email);
            $carteVisite->setProfil($profil);
            $carteVisite->setIsPrincipale(0);
            $this->getDoctrine()->getManager()->persist($carteVisite);


            $entityManager->flush();
            $this->addFlash('success', ' Nouveau contact a été créée avec succès');
            return $this->redirectToRoute('contact_detail', ['id' => $contact->getId()]);
        } else {
            return $this->render('contact/newfromcompte.html.twig', [
                'contacts' => $contact,
                'compte' =>$compte,
                'form' => $form->createView(),
            ]);
        }
    }
    
    /**
     * @Route("/comptes/doccompte/{id}", name="delete_doc_compte", methods={"GET"})
     */
    public function deletecv(Request $request, CompteData $compteData): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($compteData);
        $entityManager->flush();
        return $this->redirectToRoute('compte_detail', ['id' => $compteData->getCompte()->getId()]);
    }

     /**
     * @Route("/change_gpac/{isgpac}/{compte}", name="compte_change_gpac", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function changegpac($isgpac,Compte $compte)
    { 

        $compte->setGPAC($isgpac);
        $em=$this->getDoctrine()->getManager();
        $em->persist($compte);
        
        if($isgpac == 0){
            $message=$this->getUser()->getPrenom()." ".$this->getUser()->getNom()." a désactivé le Gpac pour le compte (".$compte->getNomCompte().")";
        }else{
            $message=$this->getUser()->getPrenom()." ".$this->getUser()->getNom()." a activé le Gpac pour le compte (".$compte->getNomCompte().")";
        }
        $log = new LogCompte();
        $log->setCommentaire($message); 
        $log->setCompte($compte);
        $log->setStatus("Gpac");
        $log->setCreePar($this->getUser());
        $log->setDateCreation(new \DateTimeImmutable());
        $em->persist($log);
        $em->flush();
        $this->addFlash('success', 'Vos modifications ont été enregistrées avec succès');
       
        return $this->redirectToRoute('compte_detail',['id'=>$compte->getId()]);
    }

    /**
     * @Route("/change_status/{status}/{compte}", name="compte_change_status_cp", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function changestatuscompte($status,Compte $compte)
    { 
        $etatcompte = $this->getDoctrine()->getRepository(EtatCompte::class)->find($status);

        $compte->setEtatCompte($etatcompte);
        $em=$this->getDoctrine()->getManager();
        $em->persist($compte);
        
        $message=$this->getUser()->getPrenom()." ".$this->getUser()->getNom()." a changé le statut du compte (".$compte->getNomCompte().") à ".$etatcompte->getNom();

        $log = new LogCompte();
        $log->setCommentaire($message); 
        $log->setCompte($compte);
        $log->setStatus($etatcompte->getNom());
        $log->setCreePar($this->getUser());
        $log->setDateCreation(new \DateTimeImmutable());
        $em->persist($log);
        $em->flush();
        $this->mailer->sendMail($this->getUser()->getEmail(),$message,"le compte : ".$compte->getNomCompte()." (Changement Status)");
        $this->addFlash('success', 'Vos modifications ont été enregistrées avec succès');

        return $this->redirectToRoute('compte_detail',['id'=>$compte->getId()]);
    }

    

    
}
