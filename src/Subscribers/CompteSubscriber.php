<?php

namespace App\Subscribers;

use App\Entity\Compte;
use App\Entity\Projets;
use App\Entity\User;
use App\Utils\Uploader\FileUploader;
use App\Utils\Workflow\ProjetWorkflowHandler;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\PostLoad;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CompteSubscriber implements EventSubscriber
{

    private $fileUploader;
    private $container;
    private $user;
    public function __construct(FileUploader $fileUploader,ContainerInterface $container,TokenStorageInterface $user)
    {
        $this->fileUploader=$fileUploader;
        $this->container=$container;
        $this->user=$user;
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
            Events::postLoad
        ];
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Compte) {
            if($entity->getLogo()){
                $entity->setLogo(
                    new File($this->container->getParameter('uploader_directory').'/'.$entity->getLogo())
                );
            }
        }

    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Compte) {
            $entity->setSignalement(false);
            $user_token = $this->user->getToken()->getUser();
            $entity->setCreePar($user_token);
            $entity->setResponsableCompte($user_token);
            $entity->setDateCreation(new \DateTimeImmutable());
            $file = $entity->getLogo();

            if($file){

                $filename = $this->fileUploader->upload($file);
                $entity->setLogo($filename);
            }
        }

    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof Compte) {
            // $user_token = $this->user->getToken()?$this->user->getToken()->getUser():null;
            // if($user_token){
            //     $entity->setModifiePar($user_token);
            //     $entity->setDateModification(new \DateTimeImmutable());
            // }
            $isissetFile = true;
            if ($args->hasChangedField('logo') !== true) {
                $isissetFile = false;
            }
            if ($isissetFile === true) {
 
                if (is_null($args->getNewValue('logo'))) {
                    if(!is_null($args->getOldValue('logo'))){
                       // dd($args->getOldValue('logo'));
                        $args->setNewValue('logo', $args->getOldValue('logo'));
                    }else{
                        $args->setNewValue('logo',null);
                    }
                }else{
                    $file = $args->getEntity()->getLogo();
                    //dd($file,$args->getNewValue('logo'),$args->getOldValue('logo'));
                    if($file instanceof UploadedFile){
                        if($file->getClientOriginalName()!=$args->getOldValue('logo')){
                            $filename = $this->fileUploader->upload($file);
                            $args->setNewValue('logo', $filename);
                        }else{
                            $args->setNewValue('logo', $file->getClientOriginalName());
                        }
                    }else{
                        $args->setNewValue('logo', $args->getOldValue('logo'));
                    }
                }
            }
            /* $isissetFile = true;
             if ($args->hasChangedField('logo') !== true) {
                 $isissetFile = false;
             }
           //  $fileNew=$args->getNewValue('logo');
             $file = $args->getEntity()->getLogo();
             if ($isissetFile === true) {
               //  $file = $args->getEntity()->getLogo();

                 echo "1";
                 $file = $args->getEntity()->getLogo();
               //  dd($comparefiles);

                 $fileNew=$args->getNewValue('logo');
                $comparefiles=$this->compareObjects($file,$fileNew);
                dd($comparefiles,$fileNew,$file);
                     if (!is_null($args->getNewValue('logo'))) {

                         echo "1_1";
                         $filename = $this->fileUploader->upload($file);
                         $args->setNewValue('logo', $filename);


                         //  $this->fileManager->removeFile($args->getOldValue('logo'));


                     }
                     else if(!is_null($args->getOldValue('logo'))){
                         echo "1_2";
                         $args->getEntity()->setLogo($args->getOldValue('logo'));
                     }else{
                         echo "1_3";
                         $args->getEntity()->setLogo($file);
                     }
                 }

             }else{
                 echo "2";
                 $args->getEntity()->setLogo($args->getEntity()->getLogo());
             }
        // dd($file);*/
        }

    }
    function bool2str($bool)
    {
        if ($bool === false) {
            return false;
        } else {
            return true;
        }
    }
    function compareObjects(&$o1, &$o2)
    {
        return $this->bool2str($o1 == $o2);
    }
}
