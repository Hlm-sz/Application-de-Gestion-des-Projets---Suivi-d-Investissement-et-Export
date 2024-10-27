<?php

namespace App\DataFixtures;

use App\Entity\Role as EntityRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Role extends Fixture
{



    public function load(ObjectManager $manager)
    {
        /*$liste_roles =
            [
                "Administrateurs",
                "Direction Generale",
                "Directeur Secteur",
                "Business Developers",
                "Directeur GPAC",
                "Responsable GPAC",
                "Directeur Transverse",
                "RH"
            ];*/
        //creation roles



        $role = new EntityRole();
        $role->setRole("Administrateurs");
        $manager->persist($role);
        $this->addReference('role', $role);


        $role1 = new EntityRole();
        $role1->setRole("Direction Generale");
        $manager->persist($role1);
        $this->addReference('role1', $role1);


        $role2 = new EntityRole();
        $role2->setRole("Directeur Secteur");
        $manager->persist($role2);
        $this->addReference('role2', $role2);

        $role3 = new EntityRole();
        $role3->setRole("Business Developers");
        $manager->persist($role3);
        $this->addReference('role3', $role3);

        $role4 = new EntityRole();
        $role4->setRole("Directeur GPAC");
        $manager->persist($role4);
        $this->addReference('role4', $role4);

        $role5 = new EntityRole();
        $role5->setRole("Responsable GPAC");
        $manager->persist($role5);
        $this->addReference('role5', $role5);

        $role6 = new EntityRole();
        $role6->setRole("Directeur Transverse");
        $manager->persist($role6);
        $this->addReference('role6', $role6);

        $role7 = new EntityRole();
        $role7->setRole("RH");
        $manager->persist($role7);
        $this->addReference('role7', $role7);

        $manager->flush();
    }
}
