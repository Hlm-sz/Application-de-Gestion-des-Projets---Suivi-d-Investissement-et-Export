<?php

namespace App\Controller;

use App\Entity\Role;
use App\Form\RoleType;
use App\Repository\RoleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/role")
 */
class RoleController extends AbstractController
{
    /**
     * @Route("/", name="role_index", methods={"GET"})
     */

    public function index(Request $request, PaginatorInterface $paginator, RoleRepository $roleRepository): Response
    {

        return $this->render('role/index.html.twig');
    }


    /**
     * @Route("/ajax_role", name="ajax_role", methods={"GET"})
     */
    public function ajaxListsRole(RoleRepository $roleRepository, TranslatorInterface $translator)
    {
        $data = array();
        $roles =   $roleRepository->findBy(['isDeleted' => false]);
        foreach ($roles as $role) {
            $permissions = "";
            foreach ($role->getPermissions() as $permission) {
                $permissions .= $permission->getNom() . ' <br>';
            }

            $edit = $this->generateUrl('role_edit', [
                'id' => $role->getId(),
            ]);
            $afficher = $this->generateUrl('role_show', [
                'id' => $role->getId(),
            ]);
            $actions = '<a class="btn btn-btn-blue" href=' . $afficher . '><i class="fa fa-eye"></i> ' . $translator->trans('compte.Show') . '</a>
            <a class="btn btn-btn-blue" href=' . $edit . '><i class="fa fa-edit"></i> ' . $translator->trans('compte.Edit') . '</a>';

            $data[] = array(
                "nom" => $role->getRole(),
                "permissions" => $permissions,
                "actions" => $actions
            );
        }

        $output = array(
            "TotalRecords" => count($roles),
            "TotalDisplayRecords" => 10,
            "data" => $data,
        );

        return new Response(json_encode($output));
    }



    /**
     * @Route("/new", name="role_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $role = new Role();
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role->setIsDeleted(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($role);
            $entityManager->flush();
            $this->addFlash('success', 'Le nouveau rôle a été créé avec succès');
            return $this->redirectToRoute('role_index');
        }

        return $this->render('role/new.html.twig', [
            'role' => $role,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="role_show", methods={"GET"})
     */
    public function show(Role $role): Response
    {
        return $this->render('role/show.html.twig', [
            'role' => $role,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="role_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Role $role): Response
    {
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Ce rôle a été modifié avec succès');
            return $this->redirectToRoute('role_index');
        }

        return $this->render('role/edit.html.twig', [
            'role' => $role,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="role_delete", methods={"DELETE"})
     * @Security("is_granted('SUPPRESSION_ROLE')")
     */
    public function delete(Request $request, Role $role): Response
    {
        if ($this->isCsrfTokenValid('delete' . $role->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            // $role->setIsDeleted(true);
            // $entityManager->persist($role);
            $entityManager->remove($role);
            $entityManager->flush();
        }

        return $this->redirectToRoute('role_index');
    }
}
