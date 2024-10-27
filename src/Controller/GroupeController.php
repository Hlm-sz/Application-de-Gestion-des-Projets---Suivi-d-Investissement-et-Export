<?php

namespace App\Controller;

use App\Entity\Acces;
use App\Entity\Groupe;
use App\Form\GroupeType;
use App\Repository\GroupeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/groupe")
 */
class GroupeController extends AbstractController
{
    /**
     * @Route("/", name="groupe_index", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function index(): Response
    {
        return $this->render('groupe/index.html.twig');
    }

    /**
     * @Route("/ajax_groupe", name="ajax_groupe", methods={"GET"})
     */
    public function ajaxListsGroupe(GroupeRepository $groupeRepository, TranslatorInterface $translator)
    {
        $data = array();
        $groupes =   $groupeRepository->findBy(['isDeleted' => false]);
        foreach ($groupes as $groupe) {
            $restrictions = "";
            foreach ($groupe->getRestrictions() as $restriction) {
                $restrictions .=  $restriction->getNom() . ' <br>';
            }
            $roles = "";
            foreach ($groupe->getRoles() as $role) {
                $roles .=  $role->getRole() . ' <br>';
            }
            $edit = $this->generateUrl('groupe_edit', [
                'id' => $groupe->getId(),
            ]);
            $afficher = $this->generateUrl('groupe_show', [
                'id' => $groupe->getId(),
            ]);
            $actions = '<a class="btn btn-btn-blue" href=' . $afficher . '><i class="fa fa-eye"></i> ' . $translator->trans('compte.Show') . '</a>
            <a class="btn btn-btn-blue" href=' . $edit . '><i class="fa fa-edit"></i> ' . $translator->trans('compte.Edit') . '</a>';

            $data[] = array(
                "nom" => $groupe->getNom(),
                "roles" => $roles,
                "restrictions" => $restrictions,
                "actions" => $actions
            );
        }

        $output = array(
            "TotalRecords" => count($groupes),
            "TotalDisplayRecords" => 10,
            "data" => $data,
        );

        return new Response(json_encode($output));
    }


    /**
     * @Route("/new", name="groupe_new", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function new(Request $request): Response
    {
        $groupe = new Groupe();
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $groupe->setIsDeleted(false);
            $entityManager->persist($groupe);
            $entityManager->flush();
            $this->addFlash('success', 'Le nouveau groupe a été créé avec succès');
            return $this->redirectToRoute('groupe_index');
        }

        return $this->render('groupe/new.html.twig', [
            'groupe' => $groupe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="groupe_show", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function show(Groupe $groupe): Response
    {
        return $this->render('groupe/show.html.twig', [
            'groupe' => $groupe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="groupe_edit", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function edit(Request $request, Groupe $groupe): Response
    {
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Ce groupe a été modifié avec succès');
            return $this->redirectToRoute('groupe_index');
        }
        return $this->render('groupe/edit.html.twig', [
            'groupe' => $groupe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="groupe_delete", methods={"DELETE"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function delete(Request $request, Groupe $groupe): Response
    {
        if ($this->isCsrfTokenValid('delete' . $groupe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            // $groupe->setIsDeleted(true);
            // $entityManager->persist($groupe);
            $entityManager->remove($groupe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('groupe_index');
    }
}
