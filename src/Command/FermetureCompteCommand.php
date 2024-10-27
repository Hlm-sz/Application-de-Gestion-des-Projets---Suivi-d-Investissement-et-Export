<?php

namespace App\Command;

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

class FermetureCompteCommand extends Command
{
    protected static $defaultName = 'app:fermeture_compte';
    
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
            ->setDescription('Fermetures des comptes en stagnation au bout de 30 mois d inactivité')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }
        $getEtatCompteFerme=$this->em->getRepository(EtatCompte::class)->findOneBy(['id'=>6]);
        $i=0;
        foreach ($this->em->getRepository(Compte::class)->comptesSup30Month() as $compte){
            $getCompte= $this->em->getRepository(Compte::class)->findOneBy(['id'=>$compte['id']]);
           // dd($getCompte->getNomCompte());
            // $getCompte->setEtatCompte($getEtatCompteFerme);
            // $this->em->persist($getCompte);
            // $this->em->flush();
            // $i++;
            // $response=$this->mailer->sendMail($getCompte->getResponsableCompte()->getEmail(),"le Compte ".$getCompte->getNomCompte()." a ete fermer","Fermeture de compte");
            // if(!$response){
            //     $io->error("erreur d'envoi des mail");
            // }
        }
        
        $io->success("$i Compte a ete changer statut a ferme");

        return 0;
    }
}
