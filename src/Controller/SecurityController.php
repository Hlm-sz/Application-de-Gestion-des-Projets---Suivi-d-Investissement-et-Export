<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('projets_index');
        }
        //$request->headers->get('referer');
        //return $this->redirect($request->headers->get('referer'));
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        return $this->redirect($this->generateUrl('app_login'));
        //  return new RedirectResponse($this->urlGenerator->generate('app_login'));
        // throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    
    /**
     * @Route("/404", name="404_page")
     */
    public function page_404()
    {
        return $this->render('bundles/TwigBundle/Exception/error404.html.twig');
    }
    /**
     * @Route("/403", name="403_page")
     */
    public function page_403()
    {
        return $this->render('bundles/TwigBundle/Exception/error403.html.twig');
    }
}
