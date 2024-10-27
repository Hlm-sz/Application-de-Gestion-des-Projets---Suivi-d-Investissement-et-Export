<?php

namespace App\DataFixtures;

use App\Entity\Pays as EntityPays;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Pays extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $pays = new EntityPays();
        $pays->setNom('France');
        $manager->persist($pays);

        $pays1 = new EntityPays();
        $pays1->setNom('Maroc');
        $manager->persist($pays1);

        $pays2 = new EntityPays();
        $pays2->setNom('Canada');
        $manager->persist($pays2);

        $pays3 = new EntityPays();
        $pays3->setNom('Italie');
        $manager->persist($pays3);

        $pays4 = new EntityPays();
        $pays4->setNom('Allemagne');
        $manager->persist($pays4);

        $pays5 = new EntityPays();
        $pays5->setNom('Argentine');
        $manager->persist($pays5);

        $pays6 = new EntityPays();
        $pays6->setNom('Australie');
        $manager->persist($pays6);

        $pays7 = new EntityPays();
        $pays7->setNom('Belgique');
        $manager->persist($pays7);

        $manager->flush();
    }
}
