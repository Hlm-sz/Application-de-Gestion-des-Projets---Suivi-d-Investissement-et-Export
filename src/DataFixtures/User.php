<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User as EntityUser;

class User extends Fixture implements DependentFixtureInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {


        $user = new EntityUser();
        $user->setEmail('notif-crm@amdie.gov.ma');
        $user->setNom('ammor');
        $user->setPrenom('ayoub');
        $user->setGroupe($this->getReference('groupe'));
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            '123456'
        ));
        $manager->persist($user);
        $manager->flush();
    }
    public function getDependencies()
    {
        return array(
            Groupe::class
        );
    }
}
