<?php

namespace App\Controller\Api;

use App\Entity\Canal;
use App\Entity\Compte;
use App\Entity\Contact;
use App\Entity\LogCompte;
use App\Entity\LogProjet;
use App\Entity\CompteData;
use App\Entity\ProjetsData;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Event;
use App\Entity\User;
use App\Entity\Secteur;
use App\Entity\Profils;
use App\Entity\Projets;
use App\Entity\Groupe;
use App\Entity\TypeProjet;
use App\Form\FormProjectType;
use App\Form\ProjetsType;
use App\Repository\ProjetsDataRepository;
use App\Repository\ProjetsRepository;
use App\Repository\TypeProjetRepository;
use App\Utils\Uploader\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Workflow\Registry;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("api/contact")
 */
class ContactApiController extends AbstractController
{
    /**
     * @Route("/new", name="api_contact_new", methods={"POST"})
     */
    public function newDataProjet(Request $request)
    {

        
        $groupe = $this->getDoctrine()->getRepository(Groupe::class)->findOneBy(['nom'=> 'Contacts']);
        $responsable = $this->getDoctrine()->getRepository(User::class)->findOneBy(['groupe'=> $groupe->getId()]);
        
        $response = new Response();
        if($request->headers->get('authorization')){
            $em=$this->getDoctrine()->getManager();
            $rs=$request->request->get('rs');
            if($rs){
                $canal=$this->getDoctrine()->getRepository(Canal::class)->findOneBy(['nom'=>$rs]);
            }else{
                $id_canal=4;
                $canal=$this->getDoctrine()->getRepository(Canal::class)->findOneBy(['id'=>$id_canal]);
            }          
            $secteur=$request->request->get('secteur');
            $marche_international=$request->request->get('marche_international');
            $Objet_demande=$request->request->get('objet_demande');
            $nom=$request->request->get('nom');
            $prenom=$request->request->get('prenom');
            $email=$request->request->get('email');
            $tel=$request->request->get('tel');
            $organisation=$request->request->get('organisation');
            $fonction=$request->request->get('fonction');
            $pays=$request->request->get('pays');
            $message=$request->request->get('message');
            $request_profil=$request->request->get('profil');
            if(!$nom){
                $nom = "Contact"; 
            }
            if(!$prenom){
                $prenom = "Guest"; 
            }
            $commentaire=
                "Secteur : ".$secteur." \n ".
                "Marché international : ".$marche_international." \n ".
                "Objet de la demande : ".$Objet_demande." \n ".
                "Pays : ".$pays." \n ".
                "Fonction : ".$fonction." \n ".
                "organisation : ".$organisation." \n ".
                "Message : ".$message;

            try {
                if($request_profil){
                    $profil=$this->getDoctrine()->getRepository(Profils::class)->findOneBy(['nom'=>$request_profil]);
                    if(!$profil){
                        $profil=$this->getDoctrine()->getRepository(Profils::class)->findOneBy(['nom'=>"Compte"]);
                    }
                }
                $contact=new Contact();
                $contact->setEmail($email);
                $contact->setDetailsLibres($commentaire);
                $contact->setIsArchived(false);
                $contact->setLangugePrincipale("");
                $contact->setNom($nom);
                $contact->setPrenom($prenom);
                $contact->setProfil($profil);
                $contact->setCanal($canal);
                $contact->setExclusif(false);
                $contact->setTel($tel);
                $contact->setDateCreation(new \DateTimeImmutable());
                $contact->setFonction($fonction);
                // $contact->setOrganisation($organisation);
                $contact->setType(1);
                $contact->setIsPartenaire(0);
                $contact->setisActive(0);
                $contact->setResponsableContact($responsable);
                $em=$this->getDoctrine()->getManager();
                $em->persist($contact);
                $em->flush();
                $data=array('code'=>200,'message'=> 'ok','message'=> 'Nouveau contact sauvegardé');
            }catch (\Throwable $th){
                $data=array('code'=>$th->getCode(),'message'=> $th->getMessage());
            }
        }else{
            $data=array('code'=>403,'message'=> 'HTTP/1.1 403 Forbidden');
        }
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


    /**
     * @Route("/{id}/edit", name="projets_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Projets $projet, FileUploader $fileUploader): Response
    {

        $type_projet = $this->formJson($projet->getType());
        if ($type_projet) {
            foreach ($type_projet["groupes"] as $key => &$groupes) {
                foreach ($groupes["properties"] as $keys => &$propertie) {
                    $dataProject = $this->getDoctrine()->getRepository(ProjetsData::class)->findOneBy(['projet' => $projet->getId(), 'cle' => $propertie["nom"]]);
                    $options_data = $dataProject ? $dataProject->getValue() : null;
                    if ($propertie["type"] == "document") {
                        if ($options_data) {
                            $propertie["options"]["data"] =  new File($this->getParameter('uploader_directory') . '/' . $options_data);
                        } else {
                            $propertie["options"]["data_class"] = null;
                        }
                    } else if ($propertie["type"] == "entity") {
                        $propertie["options"]["data"] = $this->getDoctrine()->getRepository($propertie["options"]["class"])->findOneBy(['id' => $options_data]);
                    } else {
                        $propertie["options"]["data"] = $options_data;
                    }
                }
            }
        }
        $data = array("projet" => $projet, "type_projet" => $type_projet, "compte" => $projet->getCompte(), "contact" => $projet->getCompte()->getContact());
        $form = $this->createForm(ProjetsType::class, $projet, array("schema_form" => $type_projet));
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
            $projet->setTitre($titre);
            $type_projet1 = $this->formJson($projet->getType());
            foreach ($type_projet1["groupes"] as $keyv => $liste_groupes1) {
                foreach ($liste_groupes1["properties"] as $keyd => $propertie1) {

                    if ($propertie1["type"] == "entity") {

                        $data1 = $this->getDoctrine()->getRepository(ProjetsData::class)->findOneBy(['projet' => $projet->getId(), 'cle' => $propertie1["nom"]]);
                        if ($data1) {
                            $data1->setValue($form[$propertie1["nom"]]->getData()->getId());
                            $entityManager->persist($data1);
                            $entityManager->flush();
                        } else {
                            $data1_1 = new ProjetsData();
                            $data1_1->setCle($propertie1["nom"]);
                            $data1_1->setValue($form[$propertie1["nom"]]->getData()->getId());
                            $data1_1->setProjet($projet);
                            $entityManager->persist($data1_1);
                            $entityManager->flush();
                        }
                    } else if ($propertie1["type"] == "document") {
                        $brochureFile = $form->get($propertie1["nom"])->getData();
                        if ($brochureFile) {
                            /* $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                            $safeFilename = $originalFilename;
                            $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessClientExtension();

                            $brochureFile->move(
                                $this->getParameter('data_directory'),
                                $newFilename
                            );*/
                            // dd($form->get($propertie1["nom"])->getData());
                            $newFilename = $fileUploader->upload($brochureFile);

                            $data2 = $this->getDoctrine()->getRepository(ProjetsData::class)->findOneBy(['projet' => $projet->getId(), 'cle' => $propertie1["nom"]]);
                            if ($data2) {
                                $data2->setValue($newFilename);
                                $entityManager->persist($data2);
                                $entityManager->flush();
                            } else {
                                $data2_2 = new ProjetsData();
                                $data2_2->setCle($propertie1["nom"]);
                                $data2_2->setValue($newFilename);
                                $data2_2->setProjet($projet);
                                $entityManager->persist($data2_2);
                                $entityManager->flush();
                            }
                        }
                    } else if ($propertie1["type"] == "boolean") {
                        $valueBoolean = $form[$propertie1["nom"]]->getData() == true ? 1 : 0;
                        // dd($valueBoolean);
                        $data3 = $this->getDoctrine()->getRepository(ProjetsData::class)->findOneBy(['projet' => $projet->getId(), 'cle' => $propertie1["nom"]]);
                        if ($data3) {

                            $data3->setValue($valueBoolean);
                            $entityManager->persist($data3);
                            $entityManager->flush();
                        } else {
                            $data3_3 = new ProjetsData();
                            $data3_3->setCle($propertie1["nom"]);
                            $data3_3->setValue($valueBoolean);
                            $data3_3->setProjet($projet);
                            $entityManager->persist($data3_3);
                            $entityManager->flush();
                        }
                    } else {
                        $data4 = $this->getDoctrine()->getRepository(ProjetsData::class)->findOneBy(['projet' => $projet->getId(), 'cle' => $propertie1["nom"]]);
                        if ($data4) {
                            if ($form[$propertie1["nom"]]->getData() == null) {
                                $data4->setValue("");
                            } else {
                                $data4->setValue($form[$propertie1["nom"]]->getData());
                            }
                            $entityManager->persist($data4);
                            $entityManager->flush();
                        } else {
                            if ($form[$propertie1["nom"]]->getData() != null) {
                                $data4_4 = new ProjetsData();
                                $data4_4->setCle($propertie1["nom"]);
                                $data4_4->setValue($form[$propertie1["nom"]]->getData());
                                $data4_4->setProjet($projet);
                                $entityManager->persist($data4_4);
                                $entityManager->flush();
                            }
                        }
                    }
                }
            }
            return $this->redirectToRoute('projets_edit', ['id' => $projet->getId()]);
        }

        return $this->render('projets/edit.html.twig', [
            'projet' => $projet,
            'data' =>   array("projet" => $projet, "type_projet" => $type_projet, "compte" => $projet->getCompte(), "contact" => $projet->getCompte()->getContact()),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="projets_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Projets $projet): Response
    {
        if ($this->isCsrfTokenValid('delete' . $projet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($projet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('projets_index');
    }

    /**
    * @Route("/bulksecteuredit",methods={"DELETE"})
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
    * @Route("/resetlogcompte",methods={"DELETE"})
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
    * @Route("/resetlogprojets",methods={"DELETE"})
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
    * @Route("/resetdatacomptes",methods={"DELETE"})
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
    * @Route("/resetdataprojets",methods={"DELETE"})
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
    * @Route("/resetallcomptes",methods={"DELETE"})
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
    * @Route("/resetallprojets",methods={"DELETE"})
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

    
    
}
