<?php

namespace App\Command;


use App\Entity\Projets;
use App\Entity\EtatProjet;
use App\Entity\Compte;
use App\Entity\EtatCompte;
use App\Services\Mailer\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PassageCommandeStatusCommand extends Command
{
    protected static $defaultName = 'PassageCommandeStatus';
    protected $em;
    private $mailer;

    public function __construct(EntityManagerInterface $em,Mailer $mailer,string $name = null)
    {
        parent::__construct($name);
        $this->em=$em;
        $this->mailer=$mailer;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
       
        // $comptes = $this->em->getRepository(Compte::class)->findAll();
        // foreach($comptes as $compte){
        //     $projetsIn = $this->em->getRepository(Projets::class)->getListeProjetByCompteIN($compte);
        //     $projetsDe = $this->em->getRepository(Projets::class)->getListeProjetByCompteDE($compte);
        //     $projetsFe = $this->em->getRepository(Projets::class)->getListeProjetByCompteFer($compte);

        //    if (count($projetsIn)>0){
        //     $getEtatCompte = $this->em->getRepository(EtatCompte::class)->findOneBy(['id'=>10]);
        //      $compte->setEtatCompte($getEtatCompte);
        //      $this->em->persist($compte);
        //      $this->em->flush();
        //      $this->mailer->sendMail($compte->getResponsableCompte()->getEmail(),"le compte ".$compte->getNomCompte()." change statut à Intérêt ","Changement de statut");
        //    }elseif(count($projetsDe)>0){
        //     $getEtatCompte = $this->em->getRepository(EtatCompte::class)->findOneBy(['id'=>11]);
        //     $compte->setEtatCompte($getEtatCompte);
        //      $this->em->persist($compte);
        //      $this->em->flush();
        //      $this->mailer->sendMail($compte->getResponsableCompte()->getEmail(),"le compte ".$compte->getNomCompte()." change statut à Décision","Changement de statut");
        //    }elseif(count($projetsFe)>0){
        //     $getEtatCompte = $this->em->getRepository(EtatCompte::class)->findOneBy(['id'=>12]);
        //     $compte->setEtatCompte($getEtatCompte);
        //      $this->em->persist($compte);
        //      $this->em->flush();
        //      $this->mailer->sendMail($compte->getResponsableCompte()->getEmail(),"le compte ".$compte->getNomCompte()." change statut à Fermé","Changement de statut");
        //     }
            
        // }
        

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }
}
