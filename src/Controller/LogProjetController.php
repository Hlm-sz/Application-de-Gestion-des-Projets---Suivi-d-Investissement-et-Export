<?php

namespace App\Controller;

use App\Entity\LogProjet;
use App\Entity\Projets;
use App\Form\LogProjetType;
use App\Repository\LogProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/projet/activite")
 */
class LogProjetController extends AbstractController
{
    /**
     * @Route("/", name="log_projet_index", methods={"GET"})
     */
    public function index(LogProjetRepository $logProjetRepository): Response
    {
        return $this->render('log_projet/index.html.twig', [
            'log_projets' => $logProjetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="log_projet_new", methods={"GET","POST"})
     */
    public function new(Request $request,Projets $projet): Response
    {
        $logProjet = new LogProjet();
        $form = $this->createForm(LogProjetType::class, $logProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logProjet->setProjet($projet);
            $logProjet->setCreePar($this->getUser());
            $logProjet->setDateCreation(new \DateTimeImmutable());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($logProjet);
            $entityManager->flush();
            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
            return $this->redirectToRoute('projets_detail',['id'=>$projet->getId()]);
        }

        return $this->render('log_projet/new.html.twig', [
            'log_projet' => $logProjet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="log_projet_show", methods={"GET"})
     */
    public function show(LogProjet $logProjet): Response
    {
        return $this->render('log_projet/show.html.twig', [
            'log_projet' => $logProjet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="log_projet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LogProjet $logProjet): Response
    {
        $form = $this->createForm(LogProjetType::class, $logProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('log_projet_index');
        }

        return $this->render('log_projet/edit.html.twig', [
            'log_projet' => $logProjet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="log_projet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LogProjet $logProjet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$logProjet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($logProjet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('log_projet_index');
    }
}
