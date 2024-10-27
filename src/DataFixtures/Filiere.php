<?php

namespace App\DataFixtures;

use App\Entity\EcosystemeFiliere;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Filiere extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $filiere = new EcosystemeFiliere();
        $filiere->setNom("filiere 1");
        $manager->persist($filiere);

        $filiere2 = new EcosystemeFiliere();
        $filiere2->setNom("filiere 2");
        $manager->persist($filiere2);

        $filiere3 = new EcosystemeFiliere();
        $filiere3->setNom("filiere 3");
        $manager->persist($filiere3);

        $filiere4 = new EcosystemeFiliere();
        $filiere4->setNom("filiere 4");
        $manager->persist($filiere4);

        $filiere5 = new EcosystemeFiliere();
        $filiere5->setNom("filiere 5");
        $manager->persist($filiere5);

        $manager->flush();
    }
}
