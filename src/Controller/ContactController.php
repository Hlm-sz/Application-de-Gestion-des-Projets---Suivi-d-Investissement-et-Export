<?php

namespace App\Controller;

use App\Domain\SecteurDomain;
use App\Entity\Canal;
use App\Entity\LogCompte;
use App\Entity\LogProjet;
use App\Entity\CompteData;
use App\Entity\TinyJournal;
use App\Entity\CarteVisite;
use App\Entity\Compte;
use App\Entity\Pays;
use App\Entity\Role;
use App\Entity\Groupe;
use App\Entity\Event;
use App\Entity\User;
use App\Entity\TypeCompte;
use App\Entity\Contact;
use App\Entity\Fonction;
use App\Entity\ProjetsData;
use App\Entity\ContactData;
use App\Entity\Ville;
use App\Entity\EcosystemeFiliere;
use App\Entity\EtatCompte;
use App\Entity\Import;
use App\Entity\Profils;
use App\Entity\Secteur;
use App\Entity\Projets;
use App\FiltreData\ContactFiltre;
use App\Form\CarteVisiteType;
use App\Form\ContactCarteVisiteType;
use App\Form\ContactCollectionType;
use App\Form\ContactFiltreType;
use App\Form\ContactImportType;
use App\Form\ContactType;
use App\Form\ContactDataType;
use App\Services\Form\CreateForm;
use App\Utils\Workflow\CompteWorkflowHandler;
use App\Utils\GenerateForm;
use App\Utils\Uploader\FileUploader;
use App\Repository\ContactRepository;
use App\Repository\CompteRepository;
use App\Repository\ImportRepository;
use App\Services\Mailer\Mailer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Shared\File;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Validator\Constraints\File as ConstraintsFile;
use Symfony\Component\Validator\Constraints\FileValidator;
use Symfony\Contracts\Translation\TranslatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Security\Core\Security as atom;
 

// Include PhpSpreadsheet required namespaces
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as wr;

/**
 * @Route("/contact")
 */
class ContactController extends AbstractController
{

    private $user;
    public function __construct(atom $security)
    {
        $this->user=$security;
    }

    /**
     * @Route("/amdie/site/{id}", name="contact_site_amdie", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function site(int $id = null, Request $request, SecteurDomain $secteurDomain, ContactRepository $contactRepository): Response
    {
        $secteur = null;
        if ($id) {
            $secteur = $this->getDoctrine()->getRepository(Secteur::class)->findOneBy(['id' => $id]);
            $secteurs = $this->getDoctrine()->getRepository(Secteur::class)->findBy(['id' => $id]);;
        } else {
            $secteurs = $secteurDomain->getSecteurByUser();
        }
        $count = 0;
        foreach ($secteurs as $key => $_secteur) {
            $contacts = $contactRepository->contatSiteWebAmdie($_secteur->getNom());
            if ($contacts) {
                //  $count=+count($contacts);
                $_secteur->contacts = $contactRepository->contatSiteWebAmdie($_secteur->getNom());
                $count = $count + count($contactRepository->contatSiteWebAmdie($_secteur->getNom()));
            } else {
                unset($secteurs[$key]);
            }
        }
        //dd($count);
        return $this->render('contact/site_amdie/index.html.twig', [
            'secteurs' => $secteurs,
            'listeSecteurs' => $secteurDomain->getSecteurByUser(),
            'secteur_active' => $secteur,
        ]);
    }

    /**
     * @Route("/modelcsv", name="contact_model_csv", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function modelCSV(ContactRepository $contactRepository): Response
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $num = 1;
        $sheet->setCellValue('A' . $num, 'Prénom');
        $sheet->setCellValue('B' . $num, 'Nom');
        $sheet->setCellValue('C' . $num, 'Email');
        $sheet->setCellValue('D' . $num, 'Tel');
        $sheet->setCellValue('E' . $num, 'Exclusif (0/1)');
        $sheet->setCellValue('F' . $num, 'Langue principale');
        $sheet->setCellValue('G' . $num, 'Langue secondaire');
        $sheet->setCellValue('H' . $num, 'Profil');
        $sheet->setCellValue('I' . $num, 'Organisation');
        $sheet->setCellValue('J' . $num, 'Fonction');
        $sheet->setCellValue('K' . $num, 'Canal');

        $filename = 'model_contact.xlsx';
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
     * @Route("/DataContacts/{id}", name="contacts_data", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function dataContacts(Import $import, Request $request)
    {

        $contacts = new ArrayCollection();
        $form = $this->createForm(ContactCollectionType::class, null, array('objects' => $contacts));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ids_contacts = [];
            $contacts = $request->request->get('contact_collection')['contacts'];
            $em = $this->getDoctrine()->getManager();
            foreach ($contacts as $contact_form) {
                $exclusif = 0;
                if (isset($contact_form['exclusif'])) {
                    $exclusif = 1;
                }
                $contact = new Contact();
                $contact->setNom($contact_form['nom']);
                $contact->setPrenom($contact_form['prenom']);
                $contact->setEmail($contact_form['email']);
                $contact->setTel($contact_form['tel']);
                $contact->setExclusif($exclusif);
                $contact->setCreePar($this->getUser());
                $contact->setLangugePrincipale($contact_form['langugePrincipale']);
                $contact->setLangueSecondaire($contact_form['langueSecondaire']);
                $contact->setDetailsLibres($contact_form['detailsLibres']);
                $fonction = $this->getDoctrine()->getRepository(Fonction::class)->findOneBy(['id' => $contact_form['fonction']]);
                $contact->setFonction($fonction);
                $profile = $this->getDoctrine()->getRepository(Profils::class)->findOneBy(['id' => $contact_form['profil']]);
                $contact->setProfil($profile);
                // $contact->setOrganisation($contact_form['organisation']);
                $caneux = $this->getDoctrine()->getRepository(Canal::class)->findOneBy(['id' => $contact_form['canal']]);
                $contact->setCanal($caneux);
                $contact->setType("1");
                $contact->setIsPartenaire("0");
                $contact->setIsActive("0");
                $contact->setResponsableContact($this->getUser());
                $contact->setDateCreation(new \DateTimeImmutable());

                $em->persist($contact);
                $em->flush();
                array_push($ids_contacts, $contact->getId());
            }
            if ($ids_contacts) {
                $import->setIdsObjects(json_encode($ids_contacts));
                $import->setIsValider(true);
                $em->persist($import);
                $em->flush();
            }
            $this->addFlash('success', 'Ce fichier a été importé avec succès');
            return $this->redirectToRoute('contact_importer');
        } 

        return $this->render(
            'contact/object.html.twig', 
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/importer", name="contact_importer", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function import(Request $request, EntityManagerInterface $em, ImportRepository $importRepository): Response
    {
        $objects = new ArrayCollection();
        $form = $this->createForm(ContactImportType::class);
        $imports = $importRepository->getImports('Contact', $this->getUser()->getId());
        foreach ($imports as $key => $import) {
            $imports[$key]['is_carte_viste'] = 0;
            foreach (json_decode($import['ids_objects']) as $contact) {
                $carte_visite = $this->getDoctrine()->getRepository(CarteVisite::class)->findOneBy(['contact' => $contact]);
                if ($carte_visite) {
                    $imports[$key]['is_carte_viste'] = 1;
                    break;
                }
            }
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $form->getData()['file'];
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
                        $cellIterator->setIterateOnlyExistingCells(TRUE);
                        $contact = (new Contact());
                        
                        foreach ($cellIterator as $key => $cell) {
                            $getValue = $cell->getValue();
                            if ($key == "A") {
                                if($getValue){
                                    $contact->setPrenom($getValue);    
                                }
                            } else if ($key == "B") {
                                if($getValue){
                                    $contact->setNom($getValue);
                                }
                            } else if ($key == "C") {
                                if($getValue){
                                    $contact->setEmail($getValue);
                                }
                            } else if ($key == "D") {
                                if($getValue){
                                    $contact->setTel($getValue);
                                }
                            } else if ($key == "E") {
                                if($getValue){
                                    $contact->setExclusif($getValue);
                                }
                            } else if ($key == "F") {
                                if($getValue){
                                    $contact->setLangugePrincipale($getValue);
                                }
                            } else if ($key == "G") {
                                if($getValue){
                                    $contact->setLangueSecondaire($getValue);
                                }
                            } else if ($key == "I") {
                                if($getValue){
                                    $profile = $this->getDoctrine()->getRepository(Fonction::class)->findOneBy(['nom' => $getValue]);
                                    $contact->setFonction($profile);     
                                }else{
                                    $defaultfonction = $this->getDoctrine()->getRepository(Fonction::class)->findOneBy(['nom' => "Autre"]);
                                        if($defaultfonction){
                                            $contact->setFonction($defaultfonction);
                                        }
                                }
                            } else if ($key == "J") {
                                if ($getValue) {
                                    $caneux = $this->getDoctrine()->getRepository(Canal::class)->findOneBy(['nom' => $getValue]);
                                    $contact->setCanal($caneux);
                                }else{
                                    $caneux = $this->getDoctrine()->getRepository(Canal::class)->findOneBy(['id' => 12]);
                                    $contact->setCanal($caneux);
                                }
                            } else if ($key == "H") {
                                if ($getValue != "") {
                                    $profile = $this->getDoctrine()->getRepository(Profils::class)->findOneBy(['nom' => $getValue]);
                                    $contact->setProfil($profile);
                                    if ($profile) {
                                        $contact->setProfil($profile);
                                    } else {
                                        $defaultprofile = $this->getDoctrine()->getRepository(Profils::class)->findOneBy(['nom' => "Compte"]);
                                        $contact->setProfil($defaultprofile);
                                    }
                                }
                               
                            }
                        }
                        if (!$objects->contains($contact) && $contact->getNom() != ""){
                            $objects->add($contact);
                        }
                    }
                    if (!$objects->isEmpty()) {
                        $import = new Import();
                        $import->setDateCreation(new \DateTimeImmutable());
                        $import->setCreePar($this->getUser());
                        $import->setObject('Contact');
                        $import->setFile($brochureFile->getClientOriginalName());
                        $em->persist($import);
                        $em->flush();
                        $form_contacts = $this->createForm(ContactCollectionType::class, null, array('objects' => $objects, 'action' => $this->generateUrl('contacts_data', ['id' => $import->getId()])));
                        return $this->render(
                            'contact/object.html.twig',
                            ['form' => $form_contacts->createView()]
                        );
                    }
                }

            } catch (\Throwable $th) {
               
                $this->addFlash(
                    'danger',
                    'Problème d\'en coordonner de contact'
                );
            }
        }
        
        return $this->render(
            'contact/import.html.twig',
            [
                'form' => $form->createView(),
                'imports' => $imports
            ]
        );
    }
     /**
     * @Route("/export", name="contact_export", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function exporttoexcel(Request $request,contactRepository $contactRepository): Response
    {

        $contact = new Contact();
        $data=new ContactFiltre();
        $form = $this->createForm(ContactFiltreType::class, $data);
        $form->handleRequest($request);
        
        $contacts = $contactRepository->findContact($data);
        $spreadsheet = new Spreadsheet();        
        $sheet = $spreadsheet->getActiveSheet();
        $num=1;
        $sheet->setCellValue('A'.$num, 'Prénom');
        $sheet->setCellValue('B'.$num, 'Nom');
        $sheet->setCellValue('C'.$num, 'Profil');
        $sheet->setCellValue('D'.$num, 'Canal');
        $sheet->setCellValue('E'.$num, 'Exclusif');
        $sheet->setCellValue('F'.$num, 'Langue principale');
        $sheet->setCellValue('G'.$num, 'Langue secondaire');
        $sheet->setCellValue('H'.$num, 'Résponsable Compte');
        $sheet->setCellValue('I'.$num, 'Details Libres');      
        $sheet->setCellValue('J'.$num, 'Date de création');       
        $sheet->setCellValue('K'.$num, 'Email');        
 

        $n = 1;
         foreach($contacts as $row){
            $rowNum = $n + 1;
            if($row->getResponsableContact()){
                $profil = $row->getResponsableContact()->getNom().' '.$row->getResponsableContact()->getPrenom();
            }else{
                $profil = "";
            }
            $im = $row->getExclusif();
            $sheet->setCellValue('A'.$rowNum, $row->getPrenom());
            $sheet->setCellValue('B'.$rowNum, $row->getNom());
            $sheet->setCellValue('C'.$rowNum, $row->getProfil()->getNom());
            $sheet->setCellValue('D'.$rowNum, $row->getCanal()->getNom());
            $sheet->setCellValue('E'.$rowNum, $im ?'Exclusif':'Non exclusif');
            $sheet->setCellValue('F'.$rowNum, $row->getLangugePrincipale());
            $sheet->setCellValue('G'.$rowNum, $row->getLangueSecondaire());
            $sheet->setCellValue('H'.$rowNum, $profil);
            $sheet->setCellValue('I'.$rowNum, $row->getDetailsLibres());
            $sheet->setCellValue('J'.$rowNum, $row->getDateCreation());
            $sheet->setCellValue('K'.$rowNum, $row->getEmail());


            $n++;
        }
        // Create your Office 2007 Excel (XLSX Format)
        $writer = new wr($spreadsheet);
        // Create a Temporary file in the system
        $fileName = 'Contacts-'.time().'.xlsx';
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
     * @Route("/", name="contact_index", methods={"GET"})
     * @Security("is_granted('CONSULTER_CONTACT')")
     */
    // public function index(ContactRepository $contactRepository, Request $request): Response
    // {
    //     $data = new ContactFiltre();
    //     $form = $this->createForm(ContactFiltreType::class, $data);
    //     $form->handleRequest($request);
    //     $contacts = $contactRepository->findContact($data);
    //     // $this->denyAccessUnlessGranted('CONSULTER_CONTACT', $contacts[0]);

    //     return $this->render('contact/index.html.twig', [
    //         // 'contacts' => $contactRepository->findBy(['isArchived'=>false]),
    //         'form' => $form->createView(),
    //         'contacts' => $contacts
    //     ]);
    // }
    public function index(int $id=null,Request $request,ContactRepository $contactRepository): Response
{
    $data=new ContactFiltre();
    $form = $this->createForm(ContactFiltreType::class, $data);
    $form->handleRequest($request);

    $contact = new Contact();

    $restrictions=$this->getUser()->getGroupe()->getRestrictions();
    $search=null;
    if($request->get('search')){
        $search=$request->get('search');
    }
    $contacts = $contactRepository->findContact($data);
    $rests = [];
    foreach ($restrictions as $restriction){
        if($restriction->getId() != 1 && $restriction->getId() != 6 && $restriction->getId() != 7 && $restriction->getId() != 8){
            
            array_push($rests,$restriction->getId());
        }
    }
    // if($restrictions){
    //      foreach ($restrictions as $restriction){
    //         switch ($restriction->getId()) {
    //             case 5:
    //                 $contacts = $contactRepository->getContactNonExclusives();
    //                 break;
    //         }
    //     }
    // }else{
    //     $contacts = $contactRepository->findContact($data);
    // }
    
    if($rests == [2,5]){
        $contacts = $contactRepository->findExclusifContact($data,$this->getUser()->getId());
    }elseif($rests == [5]){
        $contactsNoEX= $contactRepository->findNoExclusifContact($data);
        $contactsEX = $contactRepository->findExclusifContact($data,$this->getUser()->getId());
        $contacts = array_merge($contactsNoEX,$contactsEX);

    }else{
        $contacts = $contactRepository->findContact($data);

    }

    return $this->render('contact/index.html.twig', [
        // 'contacts' => $contactRepository->findBy(['isArchived'=>false]),
        'form' => $form->createView(),
        'contacts' => $contacts,
        'contact' => $contact
    ]);
}

    /**
     * @Route("/filtre", name="contact_filtre", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function filtre(Request $request, ContactRepository $contactRepository): Response
    {
        //     $telecharger=$request->query->get('telecharger')==1?1:0;
        //     if($request->query->get('telecharger')==1){
        //     }
        $restrictions=$this->user->getUser()->getGroupe()->getRestrictions();
        $rests = [];
        foreach ($restrictions as $restriction){
            if($restriction->getId() != 1){
                
                array_push($rests,$restriction->getId());
            }
        }
        $data = new ContactFiltre();
        $form = $this->createForm(ContactFiltreType::class, $data);
        $form->handleRequest($request);
        if($rests == [2,5]){
            $contacts = $contactRepository->findExclusifContact($data,$this->getUser()->getId());
        }elseif($rests == [5]){
            $contacts = $contactRepository->findNoExclusifContact($data);
        }else{
            $contacts = $contactRepository->findContact($data);
        }

        // if($rests == [5]){
        //     $contacts = $contactRepository->findContact($data);
        // }else{
        //     $contacts = $contactRepository->findNoExclusifContact($data);
        // }
        // if($telecharger==1){
        //     $contacts=$this->telecharger($contacts);
        //     $request->query->remove('telecharger');
        // }

        return $this->render('contact/filtre/index.html.twig', [
            'form' => $form->createView(),
            'contacts' => $contacts,
        ]);
    }

    private function telecharger($contacts)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $num = 1;
        $sheet->setCellValue('A' . $num, 'Prénom');
        $sheet->setCellValue('B' . $num, 'Nom');
        $sheet->setCellValue('C' . $num, 'Email');
        $sheet->setCellValue('D' . $num, 'Tél');
        $sheet->setCellValue('E' . $num, 'Exclusif');
        $sheet->setCellValue('F' . $num, 'Profil');
        $sheet->setCellValue('G' . $num, 'Canal');
        $sheet->setCellValue('H' . $num, 'Languge Principale');
        $sheet->setCellValue('I' . $num, 'Langue Secondaire');

        $n = 1;
        foreach ($contacts as $row) {
            $rowNum = $n + 1;
            $sheet->setCellValue('A' . $rowNum, $row->getPrenom());
            $sheet->setCellValue('B' . $rowNum, $row->getNom());
            $sheet->setCellValue('C' . $rowNum, $row->getEmail());
            $sheet->setCellValue('D' . $rowNum, $row->getTel());
            $sheet->setCellValue('E' . $rowNum, $row->getExclusif());
            $sheet->setCellValue('F' . $rowNum, $row->getProfil()->getNom());
            $sheet->setCellValue('G' . $rowNum, $row->getCanal()->getNom());
            $sheet->setCellValue('H' . $rowNum, $row->getLangugePrincipale());
            $sheet->setCellValue('I' . $rowNum, $row->getLangueSecondaire());
            $n++;
        }

        $filename = 'Contacts-' . time() . '.xlsx';
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
     * @Route("/archive", name="contact_archive", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function archive(ContactRepository $contactRepository): Response
    {
        return $this->render('contact/archive.html.twig', [
            'contacts' => $contactRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contact_new", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function new(Request $request): Response
    {
        $contact = new Contact();
        $this->denyAccessUnlessGranted('CREATION_DE_CONTACT', $contact);

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        $carteVisite = $this->getDoctrine()->getRepository(CarteVisite::class)->findBy(['contact' => $contact->getId()]);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setResponsableContact($this->getUser());
            $contact->setType(1);
            $contact->setIsPartenaire(0);
            $contact->setisActive(0);
            $contact->setCreePar($this->getUser());
            $contact->setDateCreation(new \DateTimeImmutable());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            $this->addFlash('success', 'La nouvelle contact a été créée avec succès');
            return $this->redirectToRoute('contact_detail', ['id' => $contact->getId()]);
        } else {
            return $this->render('contact/new.html.twig', [
                'contacts' => $contact,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}/show", name="contact_show", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function show(Contact $contact, Request $request): Response
    {
        $carteVisite = $this->getDoctrine()->getRepository(CarteVisite::class)->findBy(['contact' => $contact->getId()]);

        return $this->render('contact/details.html.twig', [
            'contact' => $contact,
            'cartes_visite' => $carteVisite
        ]);
    }
    /**
     * @Route("/{id}/detail", name="contact_detail", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function detail(Contact $contact, Request $request): Response
    {
        $listid=[];
        $carteVisite = $this->getDoctrine()->getRepository(CarteVisite::class)->findBy(['contact' => $contact->getId()]);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        $comptes = $this->getDoctrine()->getRepository(Compte::class)->findAll();
        $secteurs = $this->getDoctrine()->getRepository(Secteur::class)->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $postData = $request->request->get('contact');
            $fonction_id = $postData['fonction'];
            $tel = $postData['tel'];
            $email = $postData['email'];
            $profilid = $postData['profil'];
            $profil=$this->getDoctrine()->getRepository(Profils::class)->findOneBy(['id'=>$profilid]);

            $fonction=$this->getDoctrine()->getRepository(Fonction::class)->findOneBy(['id'=>$fonction_id]);

            $organisation = $request->request->get('organisation');
            $compte = $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['id' => $organisation]);
            
            foreach($carteVisite as $carte){
                array_push($listid,$carte->getCompte()->getId());
            }
            if($compte){
                if (!in_array($compte->getId(), $listid)){
                    $carteVisite = new CarteVisite();
                    $carteVisite->setContact($contact);
                    $carteVisite->setCompte($compte);
                    $carteVisite->setFonction($fonction);
                    $carteVisite->setTel($tel);
                    $carteVisite->setEmail($email);
                    $carteVisite->setProfil($profil);
                    $carteVisite->setIsPrincipale(0);
                    $contact->setIsActive(1);
                    $this->getDoctrine()->getManager()->persist($contact);
                    $this->getDoctrine()->getManager()->persist($carteVisite);
                }
            }

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Ce contact a été modifiée avec succès');
            return $this->redirectToRoute('contact_detail', ['id' => $contact->getId()]);
        }
        return $this->render('contact/show.html.twig', [
            'contact' => $contact,
            'cartes_visite' => $carteVisite,
            'comptes' => $comptes,
            'secteurs' => $secteurs,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/{id}/carte/visite", name="new_carte_visite", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function newCarteVisite(Request $request, Contact $contact, CompteRepository $cr): Response
    {
        $carteVisite = new CarteVisite();
        $form = $this->createForm(CarteVisiteType::class, $carteVisite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $carteVisite->setContact($contact);
            $carteVisite->setIsPrincipale(0);
            $entityManager->persist($carteVisite);
            $entityManager->flush();
            return $this->redirectToRoute('contact_detail', ['id' => $contact->getId()]);
        }

        return $this->render('carte_visite/new.html.twig', [
            'carte_visite' => $carteVisite,
            'form' => $form->createView(),
            'partenaires' => $cr->findBy(array( 
                'type'=> [4]
            )),
            'comptes' => $cr->findBy(array(
                'type'=> [1,2,3]
            ))
        ]);
    }


    /**
     * @Route("/handleSearch/{_query?}", name="handle_search", methods={"POST", "GET"})
     */
    public function handleSearchRequest(Request $request, $_query)
    {
        $em = $this->getDoctrine()->getManager();

        if ($_query) {
            $data = $em->getRepository(Compte::class)->findByName($_query);
        } else {
            $data = $em->getRepository(Compte::class)->findAll();
        }

        //   return $this->json(
        //   $data
        // , 200, [], ['groups' => ['main']]);

        // iterate over all the resuls and 'inject' the image inside
        for ($index = 0; $index < count($data); $index++) {
            $object = $data[$index];
            // http://via.placeholder.com/35/0000FF/ffffff
            $object->setLogo("http://via.placeholder.com/35/0000FF/ffffff");
        }
        // dd($data);

        // setting up the serializer
        $normalizers = [
            new ObjectNormalizer()
        ];

        $normalizer = new ObjectNormalizer();
        // $normalizer->setIgnoredAttributes(array('Pays'));
        $encoders =  [
            new JsonEncoder()
        ];

        $serializer = new Serializer([$normalizer], $encoders);

        $data = $serializer->serialize($data, 'json', ['ignored_attributes' => ['events', 'compteData', 'modifiePar', 'creePar', 'contact', 'centreDecision', 'ecosystemeFiliere', 'projets', 'type', 'secteurs', 'carteVisites', 'etatCompte', 'responsableCompte', 'paysImplantationSuccursales', 'paysSiege']]);
        // $data=json_encode($data);
        return new JsonResponse($data, 200, [], true);
    }

    /**
     * @Route("/autocomplete", name="city_autocomplete")
     */
    public function autocompleteAction(Request $request)
    {
        $names = array();
        $term = trim(strip_tags($request->get('term')));

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository(Compte::class)->createQueryBuilder('c')
            ->where('c.nomCompte LIKE :name')
            ->setParameter('name', '%' . $term . '%')
            ->getQuery()
            ->getResult();

        foreach ($entities as $entity) {
            $names[$entity->getId()] = $entity->getNomCompte();
            // $names['id'] = $entity->getId();
        }

        $response = new JsonResponse();
        $response->setData($names);

        return $response;
    }

    /**
     * @Route("/compte/{id?}", name="compte_page", methods={"GET"})
     */
    public function compteSingle(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $city = null;

        if ($id) {
            $city = $em->getRepository(Compte::class)->findOneBy(['id' => $id]);
        }

        return $this->render('contact/compte.html.twig', [
            'city'  =>      $city
        ]);
    }

    /**
     * @Route("/ajax_contact", name="ajax_contact", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function ajaxListsContact(ContactRepository $contactRepository, TranslatorInterface $translator)
    {
        $data = array();

        $contacts = $contactRepository->findBy(['isArchived' => false]);
        foreach ($contacts as $contact) {

            $edit = $this->generateUrl('contact_edit', [
                'id' => $contact->getId(),
            ]);
            $afficher = $this->generateUrl('contact_show', [
                'id' => $contact->getId(),
            ]);
            $carteVisite = $this->generateUrl('new_carte_visite', [
                'id' => $contact->getId(),
            ]);
            $actions = '<a class="dropdown-item" href=' . $afficher . '><i class="fa fa-eye"></i> ' . $translator->trans('compte.Show') . '</a>
            <a class="dropdown-item" href=' . $edit . '><i class="fa fa-edit"></i> ' . $translator->trans('compte.Edit') . '</a>
            <a class="dropdown-item" href=' . $carteVisite . '><i class="fa fa-plus"></i> Carte visite </a>';

            $liste_actions = '<div class="dropdown">
            <button class="btn btn-btn-blue dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Actions
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">' .
                $actions
                . '</div>
            </div>';

            $data[] = array(
                "prenom" => $contact->getPrenom(),
                "nom" => $contact->getNom(),
                "tel" => $contact->getTel(),
                "email" => $contact->getEmail(),
                "statut" => $contact->getStatut(),
                "profil" => $contact->getProfil()->getNom(),
                "exclusif" => $contact->getExclusif() ? 'Oui' : 'Non',
                "canal" => $contact->getCanal()->getNom(),
                "langue_principale" => $contact->getLangugePrincipale(),
                "langue_secondaire" => $contact->getLangueSecondaire(),
                "actions" => $liste_actions
            );
        }

        $output = array(
            "TotalRecords" => count($contacts),
            "TotalDisplayRecords" => 10,
            "data" => $data,
        );

        return new Response(json_encode($output));
    }

    /**
     * @Route("/ajax_contact_archive", name="ajax_contact_archive", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function ajaxListsContactArchive(ContactRepository $contactRepository, TranslatorInterface $translator)
    {
        $data = array();

        $contacts = $contactRepository->findBy(['isArchived' => true]);
        foreach ($contacts as $contact) {

            $edit = $this->generateUrl('contact_edit', [
                'id' => $contact->getId(),
            ]);
            $afficher = $this->generateUrl('contact_show', [
                'id' => $contact->getId(),
            ]);
            $actions = '<a class="btn btn-btn-blue" href=' . $afficher . '><i class="fa fa-eye"></i> ' . $translator->trans('compte.Show') . '</a>
            <a class="btn btn-btn-blue" href=' . $edit . '><i class="fa fa-edit"></i> ' . $translator->trans('compte.Edit') . '</a>';

            $data[] = array(
                "prenom" => $contact->getPrenom(),
                "nom" => $contact->getNom(),
                "statut" => $contact->getStatut(),
                "profil" => $contact->getProfil()->getNom(),
                "exclusif" => $contact->getExclusif() ? 'Oui' : 'Non',
                "canal" => $contact->getCanal()->getNom(),
                "langue_principale" => $contact->getLangugePrincipale(),
                "langue_secondaire" => $contact->getLangueSecondaire(),
                "actions" => $actions
            );
        }

        $output = array(
            "TotalRecords" => count($contacts),
            "TotalDisplayRecords" => 10,
            "data" => $data,
        );

        return new Response(json_encode($output));
    }


    /**
     * @Route("/{id}/edit", name="contact_edit", methods={"GET","POST"})
     * @Security("is_granted('MODIFIER_LE_CONTACT')")
     */
    public function edit(Contact $contact, Request $request, CreateForm $buildForm, EntityManagerInterface $em, FileUploader $fileUploader): Response
    {

        $entityname = 'contact';
        $form_fields = $buildForm->createFrom(
            [
                'type_form' => $contact->getType(),
                'form' => ContactDataType::class,
                'fields' => [1],
                'path' => 'forms-contact.yml'
            ],
            ContactData::class,
            ['compte' => $contact->getId()],
            $entityname
        );
        $form = $this->createForm(ContactType::class, $contact, array("schema_form" => $form_fields), $entityname);
        // $carteVisite = $this->getDoctrine()->getRepository(CarteVisite::class)->findBy(['contact' => $contact->getId()]);
        // $form = $this->createForm(ContactCarteVisiteType::class, $contact);
        $carteVisite = $this->getDoctrine()->getRepository(CarteVisite::class)->findBy(['contact' => $contact->getId()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Cette contact a été modifiée avec succès');
            return $this->redirectToRoute('contact_index');
        }
        return $this->render('contact/edit.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
            // 'cartes_visite' => $carteVisite
        ]);
    }

    /**
     * @Route("/{id}", name="contact_delete", methods={"DELETE"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function delete(Request $request, Contact $contact): Response
    {
        if ($this->isCsrfTokenValid('delete' . $contact->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            // $contact->setIsArchived(true);
            // $entityManager->persist($contact);
            // $entityManager->flush();
            $cartevisites = $this->getDoctrine()->getRepository(CarteVisite::class)->getCarteVistesByContact($contact);
            if($cartevisites){
                foreach($cartevisites as $carte){
                    $entityManager->remove($carte);
                }
            }
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contact_index');
    }

    /**
     * @Route("/change_part/{ispart}/{contact}", name="contact_change_part", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function changepart($ispart, Contact $contact)
    {
        $contact->setIsPartenaire($ispart);
        if($ispart ==1){
            $profil = $this->getDoctrine()->getRepository(Profils::class)->findBy(['id' => 2]);
            $contact->setProfil($profil[0]);
        }else{
            $profil = $this->getDoctrine()->getRepository(Profils::class)->findBy(['id' => 1]);
            $contact->setProfil($profil[0]);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($contact);
        $em->flush();
        return $this->redirectToRoute('contact_detail', ['id' => $contact->getId()]);
    }
    private function setDataForm(&$form_fields, $table, $object)
    {
        foreach ($form_fields as &$field) {
            $options = $field["options"];
            $name = $field["name"];
            $type = $field["type"];
            $dataProject = $this->getDoctrine()->getRepository($table)->findOneBy(['contact' => $object->getId(), 'cle' => $name]);
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
            } else {
                $field["options"]["data"] = $options_data;
            }
        }
    }
    /**
     * @Route("/generate/pdf/{id}", name="contact_pdf", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function generatePdf(Pdf $pdf, Contact $contact, Request $request, FileUploader $fileUploader, EntityManagerInterface $em): Response
    {

        $carteVisite = $this->getDoctrine()->getRepository(CarteVisite::class)->findBy(['contact' => $contact->getId()]);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        $comptes = $this->getDoctrine()->getRepository(Compte::class)->findAll();

        // return $this->render('contact/pdf/pdf.html.twig', [
        //     'contact' => $contact, 
        //     'cartes_visite' => $carteVisite,
        //     'data' =>   array("cartes_visite" => $carteVisite,"comptes" => $comptes),
        //     'form' => $form->createView(),
        // ]);
        $url = "contact/pdf/pdf.html.twig";

        $html = $this->renderView($url, [
            'contact' => $contact,
            'data' =>   array("cartes_visite" => $carteVisite),
            'form' => $form->createView(),
        ]);
        return new PdfResponse(
            $pdf->getOutputFromHtml($html),
            $contact->nomcomplet().'.pdf'
        );
    }
    /**
     * @Route("/change_activation/{isactive}/{contact}", name="contact_change_activation", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function changeactivation($isactive, Contact $contact)
    {
        $contact->setIsActive($isactive);
        $em = $this->getDoctrine()->getManager();
        $em->persist($contact);
        $em->flush();
        return $this->redirectToRoute('contact_detail', ['id' => $contact->getId()]);
    }
    /**
     * @Route("/change_exlusif/{isexlusif}/{contact}", name="contact_change_exlusif", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function changeexlusif($isexlusif, Contact $contact)
    {
        $contact->setExclusif($isexlusif);
        $em = $this->getDoctrine()->getManager();
        $em->persist($contact);
        $em->flush();
        return $this->redirectToRoute('contact_detail', ['id' => $contact->getId()]);
    }
    /**
     * @Route("/delete_carte/", name="carte_activation", methods={"POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function changecarte($isactive, Contact $contact,CarteVisite $carteVisite)
    {
        $carteVisite->setIsActive($isactive);
        $em = $this->getDoctrine()->getManager();
        $em->persist($carteVisite);
        $em->flush();
        return $this->redirectToRoute('contact_detail', ['id' => $contact->getId()]);
    }

    /**
     * @Route("/cartedelete/{id}", name="delete_carte_visite", methods={"GET"})
     */
    public function deletecv(Request $request, CarteVisite $carteVisite): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($carteVisite);
        $entityManager->flush();
        return $this->redirectToRoute('contact_detail', ['id' => $carteVisite->getContact()->getId()]);
    }

    /**
     * @Route("/contact_activation/", name="contact_activation", methods={"GET","POST"})
     *
     */
    public function contactactivation(Request $request): Response
    {

        $newcompte = new Compte();
        $carteVisite = new CarteVisite();
        $type = $this->getDoctrine()->getRepository(TypeCompte::class)->find(1);
        $etatcompte = $this->getDoctrine()->getRepository(EtatCompte::class)->find(1);


        $comptename = $request->request->get('nomcompte');
        $contact_id = $request->request->get('cid');

        $newcompte->setNomCompte($comptename);
        $newcompte->setCategorie(0);
        $newcompte->setType($type);
        $newcompte->setEtatCompte($etatcompte);

        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($contact_id);
        $contact->setIsActive(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($newcompte);
        $em->persist($contact);

        $carteVisite->setContact($contact);
        $carteVisite->setCompte($newcompte);
        $carteVisite->setFonction("");
        $carteVisite->setTel("");
        $carteVisite->setIsPrincipale(0);

        $em->persist($carteVisite);
        $em->flush();
        //return $this->redirectToRoute('compte_detail', ['id' => $newcompte->getId()]);
        return new JsonResponse(["compte_id" => $newcompte->getId()]);
    }
    /**
     * @Route("/contact_attribuer/", name="contact_attribuer", methods={"GET","POST"})
     *
     */
    public function contactattribuer(Request $request,CompteWorkflowHandler $pwh): Response
    {

        $nomCompte = $request->request->get('nomCompte');
        $compte_type = $request->request->get('compte_type');
        $secteud_id = $request->request->get('secteur');
        $etat_id = $request->request->get('etat');


        $contact_id = $request->request->get('cid');
        $type=$this->getDoctrine()->getRepository(TypeCompte::class)->findOneBy(['id'=>$compte_type]);
        $contact=$this->getDoctrine()->getRepository(Contact::class)->findOneBy(['id'=>$contact_id]);
        $secteur=$this->getDoctrine()->getRepository(Secteur::class)->findOneBy(['id'=>$secteud_id]);
        $etatCompte=$this->getDoctrine()->getRepository(EtatCompte::class)->findOneBy(['id'=>$etat_id]);
        $contact->setIsActive(1);
        
        $compte = new Compte();

        $compte->setCreePar($this->getUser());
        $compte->setNomCompte($nomCompte);
        $compte->setType($type);
        $compte->setEtatCompte($etatCompte);
        $compte->setCategorie(1);
        $compte->setSignalement(false);
        $compte->setIsDeleted(false);
        
        $em = $this->getDoctrine()->getManager();

        $compte->addSecteur($secteur);
        $em->persist($contact);
        $em->persist($compte);
        $pwh->handle($compte, $compte->getEtatCompte()->getNomConstant());
    
        $contact->setIsActive(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($contact);

        $carteVisite = new CarteVisite();
        $carteVisite->setContact($contact);
        $carteVisite->setCompte($compte);
        $carteVisite->setFonction($contact->getFonction());
        $carteVisite->setTel($contact->getTel());
        $carteVisite->setEmail($contact->getEmail());
        $carteVisite->setProfil($contact->getProfil());
        $carteVisite->setIsPrincipale(0);
        $em->persist($carteVisite);
        $em->flush();
        return new JsonResponse(["compte_id" => $compte->getId()]);

         
    }
    /**
     * @Route("/listecompte/", name="liste_compte", methods={"GET","POST"})
     *
     */
    public function listecompte(Request $request): Response
    {

        $comptetype = $request->request->get('comptetype');
        if($comptetype == "48"){
            $comptes = $this->getDoctrine()->getRepository(Compte::class)->getListsPartenairesEve();
        }
        else{
            $comptes = $this->getDoctrine()->getRepository(Compte::class)->getCompteslistea();
        } 
        $contactId = $request->request->get('contact');

        // $contact = $this->getDoctrine()->getRepository(Contact::class)->find($contact_id);
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
    * @Route("/resetdatabase")
    */    
    public function resetDatabase(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Contact::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/resetdatabasecarte")
    */    
    public function resetDatabaseCarteVisite(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(CarteVisite::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/resetdatabasecontactdata")
    */    
    public function resetDatabaseContactData(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(ContactData::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/resetFonction")
    */    
    public function resetFonction(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Fonction::class);
        $entities = $repository->findAll();
        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
  
     /**
    * @Route("/updatecompte")
    */    
    public function updatecompte(EntityManagerInterface $em)
    {
         

   
        $gpac = $em->getRepository(EtatCompte::class)->findOneBy(['nom' => "Gpac"]); 
 
        $em->remove($gpac);
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    /**
     * @Route("/updatecommandes")
     */
    public function updatecommandes(EntityManagerInterface $em,Mailer $mailer){

        $comptes = $em->getRepository(Compte::class)->findAll();
        foreach($comptes as $compte){
            $projetsIn = $em->getRepository(Projets::class)->getListeProjetByCompteIN($compte);
            $projetsDe = $em->getRepository(Projets::class)->getListeProjetByCompteDE($compte);
            $projetsFe = $em->getRepository(Projets::class)->getListeProjetByCompteFer($compte);

           if (count($projetsIn)>0){
            $getEtatCompte = $em->getRepository(EtatCompte::class)->findOneBy(['id'=>10]);
             $compte->setEtatCompte($getEtatCompte);
             $em->persist($compte);
             $em->flush();
             $mailer->sendMail($compte->getResponsableCompte()->getEmail(),"le compte ".$compte->getNomCompte()." change statut à Intérêt ","Changement de statut");
           }elseif(count($projetsDe)>0){
            $getEtatCompte = $em->getRepository(EtatCompte::class)->findOneBy(['id'=>11]);
            $compte->setEtatCompte($getEtatCompte);
             $em->persist($compte);
             $em->flush();
             $mailer->sendMail($compte->getResponsableCompte()->getEmail(),"le compte ".$compte->getNomCompte()." change statut à Décision","Changement de statut");
           }elseif(count($projetsFe)>0){
            $getEtatCompte = $em->getRepository(EtatCompte::class)->findOneBy(['id'=>12]);
            $compte->setEtatCompte($getEtatCompte);
             $em->persist($compte);
             $em->flush();
             $mailer->sendMail($compte->getResponsableCompte()->getEmail(),"le compte ".$compte->getNomCompte()." change statut à Fermé","Changement de statut");
            }
            
        }
        return new Response('', Response::HTTP_OK);

    }
     /**
    * @Route("/resetprojetdata")
    */    
    public function resetprojetdata(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(ProjetsData::class);
        $entities = $repository->findBy(['cle'=> "mode_financement"]);
        
        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/resetcomptedata")
    */    
    public function resetcomptedata(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(CompteData::class);
        $entities = $repository->findBy(['cle'=> "Actionnaires"]);
        
        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/resetlogocompte")
    */    
    public function resetlogocompte(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Compte::class);
        $entities = $repository->findAll();
        
        foreach ($entities as $entity) {
            $entity->setLogo(NULL);
             $em->persist($entity);
             $em->flush();
        }

        return new Response('', Response::HTTP_OK);
    }

     /**
    * @Route("/bulkfonctions")
    */    
    public function bulkfonctions(EntityManagerInterface $em)
    {

        $bulk_list=array (
            0 => 'Vice Président',
            1 => 'Président Directeur Général',
            2 => 'Président fondateur',
            3 => 'Executive VP',
            4 => 'Directeur Général Adjoint',
            5 => 'Directeur Général',
            6 => 'Managing Director',
            7 => 'Administrateur Directeur Général',
            8 => 'Directeur commercial',
            9 => 'Directeur Communication et Coopération',
            10 => '(MD / chef de l\'exploitation)',
            11 => '(CEO - Chief Executive Officer)',
            12 => '(MD/Chief Operating Officer)',
            13 => 'Directeur Financier',
            14 => 'Manager',
            15 => 'Head',
            16 => 'Directeur des relations publiques',
            17 => 'Responsable Communication',
            18 => 'Directeur Marketing et Veille',
            19 => 'Responsable Marketing et Communication',
            20 => 'Associé',
            21 => 'Founder and Chairman',
            22 => 'Vice Chairman & Co-founder',
            23 => 'Executive Director of Generation',
        );
        $em = $this->getDoctrine()->getManager();
        foreach ($bulk_list as $liste) {
            $fonction = new Fonction();
            $fonction->setNom($liste);
            $fonction->setIsDeleted(false);
            $em->persist($fonction);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/bulkecosystemefiliere")
    */    
    public function bulkecosystemefiliere(EntityManagerInterface $em)
    {   
        $em = $this->getDoctrine()->getManager();
        $comptes = $em->getRepository(Compte::class)->findAll();
        $filieres = $em->getRepository(EcosystemeFiliere::class)->findAll();
        
        foreach($comptes as $compte){
            foreach($compte->getEcosystemeFiliere() as $fil){
                $compte->removeEcosystemeFiliere($fil);
                $em->flush();
            }
        }

        
        foreach ($filieres as $entity) {
            $em->remove($entity);
        }
        $em->flush();
        // ecosystemeFiliere
        // removeEcosystemeFiliere
        $bulk_eco=array (
            0 => 'Pièces de rechanges',
            1 => 'Câblage automobile',
            2 => 'Intérieur véhicules et siéges',
            3 => 'Métal/emboutissage',
            4 => 'Moteurs et transmission',
            5 => 'Batterie automobile',
            6 => 'Poids lourds et carosserie industrielle',
            7 => 'Assemblage d\'éléments destructure',
            8 => 'Cablage Connectique',
            9 => 'Chaudronnerie aéronautique',
            10 => 'Electricité,électronique',
            11 => 'Electricité,électronique',
            12 => 'Maintenance avions et moteurs',
            13 => 'Matériaux composites',
            14 => 'Mécanique de précisionusinage',
            15 => 'Moulage aéronautique',
            16 => 'Produits chimiques',
            17 => 'Traitement de surface',
            18 => 'Tolerie aéronautique',
            19 => 'Outillage aéronautique',
            20 => 'Réparation moteurs',
            21 => 'Traitement desdéchets',
            22 => 'Services distribution',
            23 => 'Denim',
            24 => 'Fast Fashion',
            25 => 'les Distributeur sindustriels de marques nationales',
            26 => 'Maille',
            27 => 'Textile demaison',
            28 => 'Textile à usagetechnique',
            29 => 'Chaussure',
            30 => 'Maroquinirie',
            31 => 'Vêtements en cuir',
            32 => 'Tannerie',
            33 => 'Mégisserie',
            34 => 'Valorisation fruits & légumes frais',
            35 => 'Industrie de transformation des agrumes et des fruits et légumes frais',
            36 => 'Industrie laitière',
            37 => 'Industrie des huiles alimentaires',
            38 => 'Industrie de biscuiterie,chocolaterie et confiserie',
            39 => 'Industrie des pâtes alimentaires et de couscous',
            40 => 'Industrie des viandes',
            41 => 'Industrie des boissons gaz eu ses et eau',
            42 => 'Industrie meunerie',
            43 => 'Industrie sucrière',
            44 => 'Industrie des légumes et fruits transformés',
            45 => 'Industriee de conserve de légumes & fruits',
            46 => 'Industrie de margarine et graisses alimentaires',
            47 => 'Industrie de condiments et assaisonnements',
            48 => 'Industrie de margarine et graisses alimentaires',
            49 => 'Industrie du thé et café',
            50 => 'Industrie de ssels',
            51 => 'Industrie de transformation et de valorisation des produits de la pêche',
            52 => 'Valorisation & Conditionnement de plantes aromatiques & médicinales etépices',
            53 => 'Industrie de transformation des céréales,amidonnerie et fabrication d\'aliments pour animaux',
            54 => 'Industrie des boissons alcooliques',
            55 => 'Produits du Tabacs',
            56 => 'Matériel électronique',
            57 => 'Matériel électrique',
            58 => 'Câblage',
            59 => 'Energie renouvelable',
            60 => 'Médicaments',
            61 => 'Dispositifs Médicaux',
            62 => 'Compléments alimentaires',
            63 => 'Services de santé',
            64 => 'CRM(Customer Relationship Management)',
            65 => 'BPO(Business Process Outsourcing)',
            66 => 'ITO(Information Technology Outsourcing)',
            67 => 'ESO(Engineering Service Outsourcing)',
            68 => 'KPO(Knowledge Process Outsourcing)',
            69 => 'Peintures, Encres, collesetadhésifs',
            70 => 'Produits Phytosanitaires',
            71 => 'Gaz industriel et médical',
            72 => 'Cosmétique et Produits d\'hygiène',
            73 => 'Détergents',
            74 => 'Engrais',
            75 => 'Industrie du verre',
            76 => 'Industrie métallurgique',
            77 => 'Industrie mécanique',
            78 => 'Industrie électromécanique',
            79 => 'Ciment',
            80 => 'Bois',
            81 => 'Marbre',
            82 => 'Plâtre',
            83 => 'Sable',
            84 => 'Industriedubéton',
            85 => 'Briqueterie',
            86 => 'Céramique',
            87 => 'Sidérurgie',
            88 => 'Industrie de transformation de Fil Machine',
            89 => 'Matières premières Plastique et machines pour laplasturgie',
            90 => 'Plastique des tinéau BTP',
            91 => 'Emballages en plastique',
            92 => 'Emballage Tisséen polypropylène',
            93 => 'Recyclage et de Valorisation des Déchets Plastique',
            94 => 'Abrisserres',
            95 => 'Produits plastique de grande consommation',
            96 => 'Sacs,Sachets et Filmsen Plastique',
        );
        foreach ($bulk_eco as $liste) {
            $eco = new EcosystemeFiliere();
            $eco->setNom($liste);
            $em->persist($eco);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }

    /**
    * @Route("/bulkcountry")
    */    
    public function bulkcountry(EntityManagerInterface $em)
    {

        $jayParsedAry = [
            "AF" => "Afghanistan", 
            "ZA" => "Afrique du Sud", 
            "AL" => "Albanie", 
            "DZ" => "Algérie", 
            "AD" => "Andorre", 
            "AO" => "Angola", 
            "AI" => "Anguilla", 
            "AQ" => "Antarctique", 
            "AG" => "Antigua-et-Barbuda", 
            "AN" => "Antilles néerlandaises", 
            "SA" => "Arabie saoudite", 
            "AM" => "Arménie", 
            "AW" => "Aruba", 
            "AT" => "Autriche", 
            "AZ" => "Azerbaïdjan", 
            "BS" => "Bahamas", 
            "BH" => "Bahreïn", 
            "BD" => "Bangladesh", 
            "BB" => "Barbade", 
            "BY" => "Bélarus", 
            "BZ" => "Belize", 
            "BJ" => "Bénin", 
            "BM" => "Bermudes", 
            "BT" => "Bhoutan", 
            "BO" => "Bolivie", 
            "BA" => "Bosnie-Herzégovine", 
            "BW" => "Botswana", 
            "BN" => "Brunéi Darussalam", 
            "BG" => "Bulgarie", 
            "BF" => "Burkina Faso", 
            "BI" => "Burundi", 
            "KH" => "Cambodge", 
            "CM" => "Cameroun", 
            "CV" => "Cap-Vert", 
            "EA" => "Ceuta et Melilla", 
            "CL" => "Chili", 
            "CY" => "Chypre", 
            "CO" => "Colombie", 
            "KM" => "Comores", 
            "CG" => "Congo-Brazzaville", 
            "KP" => "Corée du Nord", 
            "KR" => "Corée du Sud", 
            "CR" => "Costa Rica", 
            "CI" => "Côte d’Ivoire", 
            "HR" => "Croatie", 
            "CU" => "Cuba", 
            "DK" => "Danemark", 
            "DG" => "Diego Garcia", 
            "DJ" => "Djibouti", 
            "DM" => "Dominique", 
            "EG" => "Égypte", 
            "SV" => "El Salvador", 
            "AE" => "Émirats arabes unis", 
            "EC" => "Équateur", 
            "ER" => "Érythrée", 
            "EE" => "Estonie", 
            "VA" => "État de la Cité du Vatican", 
            "FM" => "États fédérés de Micronésie", 
            "ET" => "Éthiopie", 
            "FJ" => "Fidji", 
            "FI" => "Finlande", 
            "GA" => "Gabon", 
            "GM" => "Gambie", 
            "GE" => "Géorgie", 
            "GS" => "Géorgie du Sud et les îles Sandwich du Sud", 
            "GH" => "Ghana", 
            "GI" => "Gibraltar", 
            "GR" => "Grèce", 
            "GD" => "Grenade", 
            "GL" => "Groenland", 
            "GP" => "Guadeloupe", 
            "GU" => "Guam", 
            "GT" => "Guatemala", 
            "GG" => "Guernesey", 
            "GN" => "Guinée", 
            "GQ" => "Guinée équatoriale", 
            "GW" => "Guinée-Bissau", 
            "GY" => "Guyana", 
            "GF" => "Guyane française", 
            "HT" => "Haïti", 
            "HN" => "Honduras", 
            "HU" => "Hongrie", 
            "BV" => "Île Bouvet", 
            "CX" => "Île Christmas", 
            "CP" => "Île Clipperton", 
            "AC" => "Île de l'Ascension", 
            "IM" => "Île de Man", 
            "NF" => "Île Norfolk", 
            "AX" => "Îles Åland", 
            "KY" => "Îles Caïmans", 
            "IC" => "Îles Canaries", 
            "CC" => "Îles Cocos - Keeling", 
            "CK" => "Îles Cook", 
            "FO" => "Îles Féroé", 
            "HM" => "Îles Heard et MacDonald", 
            "FK" => "Îles Malouines", 
            "MP" => "Îles Mariannes du Nord", 
            "MH" => "Îles Marshall", 
            "UM" => "Îles Mineures Éloignées des États-Unis", 
            "SB" => "Îles Salomon", 
            "TC" => "Îles Turks et Caïques", 
            "VG" => "Îles Vierges britanniques", 
            "VI" => "Îles Vierges des États-Unis", 
            "IN" => "Inde", 
            "ID" => "Indonésie", 
            "IQ" => "Irak", 
            "IR" => "Iran", 
            "IE" => "Irlande", 
            "IS" => "Islande", 
            "IL" => "Israël", 
            "JM" => "Jamaïque", 
            "JE" => "Jersey", 
            "JO" => "Jordanie", 
            "KZ" => "Kazakhstan", 
            "KE" => "Kenya", 
            "KG" => "Kirghizistan", 
            "KI" => "Kiribati", 
            "KW" => "Koweït", 
            "LA" => "Laos", 
            "LS" => "Lesotho", 
            "LV" => "Lettonie", 
            "LB" => "Liban", 
            "LR" => "Libéria", 
            "LY" => "Libye", 
            "LI" => "Liechtenstein", 
            "LT" => "Lituanie", 
            "LU" => "Luxembourg", 
            "MK" => "Macédoine", 
            "MG" => "Madagascar", 
            "MY" => "Malaisie", 
            "MW" => "Malawi", 
            "MV" => "Maldives", 
            "ML" => "Mali", 
            "MT" => "Malte", 
            "MQ" => "Martinique", 
            "MU" => "Maurice", 
            "MR" => "Mauritanie", 
            "YT" => "Mayotte", 
            "MX" => "Mexique", 
            "MD" => "Moldavie", 
            "MC" => "Monaco", 
            "MN" => "Mongolie", 
            "ME" => "Monténégro", 
            "MS" => "Montserrat", 
            "MZ" => "Mozambique", 
            "MM" => "Myanmar", 
            "NA" => "Namibie", 
            "NR" => "Nauru", 
            "NP" => "Népal", 
            "NI" => "Nicaragua", 
            "NE" => "Niger", 
            "NG" => "Nigéria", 
            "NU" => "Niue", 
            "NO" => "Norvège", 
            "NC" => "Nouvelle-Calédonie", 
            "NZ" => "Nouvelle-Zélande", 
            "OM" => "Oman", 
            "UG" => "Ouganda", 
            "UZ" => "Ouzbékistan", 
            "PK" => "Pakistan", 
            "PW" => "Palaos", 
            "PA" => "Panama", 
            "PG" => "Papouasie-Nouvelle-Guinée", 
            "PY" => "Paraguay", 
            "NL" => "Pays-Bas", 
            "PE" => "Pérou", 
            "PH" => "Philippines", 
            "PN" => "Pitcairn", 
            "PL" => "Pologne", 
            "PF" => "Polynésie française", 
            "PR" => "Porto Rico", 
            "PT" => "Portugal", 
            "QA" => "Qatar", 
            "HK" => "R.A.S. chinoise de Hong Kong", 
            "MO" => "R.A.S. chinoise de Macao", 
            "QO" => "régions éloignées de l’Océanie", 
            "CF" => "République centrafricaine", 
            "CD" => "République démocratique du Congo", 
            "DO" => "République dominicaine", 
            "CZ" => "République tchèque", 
            "RE" => "Réunion", 
            "RO" => "Roumanie", 
            "GB" => "Royaume-Uni", 
            "RU" => "Russie", 
            "RW" => "Rwanda", 
            "BL" => "Saint-Barthélémy", 
            "KN" => "Saint-Kitts-et-Nevis", 
            "SM" => "Saint-Marin", 
            "MF" => "Saint-Martin", 
            "PM" => "Saint-Pierre-et-Miquelon", 
            "VC" => "Saint-Vincent-et-les Grenadines", 
            "SH" => "Sainte-Hélène", 
            "LC" => "Sainte-Lucie", 
            "WS" => "Samoa", 
            "AS" => "Samoa américaines", 
            "ST" => "Sao Tomé-et-Principe", 
            "SN" => "Sénégal", 
            "RS" => "Serbie", 
            "CS" => "Serbie-et-Monténégro", 
            "SC" => "Seychelles", 
            "SL" => "Sierra Leone", 
            "SG" => "Singapour", 
            "SK" => "Slovaquie", 
            "SI" => "Slovénie", 
            "SO" => "Somalie", 
            "SD" => "Soudan", 
            "LK" => "Sri Lanka", 
            "SE" => "Suède", 
            "CH" => "Suisse", 
            "SR" => "Suriname", 
            "SJ" => "Svalbard et Île Jan Mayen", 
            "SZ" => "Swaziland", 
            "SY" => "Syrie", 
            "TJ" => "Tadjikistan", 
            "TW" => "Taïwan", 
            "TZ" => "Tanzanie", 
            "TD" => "Tchad", 
            "TF" => "Terres australes françaises", 
            "IO" => "Territoire britannique de l'océan Indien", 
            "PS" => "Territoire palestinien", 
            "TH" => "Thaïlande", 
            "TL" => "Timor oriental", 
            "TG" => "Togo", 
            "TK" => "Tokelau", 
            "TO" => "Tonga", 
            "TT" => "Trinité-et-Tobago", 
            "TA" => "Tristan da Cunha", 
            "TN" => "Tunisie", 
            "TM" => "Turkménistan", 
            "TV" => "Tuvalu", 
            "UA" => "Ukraine", 
            "EU" => "Union européenne", 
            "UY" => "Uruguay", 
            "VU" => "Vanuatu", 
            "VE" => "Venezuela", 
            "VN" => "Viêt Nam", 
            "WF" => "Wallis-et-Futuna", 
            "YE" => "Yémen", 
            "ZM" => "Zambie", 
            "ZW" => "Zimbabwe" 
         ]; 
        $em = $this->getDoctrine()->getManager();

        
        foreach ($jayParsedAry as $liste) {             
            $Pay = new Pays();
            $Pay->setNom($liste);
            $Pay->setIsDeleted(false);
            $em->persist($Pay);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }

     /**
    * @Route("/bulksecteur",methods={"POST"})
    */    
    public function bulksecteur(EntityManagerInterface $em)
    {

        $em = $this->getDoctrine()->getManager();
        $comptes = $em->getRepository(Compte::class)->findAll();
        $Users = $em->getRepository(User::class)->findAll();
        $Events = $em->getRepository(Event::class)->findAll();

        $secteures = $em->getRepository(Secteur::class)->findAll();
        
        foreach($comptes as $compte){
            foreach($compte->getSecteurs() as $fil){
                $compte->removeSecteur($fil);
                $em->flush();
            }
        }
        foreach($Users as $user){
            foreach($user->getSecteurs() as $fil){
                $user->removeSecteur($fil);
                $em->flush();
            }
        }
        foreach($Events as $event){
             $event->setSecteur(NULL);
                $em->flush();
        }
        foreach ($secteures as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        $bulk_list=array("Automobile et poids lourds", "Aéronautique", 
        "Texile et Cuir", "Agro-industrie", "Enérgie", "Santé", "Digital/Offshoring", 
        "Chimie-parachimie", "IMM", "Matériaux de construction", "Plasturgie");
        
        
        foreach ($bulk_list as $liste) {
            $fonction = new Secteur();
            $fonction->setNom($liste);
            $fonction->setIsDeleted(false);
            $em->persist($fonction);
        }
        $em->flush();

        $repository = $em->getRepository(Secteur::class);
        $sec = $repository->findOneBy(['nom'=> "Aéronautique"]);
         foreach($comptes as $compte){
             
                $compte->addSecteur($sec);
                $em->flush();
            
        }
        foreach($Users as $user){
             
                $user->addSecteur($sec);
                $em->flush();
            
        }
        foreach($Events as $event){
             $event->setSecteur($sec);
                $em->flush();
        }

        return new Response('', Response::HTTP_OK);
    }

     /**
    * @Route("/savoiretacompte")
    */    
    public function savoiretacompte(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(EtatCompte::class);
        $entities = $repository->findAll();
        dd($entities);
         

        return new Response('', Response::HTTP_OK);
    }
    
    /**
    * @Route("/resetpayessiege")
    */    
    public function resetpayessiege(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Pays::class);
        $canada = $repository->findOneBy(['nom'=> "Canada"]);

        $comptes = $em->getRepository(Compte::class)->findAll();
         
        foreach ($comptes as $compte) {
             $compte->setPaysSiege($canada);
             $compte->setCentreDecision($canada);
             $em->persist($compte);
             $em->flush();
        }

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/restechetat")
    */    
    public function restechetat(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(EtatCompte::class);
        $ident = $repository->findOneBy(['id'=> 7]);
        $ident->setNom("");
        $em->persist($ident);
        $em->flush();
         

        return new Response('', Response::HTTP_OK);
    }

     /**
    * @Route("/resetlogcompte")
    */    
    public function resetlogcompte(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(LogCompte::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/resetlogprojets")
    */    
    public function resetlogprojets(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(LogProjet::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/resetdatacomptes")
    */    
    public function resetdatacomptes(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(CompteData::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/resetdataprojets")
    */    
    public function resetdataprojets(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(ProjetsData::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
     /**
    * @Route("/resetallcomptes")
    */    
    public function resetallcomptes(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Compte::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
     /**
    * @Route("/resetallprojets")
    */    
    public function resetallprojets(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Projets::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    
    /**
    * @Route("/resetprojets")
    */    
    public function resetprojets(EntityManagerInterface $em)
    {
        // ProjetsData
        $repository = $em->getRepository(ProjetsData::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();
        // LogProjet
        $repository = $em->getRepository(LogProjet::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();
        // TinyJournal
        $repository = $em->getRepository(TinyJournal::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        // Projets
        $repository = $em->getRepository(Projets::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }

    /**
    * @Route("/resetcomptes")
    */    
    public function resetcomptes(EntityManagerInterface $em)
    {
        // LogCompte
        $repository = $em->getRepository(LogCompte::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();
        // CompteData
        $repository = $em->getRepository(CompteData::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();
        // CarteVisite
        $repository = $em->getRepository(CarteVisite::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();
        // Compte
        $repository = $em->getRepository(Compte::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/resetallcontacts")
    */    
    public function resetallcontact(EntityManagerInterface $em)
    {
        // CarteVisite
        $repository = $em->getRepository(CarteVisite::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();
        // Contact
        $repository = $em->getRepository(Contact::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/resetevents")
    */    
    public function resetallevents(EntityManagerInterface $em)
    {
        
        // Event
        $repository = $em->getRepository(Event::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            $em->remove($entity);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
     /**
    * @Route("/espagne")
    */    
    public function espagne(EntityManagerInterface $em)
    {
        
        // Event
        $repository = $em->getRepository(Pays::class);
        $entities = $repository->findOneBy(['nom' => 'Espagnol']);
        $entities->setNom('Espagne');
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/allpayes")
    */    
    public function allpayes(EntityManagerInterface $em)
    {
        
        $repository = $em->getRepository(Pays::class);
        $entities = $repository->findAll();
        foreach ($entities as $entity) {
           if($entity->getNom()){
               dump($entity);
           }
        }
       die();

        return new Response('', Response::HTTP_OK);
    }

    /**
    * @Route("/resetsecteurs")
    */    
    public function resetsecteurs(EntityManagerInterface $em)
    {
        
        // Event
        $repository = $em->getRepository(Secteur::class);
        $entities = $repository->findAll();

        foreach ($entities as $entity) {
            if($entity->getId() != 47){
                $em->remove($entity);
                


            }
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/bulksecteurs")
    */    
    public function bulksecteurs(EntityManagerInterface $em)
    {

        $bulk_list=array("Agro-industrie", "Textile", "Cuir", "Pharmaceutique", "Santé", "Energie", "Aéronautique", "Electricité", "Electronique", "Naval", "Digital", "Outsourcing", "Chimie-parachimie", "IMM", "Matériaux de construction", "Plasturgie", "Autres activités diverses", "Institutionnel", "Multi-secteurs");
        $em = $this->getDoctrine()->getManager();
        foreach ($bulk_list as $liste) {
            $Secteur = new Secteur();
            $Secteur->setNom($liste);
            $Secteur->setIsDeleted(false);
            $em->persist($Secteur);
        }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }
    

    /**
    * @Route("/resetimport")
    */    
    public function resetimport(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Import::class);
        $ident = $repository->findAll();
        foreach ($ident as $entity) {
            $em->remove($entity);
        }
        $em->flush();
         

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/resetgroupe")
    */    
    public function resetgroupe(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Groupe::class);
        $ident = $repository->findAll();
        foreach ($ident as $entity) {
            if($entity->getIsDeleted() == TRUE){
                $em->remove($entity);
            }
        }
        $em->flush();
         

        return new Response('', Response::HTTP_OK);
    }
    /**
    * @Route("/resetrole")
    */    
    public function resetrole(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Role::class);
        $ident = $repository->findAll();
        foreach ($ident as $entity) {
            $em->remove($entity);
        }
        $em->flush();
         

        return new Response('', Response::HTTP_OK);
    }
     /**
    * @Route("/resteuser")
    */    
    public function resteuser(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(User::class);
        $ident = $repository->findAll();
        foreach ($ident as $entity) {
            if($entity->getId()!=15){
                $em->remove($entity);
            }
        }
        $em->flush();
         

        return new Response('', Response::HTTP_OK);
    }

     /**
    * @Route("/restesec")
    */    
    public function restesec(EntityManagerInterface $em)
    {
        $em = $this->getDoctrine()->getManager();
        $secteure = $em->getRepository(Secteur::class)->findOneBy(['id' => 47]);
        $users = $em->getRepository(User::class)->findAll();
        foreach($users as $user){
            foreach($user->getSecteurs() as $fil){
                $user->removeSecteur($fil);
                $em->flush();
            }
            $user->addSecteur($secteure);
        }

        
        // foreach ($filieres as $entity) {
        //     $em->remove($entity);
        // }
        $em->flush();

        return new Response('', Response::HTTP_OK);
    }

      /**
    * @Route("/projetdataconf")
    */    
    public function projetdataconf(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Projets::class);
        $ident = $repository->findAll();
        foreach ($ident as $entity) {
            $oop=$em->getRepository(Projets::class)->getValueField($entity->getId(),'Confidentiel')?$em->getRepository(Projets::class)->getValueField($entity->getId(),'Confidentiel')['value']:0;
            if($oop == "1"){
                $entity->setConfidentiel(true);
            }else{
                $entity->setConfidentiel(false);
            }
            
        }

        
        $em->flush();
         

        return new Response('', Response::HTTP_OK);
    }

    
}



