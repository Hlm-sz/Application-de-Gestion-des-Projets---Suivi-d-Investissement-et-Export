<?php

namespace App\Controller;

use DateTime;
use App\Entity\Mail;
use App\Form\MailType;
use App\Entity\Contact;
use App\Form\MailFilterType;
use App\FiltreData\EmailFiltre;
use App\Form\ContactFiltreType;
use Symfony\Component\Mime\Email;
use App\Repository\MailRepository;
use App\Form\EmailContactFiltreType;
use App\Repository\ContactRepository;
use App\FiltreData\EmailContactFiltre;
use App\Repository\TypeMailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
     * @Route("/email")
*/
class MailController extends AbstractController
{
    /**
     * @Route("/", name="emails_index")
     */
    public function index(int $id=null,Request $request,MailRepository $emailRepository): Response
    {
        $data = new EmailFiltre();
        $form = $this->createForm(MailFilterType::class, $data);
        $form->handleRequest($request);

        $email = new Mail();
        // $emails = $emailRepository->findSearch($data);
        $emails = $emailRepository->findAll();
        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
            'form' => $form->createView(),
            'email' => $email,
            'emails' => $emails,
        ]);
    }

    /**
     * @Route("/filtre", name="emails_filtre", methods={"GET"})
     *
    */
    public function filterEmail(Request $request, MailRepository $MailRepository,TypeMailRepository $typemailRepository): Response {

        $data = new EmailFiltre();
        $form = $this->createForm(MailFilterType::class, $data);
        $form->handleRequest($request);

        $emails= $MailRepository->findSearch($data);

        return $this->render('mail/filtre/index.html.twig', [
            'form' => $form->createView(),
            'type_email' => $typemailRepository->findAll(),
            'emails' => $emails,
        ]);
    }

    /**
     * @Route("/new", name="new_email")
     */

    public function new(Request $request,MailRepository $emailRepository,MailerInterface $mailer,ContactRepository $contactRepository): Response
    {

        // formulaire filtre
        $data = new EmailFiltre();
        $form = $this->createForm(MailFilterType::class, $data);
        $form->handleRequest($request);

        // liste des contacts filtrés
        $contact= new Contact();
        $contacts= $contactRepository->Contacts($data);
        //dd($contacts);

        // formulaire new email && la date d'envoi d'email
        $email = new Mail();
        $email-> setDateEnvoi(new DateTime('NOW'));
        $formEmail = $this->createForm(MailType::class, $email,[
            'contact' =>$contacts,
        ]
        );
        $formEmail->handleRequest($request);

        //get the email of current user
        $me = $this->getUser()->getEmail();
        //$Tocontacts=$contactRepository->Contact();

        if($formEmail->isSubmitted()){

            // On récupère le contenu de la forme
            $object= $formEmail->get('objet')->getData();
            $content = $formEmail->get('contenu')->getData();
            $Tocontacts = $formEmail->get('contact')->getData();


            foreach ($Tocontacts as $em) {
                $eml=$em->getEmail();
                //dd($eml);

                $mail = (new Email())
                ->from($me)
                ->to($eml)
                ->subject($object)
                ->text($content)
                ->html('<p>See Twig integration for better HTML integration!</p>');
                $mailer->send($mail);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($email);
            $entityManager->flush();
            $this->addFlash('success', 'Email été envoyé avec succès');
            return $this->redirectToRoute('emails_index');
        }

        return $this->render('mail/filtre_contact/index.html.twig', [

            'formemail' => $formEmail->createView(),
            'form' => $form->createView(),
            'contact' => $contacts,

        ]);


    }
    /**
     * @Route("/filtre_contacts", name="contacts_filtre")
     *
    */
    public function contacts(Request $request,EntityManagerInterface $em,MailerInterface $mailer, MailRepository $MailRepository,ContactRepository $contactRepository): Response {

        $data = new EmailFiltre();
        $form = $this->createForm(MailFilterType::class, $data);
        $form->handleRequest($request);
        $contacts= $contactRepository->contacts($data);

        $email = new Mail();
        $email-> setDateEnvoi(new DateTime('NOW'));
        $formEmail = $this->createForm(MailType::class, $email,[
            'contact' =>$contacts,
        ]
        );
        $formEmail->handleRequest($request);

        $me = $this->getUser()->getEmail();
        //$Tocontacts=$contactRepository->Contact();


        if($formEmail->isSubmitted()){

            // On récupère le contenu de la forme
            $object= $formEmail->get('objet')->getData();
            $content = $formEmail->get('contenu')->getData();
            $Tocontacts = $formEmail->get('contact')->getData();


            foreach ($Tocontacts as $em) {
                $eml=$em->getEmail();
                //dd($eml);

                $mail = (new Email())
                ->from($me)
                ->to($eml)
                ->subject($object)
                ->text($content)
                ->html('<p>See Twig integration for better HTML integration!</p>');
                $mailer->send($mail);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($email);
            $entityManager->flush();
            $this->addFlash('success', 'Email été envoyé avec succès');
            return $this->redirectToRoute('emails_index');
        }


        return $this->render('mail/filtre_contact/index.html.twig', [
            'form' => $form->createView(),
            'formemail' => $formEmail->createView(),
            'contact' =>  $contacts,

        ]);

    }

        /**
     * @Route("/sendtome", name="sendtome")
     *
    */
    public function send(Request $request,MailerInterface $mailer): Response {

        //get the email of current user
        $me = $this->getUser()->getEmail();

        $email = (new Email())
            ->from($me)
            ->to($me)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);

        $this->addFlash('success', 'Email été envoyé avec succès');
        return $this->redirectToRoute('emails_index');

    }



}
