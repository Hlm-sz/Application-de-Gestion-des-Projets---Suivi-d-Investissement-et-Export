<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Acces as EntityAcces;

class Acces extends Fixture
{

    public function load(ObjectManager $manager)
    {

        /*  $liste_acces =
            [
                'Création des roles',
                'Création des secteurs',
                'Supression des secteurs',
                'Création des utilisateurs',
                'Affecter un utilisateur à un secteur',
                'Création de contact',
                'Chercher un contact',
                'Chercher un contact',
                'Consulter contact',
                'Consulter contact confidentiel',
                'Modifier le contact',
                'Qualifier un contact',
                'Valider un contact',
                'Affecter un contact à un compte',
                'Supprimer un contact',
                'Importation des fichiers de données',
                "Validation de l'import",
                "Extraction de Contacts",
                "Extraction: Contacts Confidentiels",
                "Creation de compte",
                "Chercher un compte",
                "Consulter compte",
                "Consulter un compte confidentiel",
                "Type d'organisation Partenaire"
            ];*/

        //creation d'acces

        $acces = new EntityAcces();
        $acces->setNom("liste des roles");
        $acces->setNomConstant("LIST_ROLES");
        $manager->persist($acces);
        $this->addReference('acces', $acces);

        $acces1 = new EntityAcces();
        $acces1->setNom("Création des roles");
        $acces1->setNomConstant("CREATE_ROLE");
        $manager->persist($acces1);
        $this->addReference('acces1', $acces1);

        $acces2 = new EntityAcces();
        $acces2->setNom("modification des roles");
        $acces2->setNomConstant("EDIT_ROLE");
        $manager->persist($acces2);
        $this->addReference('acces2', $acces2);

        $acces3 = new EntityAcces();
        $acces3->setNom("detail des roles");
        $acces3->setNomConstant("SHOW_ROLE");
        $manager->persist($acces3);
        $this->addReference('acces3', $acces3);

        $acces4 = new EntityAcces();
        $acces4->setNom("suppression des roles");
        $acces4->setNomConstant("DELETE_ROLE");
        $manager->persist($acces4);
        $this->addReference('acces4', $acces4);

        $acces5 = new EntityAcces();
        $acces5->setNom("liste des secteurs");
        $acces5->setNomConstant("LIST_SECTEURS");
        $manager->persist($acces5);
        $this->addReference('acces5', $acces5);

        $acces6 = new EntityAcces();
        $acces6->setNom("création des secteurs");
        $acces6->setNomConstant("CREATE_SECTEUR");
        $manager->persist($acces6);
        $this->addReference('acces6', $acces6);

        $acces7 = new EntityAcces();
        $acces7->setNom("modification des secteurs");
        $acces7->setNomConstant("EDIT_SECTEUR");
        $manager->persist($acces7);
        $this->addReference('acces7', $acces7);

        $acces8 = new EntityAcces();
        $acces8->setNom("detail des secteurs");
        $acces8->setNomConstant("SHOW_SECTEUR");
        $manager->persist($acces8);
        $this->addReference('acces8', $acces8);

        $acces9 = new EntityAcces();
        $acces9->setNom("suppression des secteurs");
        $acces9->setNomConstant("DELETE_SECTEUR");
        $manager->persist($acces9);
        $this->addReference('acces9', $acces9);

        $acces10 = new EntityAcces();
        $acces10->setNom("liste des pays");
        $acces10->setNomConstant("LIST_PAYS");
        $manager->persist($acces10);
        $this->addReference('acces10', $acces10);

        $acces11 = new EntityAcces();
        $acces11->setNom("création des pays");
        $acces11->setNomConstant("CREATE_PAY");
        $manager->persist($acces11);
        $this->addReference('acces11', $acces11);

        $acces12 = new EntityAcces();
        $acces12->setNom("modification des pays");
        $acces12->setNomConstant("EDIT_PAY");
        $manager->persist($acces12);
        $this->addReference('acces12', $acces12);

        $acces13 = new EntityAcces();
        $acces13->setNom("detail des pays");
        $acces13->setNomConstant("SHOW_PAY");
        $manager->persist($acces13);
        $this->addReference('acces13', $acces13);

        $acces14 = new EntityAcces();
        $acces14->setNom("suppression des pays");
        $acces14->setNomConstant("DELETE_PAY");
        $manager->persist($acces14);
        $this->addReference('acces14', $acces14);


        $acces15 = new EntityAcces();
        $acces15->setNom("liste des comptes");
        $acces15->setNomConstant("LIST_COMPTES");
        $manager->persist($acces15);
        $this->addReference('acces15', $acces15);

        $acces16 = new EntityAcces();
        $acces16->setNom("création des comptes");
        $acces16->setNomConstant("CREATE_COMPTE");
        $manager->persist($acces16);
        $this->addReference('acces16', $acces16);

        $acces17 = new EntityAcces();
        $acces17->setNom("modification des comptes");
        $acces17->setNomConstant("EDIT_COMPTE");
        $manager->persist($acces17);
        $this->addReference('acces17', $acces17);

        $acces18 = new EntityAcces();
        $acces18->setNom("detail des comptes");
        $acces18->setNomConstant("SHOW_COMPTE");
        $manager->persist($acces18);
        $this->addReference('acces18', $acces18);

        $acces19 = new EntityAcces();
        $acces19->setNom("suppression des comptes");
        $acces19->setNomConstant("DELETE_COMPTE");
        $manager->persist($acces19);
        $this->addReference('acces19', $acces19);


        $manager->flush();
    }
}
