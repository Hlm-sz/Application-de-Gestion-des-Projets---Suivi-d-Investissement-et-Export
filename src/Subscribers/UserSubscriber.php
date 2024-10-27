<?php

namespace App\Subscribers;

use App\Entity\Compte;
use App\Entity\User;
use App\Utils\Uploader\FileUploader;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use phpDocumentor\Reflection\File;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserSubscriber implements EventSubscriber
{

    private $em;
    private $passwordEncoder;
    private $fileUploader;
    private $container;


    public function __construct(ContainerInterface $container,EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder,FileUploader $fileUploader)
    {
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
        $this->fileUploader=$fileUploader;
        $this->container=$container;
    }
    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return string[]
     */
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
          //  Events::postLoad
        ];
    }

 /*   public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
      /*  if ($entity instanceof User) {
            if($entity->getPhoto()){
                $entity->setPhoto(
                    new \Symfony\Component\HttpFoundation\File($this->container->getParameter('uploader_directory').'/'.$entity->getPhoto())
                );
            }
        }

    }*/

    public function prePersist(LifecycleEventArgs $args)
    {

        $entity = $args->getEntity();
        if ($entity instanceof User) {
            $file = $entity->getPhoto();

            if($file){

                $filename = $this->fileUploader->upload($file);
                $entity->setPhoto($filename);
            }
            $entity->setPassword($this->passwordEncoder->encodePassword(
                $entity,
                $entity->getPassword()
            ));
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {

        $entity = $args->getEntity();
        if ($entity instanceof User) {
            if ($args->hasChangedField('password')) {
                if ($args->getNewValue('password') == "NULL") {
                    $args->setNewValue('password', $args->getOldValue('password'));
                } else {
                    $entity->setPassword($this->passwordEncoder->encodePassword(
                        $entity,
                        $args->getNewValue('password')
                    ));
                }
            }
            $isissetFile = true;
            if ($args->hasChangedField('photo') !== true) {
                $isissetFile = false;
            }

            if ($isissetFile === true) {

                if (!is_null($args->getNewValue('photo'))) {
                    $file = $args->getEntity()->getPhoto();
                    //dd($file);
                    $filename = $this->fileUploader->upload($file);
                    $args->setNewValue('photo', $filename);

                }
                else if(!is_null($args->getOldValue('photo'))){
                    $args->getEntity()->setPhoto($args->getOldValue('photo'));
                }
            }
        }
    }
}
