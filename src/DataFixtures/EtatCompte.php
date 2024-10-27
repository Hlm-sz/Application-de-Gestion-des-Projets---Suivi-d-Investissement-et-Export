<?php

namespace App\DataFixtures;

use App\Entity\EtatCompte as EntityEtatCompte;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EtatCompte extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $etatCompte = new EntityEtatCompte();
        $etatCompte->setNom("Prospection");
        $manager->persist($etatCompte);

        $etatCompte1 = new EntityEtatCompte();
        $etatCompte1->setNom("Considération");
        $manager->persist($etatCompte1);

        $etatCompte2 = new EntityEtatCompte();
        $etatCompte2->setNom("Intérêt");
        $manager->persist($etatCompte2);

        $etatCompte3 = new EntityEtatCompte();
        $etatCompte3->setNom("Décision");
        $manager->persist($etatCompte3);

        $etatCompte4 = new EntityEtatCompte();
        $etatCompte4->setNom("Suivi");
        $manager->persist($etatCompte4);

        $etatCompte5 = new EntityEtatCompte();
        $etatCompte5->setNom("Fermé");
        $manager->persist($etatCompte5);

        $manager->flush();
    }
}
