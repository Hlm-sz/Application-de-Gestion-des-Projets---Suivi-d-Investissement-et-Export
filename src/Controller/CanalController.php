<?php

namespace App\Controller;

use App\Entity\Canal;
use App\Form\CanalType;
use App\Repository\CanalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/canal")
 */
class CanalController extends AbstractController
{
    /**
     * @Route("/", name="canal_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('canal/index.html.twig');
    }

    /**
     * @Route("/ajax_canal", name="ajax_canal", methods={"GET"})
     */
    public function ajaxListsCanal(CanalRepository $canalRepository, TranslatorInterface $translator)
    {
        $data = array();
        $canals =   $canalRepository->findBy(['isDeleted' => false]);
        foreach ($canals as $canal) {

            $edit = $this->generateUrl('canal_edit', [
                'id' => $canal->getId(),
            ]);
            $afficher = $this->generateUrl('canal_show', [
                'id' => $canal->getId(),
            ]);
            $actions = '<a class="btn btn-btn-blue" href=' . $afficher . '><i class="fa fa-eye"></i> ' . $translator->trans('compte.Show') . '</a>
            <a class="btn btn-btn-blue" href=' . $edit . '><i class="fa fa-edit"></i> ' . $translator->trans('compte.Edit') . '</a>';

            $data[] = array(
                "nom" => $canal->getNom(),
                "actions" => $actions
            );
        }

        $output = array(
            "TotalRecords" => count($canals),
            "TotalDisplayRecords" => 10,
            "data" => $data,
        );

        return new Response(json_encode($output));
    }

    /**
     * @Route("/new", name="canal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $canal = new Canal();
        $form = $this->createForm(CanalType::class, $canal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($canal);
            $entityManager->flush();
            $this->addFlash('success', 'Le nouveau canal a été créé avec succès');
            return $this->redirectToRoute('canal_index');
        }

        return $this->render('canal/new.html.twig', [
            'canal' => $canal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="canal_show", methods={"GET"})
     */
    public function show(Canal $canal): Response
    {
        return $this->render('canal/show.html.twig', [
            'canal' => $canal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="canal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Canal $canal): Response
    {
        $form = $this->createForm(CanalType::class, $canal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Ce canal a été modifié avec succès');
            return $this->redirectToRoute('canal_index');
        }

        return $this->render('canal/edit.html.twig', [
            'canal' => $canal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="canal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Canal $canal): Response
    {
        if ($this->isCsrfTokenValid('delete' . $canal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            // $canal->setIsDeleted(true);
            // $entityManager->persist($canal);
            // $entityManager->flush();
            $entityManager->remove($canal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('canal_index');
    }
}
