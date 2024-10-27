<?php

namespace App\Controller;

use App\Entity\TypeCompte;
use App\Form\TypeCompteType;
use App\Repository\TypeCompteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/type/compte")
 */
class TypeCompteController extends AbstractController
{
    /**
     * @Route("/", name="type_compte_index", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function index(TypeCompteRepository $typeCompteRepository): Response
    {
        return $this->render('type_compte/index.html.twig', [
            'type_comptes' => $typeCompteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_compte_new", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function new(Request $request): Response
    {
        $typeCompte = new TypeCompte();
        $form = $this->createForm(TypeCompteType::class, $typeCompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeCompte);
            $entityManager->flush();

            return $this->redirectToRoute('type_compte_index');
        }

        return $this->render('type_compte/new.html.twig', [
            'type_compte' => $typeCompte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_compte_show", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function show(TypeCompte $typeCompte): Response
    {
        return $this->render('type_compte/show.html.twig', [
            'type_compte' => $typeCompte,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_compte_edit", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function edit(Request $request, TypeCompte $typeCompte): Response
    {
        $form = $this->createForm(TypeCompteType::class, $typeCompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_compte_index');
        }

        return $this->render('type_compte/edit.html.twig', [
            'type_compte' => $typeCompte,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_compte_delete", methods={"DELETE"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function delete(Request $request, TypeCompte $typeCompte): Response
    {
        if ($this->isCsrfTokenValid('delete' . $typeCompte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeCompte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_compte_index');
    }
}
