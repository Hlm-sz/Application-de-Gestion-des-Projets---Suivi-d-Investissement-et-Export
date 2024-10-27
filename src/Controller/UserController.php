<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use App\Form\EditUserType;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig');
    }

    /**
     * @Route("/ajax_user", name="ajax_user", methods={"GET"})
     */
    public function ajaxListsUser(UserRepository $userRepository, TranslatorInterface $translator)
    {
        $data = array();
        $users =   $userRepository->findBy(['isDeleted' => false]);
        foreach ($users as $user) {
            $secteurs = "";
            foreach ($user->getSecteurs() as $secteur) {
                $secteurs .= $secteur->getNom() . ' <br>';
            }

            $edit = $this->generateUrl('user_edit', [
                'id' => $user->getId(),
            ]);
            $afficher = $this->generateUrl('user_show', [
                'id' => $user->getId(),
            ]);
            $actions = '<a class="btn btn-btn-blue" href=' . $afficher . '><i class="fa fa-eye"></i> ' . $translator->trans('compte.Show') . '</a>
            <a class="btn btn-btn-blue" href=' . $edit . '><i class="fa fa-edit"></i> ' . $translator->trans('compte.Edit') . '</a>';

            $data[] = array(
                "nom" => $user->getNom(),
                "prenom" => $user->getPrenom(),
                "email" => $user->getEmail(),
                "groupe" => $user->getGroupe()->getNom(),
                "secteurs" => $secteurs,
                "actions" => $actions
            );
        }

        $output = array(
            "TotalRecords" => count($users),
            "TotalDisplayRecords" => 10,
            "data" => $data,
        );

        return new Response(json_encode($output));
    }


    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setIsDeleted(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Le nouveau compte a été créé avec succès');
            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Cet utilisateur a été modifier avec succès');
            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="user_delete", methods={"DELETE"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $user->setIsDeleted(true);
            $entityManager->persist($user);
            // $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
    /**
     * @Route("/handle_search_users/{_query?}", name="handle_search_users", methods={"POST", "GET"})
     */
    public function handleSearchRequest(Request $request, $_query)
    {
        $em = $this->getDoctrine()->getManager();

        if ($_query)
        {
            $data = $em->getRepository(User::class)->searchCompteByName($_query);
        } else {
            $data = $em->getRepository(User::class)->listeCompteWhitName();
        }
        return new JsonResponse(json_encode($data), 200, [], true);
    }


    /**
     * @Route("/{id}/profile", name="user_edit_profile", methods={"GET","POST"})
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function profile(Request $request, User $user): Response
    {
        $form = $this->createFormBuilder($user)
        ->add('prenom',TextType::class,['label_format' => 'user.Prenom'])
        ->add('nom',TextType::class,['label_format' => 'user.Nom'])
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Les champs du mot de passe doivent correspondre.',
            'options' => ['attr' => ['class' => 'password-field']],
            'required' => true,
            'first_options'  => ['label_format' => 'user.Password'],
            'second_options' => ['label' => 'Répéter le mot de passe'],
        ])->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Cet utilisateur a été modifier avec succès');
            return $this->redirectToRoute('projets_index');
        }
        return $this->render('user/monprofile.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
