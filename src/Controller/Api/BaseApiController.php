<?php

namespace App\Controller\Api;

use App\Entity\BaseListe;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Route("api/base_list")
 */

class BaseApiController extends AbstractController
{
    /**
     * @Route("/newbase", name="api_email_new", methods={"POST"})
     */
    public function newEmail(Request $request): Response
    {
        $response = new Response();
        if($request->headers->get('authorization')){
            $em=$this->getDoctrine()->getManager();
            $email=$request->request->get('email');
            $profil = new BaseListe();
            $profil->setEmail($email);
            $profil->setDateCreation(new \DateTime());
            $em=$this->getDoctrine()->getManager();
            $em->persist($profil);
            $em->flush();
            $data=array('code'=>200,'message'=> 'ok');
        }
    else{
        $data=array('code'=>403,'message'=> 'HTTP/1.1 403 Forbidden');
    }
    $response->setContent(json_encode($data));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
    }
}
