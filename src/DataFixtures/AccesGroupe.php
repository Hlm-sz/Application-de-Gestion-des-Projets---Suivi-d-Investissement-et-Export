<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AccesGroupe extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /* $accesGroupe = new EntityAccesGroupe();
        $accesGroupe->setGroupe($this->getReference('groupe'));
        $accesGroupe->setAcces($this->getReference('acces'));
        $accesGroupe->setIsAcces(1);
        $manager->persist($accesGroupe);

        $manager->flush();*/
    }
    public function getDependencies()
    {
        /* return [
            Groupe::class,
            Acces::class
        ];*/
    }
}
