<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Import;
use App\Form\ContactCollectionType;
use App\Repository\ImportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/imports")
 */
class ImportsController extends AbstractController
{
    /**
     * @Route("/contacts", name="imports_contacts")
     */
    public function index(ImportRepository $importRepository)
    {
        $user=$this->getUser()->getId();
        $listImportContacts=$importRepository->getImports('Contact',$user);
        foreach ($listImportContacts as $key => $value){
            $listImportContacts[$key]["contacts"]=$this->getDoctrine()->getRepository(Contact::class)->findBy(['id'=>json_decode($value['ids_objects'])]);
        }
        return $this->render('imports/index.html.twig', [
            'imports' => $listImportContacts
        ]);
    }

    /**
     * @Route("/import/{id}", name="import_detail")
     */
    public function detail(Import $import,Request $request)
    {
        $contacts=$this->getDoctrine()->getRepository(Contact::class)->findBy(['id'=>json_decode($import->getIdsObjects())]);
        $form = $this->createForm(ContactCollectionType::class, null ,array('objects'=>$contacts));
        return $this->render('imports/detail.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/rollback/{id}", name="import_rollback")
     */
    public function rollback(Import $import)
    {
        $contacts=$this->getDoctrine()->getRepository(Contact::class)->findBy(['id'=>json_decode($import->getIdsObjects())]);
        $entityManager = $this->getDoctrine()->getManager();
        foreach ($contacts as $contact){
            $entityManager->remove($contact);
        }
        $entityManager->remove($import); 
        $entityManager->flush();
        $this->addFlash('success', 'Ce import a été supprimé avec succès');
       return $this->redirectToRoute('contact_importer');
    }
}
