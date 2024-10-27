<?php

namespace App\Controller;

use App\Entity\Profils;
use App\Form\ProfilsType;
use App\Repository\ProfilsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/profil")
 */
class ProfilsController extends AbstractController
{
    /**
     * @Route("/", name="profils_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('profils/index.html.twig');
    }

    /**
     * @Route("/ajax_profil", name="ajax_profil", methods={"GET"})
     */
    public function ajaxListsProfil(ProfilsRepository $profilsRepository, TranslatorInterface $translator)
    {
        $data = array();
        $profils =  $profilsRepository->findBy(['isDeleted' => false]);
        foreach ($profils as $profil) {

            $edit = $this->generateUrl('profils_edit', [
                'id' => $profil->getId(),
            ]);
            $afficher = $this->generateUrl('profils_show', [
                'id' => $profil->getId(),
            ]);
            $actions = '<a class="btn btn-btn-blue" href=' . $afficher . '><i class="fa fa-eye"></i> ' . $translator->trans('compte.Show') . '</a>
            <a class="btn btn-btn-blue" href=' . $edit . '><i class="fa fa-edit"></i> ' . $translator->trans('compte.Edit') . '</a>';

            $data[] = array(
                "nom" => $profil->getNom(),
                "actions" => $actions
            );
        }

        $output = array(
            "TotalRecords" => count($profils),
            "TotalDisplayRecords" => 10,
            "data" => $data,
        );

        return new Response(json_encode($output));
    }


    /**
     * @Route("/new", name="profils_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $profil = new Profils();
        $form = $this->createForm(ProfilsType::class, $profil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profil);
            $entityManager->flush();
            $this->addFlash('success', 'Le nouveau profil a été créé avec succès');
            return $this->redirectToRoute('profils_index');
        }

        return $this->render('profils/new.html.twig', [
            'profil' => $profil,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="profils_show", methods={"GET"})
     */
    public function show(Profils $profil): Response
    {
        return $this->render('profils/show.html.twig', [
            'profil' => $profil,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="profils_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Profils $profil): Response
    {
        $form = $this->createForm(ProfilsType::class, $profil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Ce profil a été modifié avec succès');
            return $this->redirectToRoute('profils_index');
        }

        return $this->render('profils/edit.html.twig', [
            'profil' => $profil,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="profils_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Profils $profil): Response
    {
        if ($this->isCsrfTokenValid('delete' . $profil->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            // $profil->setIsDeleted(true);
            // $entityManager->persist($profil);
            // $entityManager->flush();
            $entityManager->remove($profil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('profils_index');
    }
}
