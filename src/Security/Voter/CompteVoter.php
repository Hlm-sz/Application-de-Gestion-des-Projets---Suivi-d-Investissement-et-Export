<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Groupe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class CompteVoter extends Voter

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
         
        return in_array($attribute, ['CREATION_DE_COMPTE','TYPE_ORGANISATION_PARTENAIRE','CHERCHER_UN_COMPTE','MODIFIER_COMPTE',
        'SUPRIMER_UN_COMPTE','CONSULTER_COMPTE','IMPORTATION_DES_FICHIERS_DE_DONNEES_COMPTE','AFFECTER_UN_COMPTE_A_UN_CRM_USER'])
            && $subject instanceof \App\Entity\Compte;
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
            case 'CREATION_DE_COMPTE':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('CREATION_DE_COMPTE', $id_groupe) ? true : false;
                }
                break;
            case 'TYPE_ORGANISATION_PARTENAIRE':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('TYPE_ORGANISATION_PARTENAIRE', $id_groupe) ? true : false;
                }
                break;
        
            case 'CHERCHER_UN_COMPTE':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('CHERCHER_UN_COMPTE', $id_groupe) ? true : false;
                }
                break;
            case 'MODIFIER_COMPTE':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('MODIFIER_COMPTE', $id_groupe) ? true : false;
                }
                break;
            case 'SUPRIMER_UN_COMPTE':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('SUPRIMER_UN_COMPTE', $id_groupe) ? true : false;
                }
                break;
            case 'IMPORTATION_DES_FICHIERS_DE_DONNEES_COMPTE':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('IMPORTATION_DES_FICHIERS_DE_DONNEES_COMPTE', $id_groupe) ? true : false;
                }
                break;
            case 'AFFECTER_UN_COMPTE_A_UN_CRM_USER':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('AFFECTER_UN_COMPTE_A_UN_CRM_USER', $id_groupe) ? true : false;
                }
                break;
            case 'CONSULTER_COMPTE':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('CONSULTER_COMPTE', $id_groupe) ? true : false;
                }
                break;     
            
            
        }

        return false;
    }
}
