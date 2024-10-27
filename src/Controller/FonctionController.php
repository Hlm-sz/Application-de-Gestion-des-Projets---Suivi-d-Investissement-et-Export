<?php

namespace App\Controller;

use App\Entity\Fonction;
use App\Form\FonctionType;
use App\Repository\FonctionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/fonction")
 */
class FonctionController extends AbstractController
{
    /**
     * @Route("/", name="fonction_index", methods={"GET"})
     */
    public function index(FonctionRepository $FonctionRepository): Response
    {
        return $this->render('fonction/index.html.twig', [
            'fonctions' => $FonctionRepository->findAll(),
        ]);
    }
     /**
     * @Route("/ajax_fonction", name="ajax_fonction", methods={"GET"})
     */
    public function ajaxListsFonction(FonctionRepository $FonctionRepository, TranslatorInterface $translator)
    {
        $data = array();
        $fonctions =   $FonctionRepository->findBy(['isDeleted' => false]);
        foreach ($fonctions as $fonction) {

            $edit = $this->generateUrl('fonction_edit', [
                'id' => $fonction->getId(),
            ]);
            $afficher = $this->generateUrl('fonction_show', [
                'id' => $fonction->getId(),
            ]);
            $actions = '<a class="btn btn-btn-blue" href=' . $afficher . '><i class="fa fa-eye"></i> ' . $translator->trans('compte.Show') . '</a>
            <a class="btn btn-btn-blue" href=' . $edit . '><i class="fa fa-edit"></i> ' . $translator->trans('compte.Edit') . '</a>';

            $data[] = array(
                "nom" => $fonction->getNom(),
                "actions" => $actions
            );
        }

        $output = array(
            "TotalRecords" => count($fonctions),
            "TotalDisplayRecords" => 10,
            "data" => $data,
        );

        return new Response(json_encode($output));
    }

    /**
     * @Route("/new", name="fonction_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $fonction = new Fonction();
        $form = $this->createForm(FonctionType::class, $fonction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $fonction->setIsDeleted(0);
            $entityManager->persist($fonction);
            $entityManager->flush();
            $this->addFlash('success', 'Nouvelle fonction a été créé avec succès');
            return $this->redirectToRoute('fonction_index');
        }

        return $this->render('fonction/new.html.twig', [
            'fonction' => $fonction,
            'form' => $form->createView(),
        ]);
    }
    

    /**
     * @Route("/{id}", name="fonction_show", methods={"GET"})
     */
    public function show(Fonction $fonction): Response
    {
        return $this->render('fonction/show.html.twig', [
            'fonction' => $fonction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fonction_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Fonction $fonction): Response
    {
        $form = $this->createForm(FonctionType::class, $fonction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fonction_index');
        }

        return $this->render('fonction/edit.html.twig', [
            'fonction' => $fonction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fonction_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Fonction $fonction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fonction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fonction);
            $entityManager->flush();
        } 

        return $this->redirectToRoute('fonction_index');
    }
}
