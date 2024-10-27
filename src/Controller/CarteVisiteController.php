<?php

namespace App\Controller;

use App\Entity\CarteVisite;
use App\Form\CarteVisiteType;
use App\Repository\CarteVisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/carte/visite")
 */
class CarteVisiteController extends AbstractController
{
    /**
     * @Route("/", name="carte_visite_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('carte_visite/index.html.twig');
    }

    /**
     * @Route("/ajax_carte_visite", name="ajax_carte_visite", methods={"POST"})
     */
    public function ajaxListsCarteVisite(CarteVisiteRepository $carteVisiteRepository, TranslatorInterface $translator)
    {
        $data = array();
        $cartesVisite =   $carteVisiteRepository->findAll();
        foreach ($cartesVisite as $carteVisite) {

            $edit = $this->generateUrl('carte_visite_edit', [
                'id' => $carteVisite->getId(),
            ]);
            $afficher = $this->generateUrl('carte_visite_show', [
                'id' => $carteVisite->getId(),
            ]);
            $actions = '<a class="btn btn-btn-blue" href=' . $afficher . '><i class="fa fa-eye"></i> ' . $translator->trans('compte.Show') . '</a>
            <a class="btn btn-btn-blue" href=' . $edit . '><i class="fa fa-edit"></i> ' . $translator->trans('compte.Edit') . '</a>';

            $data[] = array(
                "fonction" => $carteVisite->getFonction(),
                "tel" => $carteVisite->getTel(),
                "tel2" => $carteVisite->getTel2(),
                "email" => $carteVisite->getEmail(),
                "adresse" => $carteVisite->getAdresse(),
                "web" => $carteVisite->getWeb(),
                "contact" => $carteVisite->getContact()->getPrenom() . ' ' . $carteVisite->getContact()->getNom(),
                "actions" => $actions
            );
        }

        $output = array(
            "TotalRecords" => count($cartesVisite),
            "TotalDisplayRecords" => 10,
            "data" => $data,
        );

        return new Response(json_encode($output));
    }


    /**
     * @Route("/new", name="carte_visite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $carteVisite = new CarteVisite();
        $form = $this->createForm(CarteVisiteType::class, $carteVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($carteVisite);
            $entityManager->flush();

            return $this->redirectToRoute('carte_visite_index');
        }

        return $this->render('carte_visite/new.html.twig', [
            'carte_visite' => $carteVisite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_visite_show", methods={"GET"})
     */
    public function show(CarteVisite $carteVisite): Response
    {
        return $this->render('carte_visite/show.html.twig', [
            'carte_visite' => $carteVisite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="carte_visite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CarteVisite $carteVisite): Response
    {
        $form = $this->createForm(CarteVisiteType::class, $carteVisite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('carte_visite_index');
        }

        return $this->render('carte_visite/edit.html.twig', [
            'carte_visite' => $carteVisite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="carte_visite_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CarteVisite $carteVisite): Response
    {
        $contact = $this->getDoctrine()->getRepository(Contact::class)->find($id);

        if ($this->isCsrfTokenValid('delete' . $carteVisite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($carteVisite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carte_visite_index');
    }
   
}
