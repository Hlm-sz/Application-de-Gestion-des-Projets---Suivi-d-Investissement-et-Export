<?php

namespace App\DataFixtures;

use App\Entity\Secteur as EntitySecteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Secteur extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $secteur = new EntitySecteur();
        $secteur->setNom('Automobile');
        $manager->persist($secteur);

        $secteur1 = new EntitySecteur();
        $secteur1->setNom('Aéronautique');
        $manager->persist($secteur1);

        $secteur2 = new EntitySecteur();
        $secteur2->setNom('Textile');
        $manager->persist($secteur2);

        $secteur3 = new EntitySecteur();
        $secteur3->setNom('TIC & Offshoring');
        $manager->persist($secteur3);

        $secteur4 = new EntitySecteur();
        $secteur4->setNom('Autre');
        $manager->persist($secteur4);

        $manager->flush();
    }
}
