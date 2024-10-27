<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Groupe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class ProjetVoter extends Voter
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
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['CREATION_DE_PROJET', 'CONSULTER_LE_PROJET','MODIFIER_PROJET','SUPRIMER_UN_PROJET',
        'CONSULTER_UN_PROJET_CONFIDENTIEL','CHERCHER_UN_PROJET','CHANGER_LE_STATUT_PROJET','ACTIONS_PROJETS'])
            && $subject instanceof \App\Entity\Projets;
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
            case 'CREATION_DE_PROJET':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('CREATION_DE_PROJET', $id_groupe) ? true : false;
                }
                break;
            case 'CONSULTER_LE_PROJET':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('CONSULTER_LE_PROJET', $id_groupe) ? true : false;
                }
                break;
            case 'CHERCHER_UN_PROJET':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('CHERCHER_UN_PROJET', $id_groupe) ? true : false;
                }
                break;
            case 'MODIFIER_PROJET':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('MODIFIER_PROJET', $id_groupe) ? true : false;
                }
                break;
            case 'SUPRIMER_UN_PROJET':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('SUPRIMER_UN_PROJET', $id_groupe) ? true : false;
                }
                break;
            case 'CONSULTER_UN_PROJET_CONFIDENTIEL':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('CONSULTER_UN_PROJET_CONFIDENTIEL', $id_groupe) ? true : false;
                }
                break;
            case 'CHANGER_LE_STATUT_PROJET':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('CHANGER_LE_STATUT_PROJET', $id_groupe) ? true : false;
                }
                break;
            case 'ACTIONS_PROJETS':
                if ($this->user) {
                    $id_groupe = $this->user->getGroupe()->getId();
                    return $this->em->getRepository(Groupe::class)->isPermissionGroupe('ACTIONS_PROJETS', $id_groupe) ? true : false;
                }
                break;                            
        }

        return false;
    }
}
