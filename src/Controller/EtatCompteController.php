<?php

namespace App\Controller;

use App\Entity\EtatCompte;
use App\Form\EtatCompteType;
use App\Repository\EtatCompteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/etat/compte")
 */
class EtatCompteController extends AbstractController
{
    /**
     * @Route("/", name="etat_compte_index", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function index(EtatCompteRepository $etatCompteRepository): Response
    {
        return $this->render('etat_compte/index.html.twig', [
            'etat_comptes' => $etatCompteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="etat_compte_new", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function new(Request $request): Response
    {
        $etatCompte = new EtatCompte();
        $form = $this->createForm(EtatCompteType::class, $etatCompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etatCompte);
            $entityManager->flush();

            return $this->redirectToRoute('etat_compte_index');
        }

        return $this->render('etat_compte/new.html.twig', [
            'etat_compte' => $etatCompte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etat_compte_show", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function show(EtatCompte $etatCompte): Response
    {
        return $this->render('etat_compte/show.html.twig', [
            'etat_compte' => $etatCompte,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="etat_compte_edit", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function edit(Request $request, EtatCompte $etatCompte): Response
    {
        $form = $this->createForm(EtatCompteType::class, $etatCompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etat_compte_index');
        }

        return $this->render('etat_compte/edit.html.twig', [
            'etat_compte' => $etatCompte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="etat_compte_delete", methods={"DELETE"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function delete(Request $request, EtatCompte $etatCompte): Response
    {
        if ($this->isCsrfTokenValid('delete' . $etatCompte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($etatCompte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('etat_compte_index');
    }
}
