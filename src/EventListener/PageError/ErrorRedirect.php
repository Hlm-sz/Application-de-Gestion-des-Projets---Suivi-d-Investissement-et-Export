<?php


namespace App\EventListener\PageError;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


class ErrorRedirect
{

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @var GetResponseForExceptionEvent $event
     * @return null
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // if (!$event->getException() instanceof NotFoundHttpException) {
        //     return;
        // }

        // $response = new RedirectResponse($this->router->generate('user_index'));

        // $event->setResponse($response);

        if ($event->getException() instanceof NotFoundHttpException) {
            $response = new RedirectResponse($this->router->generate('404_page'));
            $event->setResponse($response);
        }
        elseif($event->getException() instanceof AccessDeniedHttpException) {
            $response = new RedirectResponse($this->router->generate('403_page'));
            $event->setResponse($response);

        } 
              
    }
}