<?php

namespace App\DataFixtures;

use App\Entity\TypeCompte as EntityTypeCompte;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeCompte extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $type = new EntityTypeCompte();
        $type->setNom("Exportateur");
        $manager->persist($type);


        $type1 = new EntityTypeCompte();
        $type1->setNom("Investisseur");
        $manager->persist($type1);

        $type2 = new EntityTypeCompte();
        $type2->setNom("D.O");
        $manager->persist($type2);

        $manager->flush();
    }
}
