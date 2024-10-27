<?php

namespace App\DataFixtures;

use App\Entity\Groupe as EntityGroupe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Groupe extends Fixture implements DependentFixtureInterface
{
    /*$liste_groupe =
            [
                "Administrateurs",
                "BD",
                "DGPAC",
                "DS",
                "DT",
                "RH",
                "DGsd"
            ];*/
    public function load(ObjectManager $manager)
    {
        //creation Groupe 
        $groupe = new EntityGroupe();
        $groupe->setGroupe("Administrateurs");
        $groupe->setRole($this->getReference('role'));
        $manager->persist($groupe);
        $this->addReference('groupe', $groupe);

        $groupe1 = new EntityGroupe();
        $groupe1->setGroupe("BD");
        $groupe1->setRole($this->getReference('role1'));
        $manager->persist($groupe1);

        $groupe2 = new EntityGroupe();
        $groupe2->setGroupe("DGPAC");
        $groupe2->setRole($this->getReference('role2'));
        $manager->persist($groupe2);

        $groupe3 = new EntityGroupe();
        $groupe3->setGroupe("DS");
        $groupe3->setRole($this->getReference('role3'));
        $manager->persist($groupe3);

        $groupe6 = new EntityGroupe();
        $groupe6->setGroupe("DT");
        $groupe6->setRole($this->getReference('role6'));
        $manager->persist($groupe3);

        $groupe4 = new EntityGroupe();
        $groupe4->setGroupe("RH");
        $groupe4->setRole($this->getReference('role4'));
        $manager->persist($groupe4);

        $groupe5 = new EntityGroupe();
        $groupe5->setGroupe("DGsd");
        $groupe5->setRole($this->getReference('role5'));
        $manager->persist($groupe5);


        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            Role::class
        );
    }
}
