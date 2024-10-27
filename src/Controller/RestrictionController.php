<?php

namespace App\Controller;

use App\Entity\Restriction;
use App\Form\RestrictionType;
use App\Repository\RestrictionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/restriction")
 */
class RestrictionController extends AbstractController
{
    /**
     * @Route("/", name="restriction_index", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function index(): Response
    {
        return $this->render('restriction/index.html.twig');
    }

    /**
     * @Route("/ajax_restriction", name="ajax_restriction", methods={"GET"})
     */
    public function ajaxListsRestriction(RestrictionRepository $restrictionRepository, TranslatorInterface $translator)
    {
        $data = array();
        $restrictions =   $restrictionRepository->findAll();
        foreach ($restrictions as $restriction) {


            $edit = $this->generateUrl('restriction_edit', [
                'id' => $restriction->getId(),
            ]);
            $afficher = $this->generateUrl('restriction_show', [
                'id' => $restriction->getId(),
            ]);
            $actions = '<a class="btn btn-btn-blue" href=' . $afficher . '><i class="fa fa-eye"></i> ' . $translator->trans('compte.Show') . '</a>
            <a class="btn btn-btn-blue" href=' . $edit . '><i class="fa fa-edit"></i> ' . $translator->trans('compte.Edit') . '</a>';

            $data[] = array(
                "nom" => $restriction->getNom(),
                "actions" => $actions
            );
        }

        $output = array(
            "TotalRecords" => count($restrictions),
            "TotalDisplayRecords" => 10,
            "data" => $data,
        );

        return new Response(json_encode($output));
    }

    /**
     * @Route("/new", name="restriction_new", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function new(Request $request): Response
    {
        $restriction = new Restriction();
        $form = $this->createForm(RestrictionType::class, $restriction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($restriction);
            $entityManager->flush();
            $this->addFlash('success', 'La nouvelle restriction a été créée avec succès');
            return $this->redirectToRoute('restriction_index');
        }

        return $this->render('restriction/new.html.twig', [
            'restriction' => $restriction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="restriction_show", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function show(Restriction $restriction): Response
    {
        return $this->render('restriction/show.html.twig', [
            'restriction' => $restriction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="restriction_edit", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function edit(Request $request, Restriction $restriction): Response
    {
        $form = $this->createForm(RestrictionType::class, $restriction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Cette restriction a été modifiée avec succès');
            return $this->redirectToRoute('restriction_index');
        }

        return $this->render('restriction/edit.html.twig', [
            'restriction' => $restriction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="restriction_delete", methods={"DELETE"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function delete(Request $request, Restriction $restriction): Response
    {
        if ($this->isCsrfTokenValid('delete' . $restriction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($restriction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('restriction_index');
    }
}
