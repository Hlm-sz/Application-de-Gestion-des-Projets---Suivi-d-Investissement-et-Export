<?php

namespace App\Controller;

use App\Entity\Permission;
use App\Form\PermissionType;
use App\Repository\PermissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/permission")
 */
class PermissionController extends AbstractController
{
    /**
     * @Route("/", name="permission_index", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function index(): Response
    {
        return $this->render('permission/index.html.twig');
    }

    /**
     * @Route("/ajax_permission", name="ajax_permission", methods={"POST"})
     */
    public function ajaxListsPermission(Request $request, PermissionRepository $permissionRepository, TranslatorInterface $translator)
    {
        if ($request->getMethod() == 'POST') {
            $draw = intval($request->request->get('draw'));
            $start = $request->request->get('start');
            $length = $request->request->get('length');
            $search = $request->request->get('search');
            $orders = $request->request->get('order');
            $columns = $request->request->get('columns');
        } else
            die;

        foreach ($orders as $key => $order) {
            $orders[$key]['name'] = $columns[$order['column']]['data'];
        }

        $otherConditions = "";

        $results =  $permissionRepository->getRequiredDTData($start, $length, $orders, $search, $columns, $otherConditions = null);

        $permissions = $results["results"];

        $total_objects_count = $permissionRepository->getCount();

        $filtered_objects_count = $results["countResult"];

        $data = array();

        foreach ($permissions as $permission) {


            $edit = $this->generateUrl('permission_edit', [
                'id' => $permission->getId(),
            ]);
            $afficher = $this->generateUrl('permission_show', [
                'id' => $permission->getId(),
            ]);
            $actions = '<a class="btn btn-btn-blue" href=' . $afficher . '><i class="fa fa-eye"></i> ' . $translator->trans('compte.Show') . '</a>
            <a class="btn btn-btn-blue" href=' . $edit . '><i class="fa fa-edit"></i> ' . $translator->trans('compte.Edit') . '</a>';

            $data[] = array(
                "nom" => $permission->getNom(),
                "nom_constant" => $permission->getNomConstant(),
                "active" => $permission->getIsActive() ? 'Oui' : 'Non',
                "actions" => $actions
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_objects_count,
            "recordsFiltered" => $filtered_objects_count,
            "data" => $data,
        );


        return new Response(json_encode($output));
    }

    /**
     * @Route("/new", name="permission_new", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function new(Request $request): Response
    {
        $permission = new Permission();
        $form = $this->createForm(PermissionType::class, $permission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($permission);
            $entityManager->flush();
            $this->addFlash('success', 'La nouvelle permission a été créée avec succès');
            return $this->redirectToRoute('permission_index');
        }

        return $this->render('permission/new.html.twig', [
            'permission' => $permission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="permission_show", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function show(Permission $permission): Response
    {
        return $this->render('permission/show.html.twig', [
            'permission' => $permission,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="permission_edit", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function edit(Request $request, Permission $permission): Response
    {
        $form = $this->createForm(PermissionType::class, $permission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Cette permission a été modifiée avec succès');
            return $this->redirectToRoute('permission_index');
        }

        return $this->render('permission/edit.html.twig', [
            'permission' => $permission,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="permission_delete", methods={"DELETE"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function delete(Request $request, Permission $permission): Response
    {
        if ($this->isCsrfTokenValid('delete' . $permission->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($permission);
            $entityManager->flush();
        }

        return $this->redirectToRoute('permission_index');
    }
}
