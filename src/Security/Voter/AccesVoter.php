<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
//use App\Utils\Acces;
use App\Utils\Permission;

class AccesVoter extends Voter
{
    private $permission;


    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    protected function supports($attribute, $subject)
    {
        //dd($attribute);
        return $this->permission->has_permission($attribute);
        
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }
        return true;
    }
}
