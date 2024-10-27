<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Groupe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class ContactVoter extends Voter

{
    private $em;
    private $user;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->user = $security->getUser();
    }

    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['CREATION_DE_CONTACT', 'CONSULTER_CONTACT','CONSULTER_CONTACT_CONFIDENTIEL',
        'MODIFIER_LE_CONTACT','QUALIFIER_UN_CONTACT','SUPPRIMER_UN_CONTACT','VALIDER_UN_CONTACT','AFFECTER_UN_CONTACT_A_UN_COMPTE','IMPORTATION_DES_FICHIERS_DE_DONNEES'])
            && $subject instanceof \App\Entity\Contact;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'CONSULTER_CONTACT':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('CONSULTER_CONTACT', $id_groupe) ? true : false;
                }
              
            break;
            case 'CREATION_DE_CONTACT':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('CREATION_DE_CONTACT', $id_groupe) ? true : false;
                }
              
            break;
            case 'MODIFIER_LE_CONTACT':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('MODIFIER_LE_CONTACT', $id_groupe) ? true : false;
                }
              
            break;
            case 'QUALIFIER_UN_CONTACT':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('QUALIFIER_UN_CONTACT', $id_groupe) ? true : false;
                }
              
            break;
            case 'SUPPRIMER_UN_CONTACT':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('SUPPRIMER_UN_CONTACT', $id_groupe) ? true : false;
                }
              
            break;
            case 'VALIDER_UN_CONTACT':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('VALIDER_UN_CONTACT', $id_groupe) ? true : false;
                }
              
            break;
            case 'AFFECTER_UN_CONTACT_A_UN_COMPTE':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('AFFECTER_UN_CONTACT_A_UN_COMPTE', $id_groupe) ? true : false;
                }
              
            break;
            case 'CONSULTER_CONTACT_CONFIDENTIEL':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('CONSULTER_CONTACT_CONFIDENTIEL', $id_groupe) ? true : false;
                }
            case 'IMPORTATION_DES_FICHIERS_DE_DONNEES':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('IMPORTATION_DES_FICHIERS_DE_DONNEES', $id_groupe) ? true : false;
                }    
              
            break;
        }

        return false;
    }
}




	

