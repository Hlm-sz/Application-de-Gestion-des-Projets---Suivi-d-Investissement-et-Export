<?php

namespace App\Controller;

use App\Entity\Region;
use App\Form\RegionsType;
use App\Repository\RegionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/regions")
 */
class RegionsController extends AbstractController
{
    /**
     * @Route("/", name="regions_index", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function index(Request $request, PaginatorInterface $paginator, RegionRepository $regionRepository): Response
    {
        $regions = $paginator->paginate(
            $regionRepository->findBy(['isDeleted' => false]),
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
        );
        return $this->render('regions/index.html.twig', [
            'regions' => $regions,
        ]);
    }

    /**
     * @Route("/new", name="regions_new", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function new(Request $request): Response
    {
        $region = new Region();
        $form = $this->createForm(RegionsType::class, $region);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pay->setIsDeleted(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($region);
            $entityManager->flush();

            return $this->redirectToRoute('regions_index');
        }

        return $this->render('regions/new.html.twig', [
            'pay' => $pay,
            'form' => $form->createView(),
        ]);
    }
      /**
     * @Route("/bulk", name="regions_bulk", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function Bulk(Request $request): Response
    {


        $countries = array (
            '1'=>'Tanger-Tétouan-Al Hoceïma',
            '2'=>'Oriental',
            '3'=>'Fès-Meknès',
            '4'=>'Rabat-Salé-Kénitra',
            '5'=>'Béni Mellal-Khénifra',
            '6'=>'Casablanca-Settat',
            '7'=>'Marrakech-Safi',
            '8'=>'Drâa-Tafilalet',
            '9'=>'Souss-Massa',
            '10'=>'Guelmim-Oued Noun',
            '11'=>'Laâyoune-Sakia El Hamra',
            '12'=>'Dakhla-Oued Ed Dahab',
        );
        foreach($countries as $countrie){
            $region = new Region();
            $region->setNom($countrie);
            $region->setIsDeleted(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($region);
            $entityManager->flush();
        }
        return $this->redirectToRoute('regions_index'); 

         
    }

    /**
     * @Route("/{id}", name="regions_show", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function show(Region $region): Response
    {
        return $this->render('regions/show.html.twig', [
            'region' => $region,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="regions_edit", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function edit(Request $request, Region $pay): Response
    {
        $form = $this->createForm(RegionsType::class, $region);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pays_index');
        }

        return $this->render('regions/edit.html.twig', [
            'region' => $region,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="regions_delete", methods={"DELETE"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function delete(Request $request, Region $region): Response
    {
        if ($this->isCsrfTokenValid('delete' . $region->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $region->setIsDeleted(true);
            $entityManager->persist($region);
            $entityManager->flush();
        }

        return $this->redirectToRoute('regions_index');
    }
}
