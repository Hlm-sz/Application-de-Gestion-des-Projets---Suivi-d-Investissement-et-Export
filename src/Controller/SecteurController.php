<?php

namespace App\Controller;

use App\Entity\Secteur;
use App\Form\SecteurType;
use App\Repository\SecteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/secteur")
 */
class SecteurController extends AbstractController
{
    /**
     * @Route("/", name="secteur_index", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function index(): Response
    {
        return $this->render('secteur/index.html.twig');
    }

    /**
     * @Route("/ajax_secteur", name="ajax_secteur", methods={"GET"})
     */
    public function ajaxListsSecteur(SecteurRepository $secteurRepository, TranslatorInterface $translator)
    {
        $data = array();
        $secteurs =  $secteurRepository->findBy(['isDeleted' => false]);
        foreach ($secteurs as $secteur) {


            $edit = $this->generateUrl('secteur_edit', [
                'id' => $secteur->getId(),
            ]);
            $afficher = $this->generateUrl('secteur_show', [
                'id' => $secteur->getId(),
            ]);
            $actions = '<a class="btn btn-btn-blue" href=' . $afficher . '><i class="fa fa-eye"></i> ' . $translator->trans('compte.Show') . '</a>
            <a class="btn btn-btn-blue" href=' . $edit . '><i class="fa fa-edit"></i> ' . $translator->trans('compte.Edit') . '</a>';

            $data[] = array(
                "nom" => $secteur->getNom(),
                "color" => "<div style='background-color: ".$secteur->getColor().";width: 100px;height: 25px;'></div>",
                "actions" => $actions
            );
        }

        $output = array(
            "TotalRecords" => count($secteurs),
            "TotalDisplayRecords" => 10,
            "data" => $data,
        );

        return new Response(json_encode($output));
    }




    /**
     * @Route("/new", name="secteur_new", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function new(Request $request): Response
    {
        $secteur = new Secteur();
        $form = $this->createForm(SecteurType::class, $secteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $secteur->setIsDeleted(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($secteur);
            $entityManager->flush();
            $this->addFlash('success', 'Le nouveau secteur a été créé avec succès');
            return $this->redirectToRoute('secteur_index');
        }

        return $this->render('secteur/new.html.twig', [
            'secteur' => $secteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="secteur_show", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function show(Secteur $secteur): Response
    {
        return $this->render('secteur/show.html.twig', [
            'secteur' => $secteur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="secteur_edit", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function edit(Request $request, Secteur $secteur): Response
    {
        $form = $this->createForm(SecteurType::class, $secteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Ce secteur a été modifié avec succès');
            return $this->redirectToRoute('secteur_index');
        }

        return $this->render('secteur/edit.html.twig', [
            'secteur' => $secteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="secteur_delete", methods={"DELETE"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function delete(Request $request, Secteur $secteur): Response
    {
        if ($this->isCsrfTokenValid('delete' . $secteur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            // // $secteur->setIsDeleted(true);
            // $entityManager->persist($secteur);
            $entityManager->remove($secteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('secteur_index');
    }
}
