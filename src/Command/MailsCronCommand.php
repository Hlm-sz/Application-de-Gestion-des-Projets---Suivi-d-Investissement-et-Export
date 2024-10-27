<?php

namespace App\Command;

use App\Services\Mailer\Mailer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MailsCronCommand extends Command
{
    protected static $defaultName = 'App:MailsCron';
    private $mailer;
    public function __construct(string $name = null,Mailer $mailer)
    {
        parent::__construct($name);
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
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }
        // $response=$this->mailer->sendMail("notif-crm@amdie.gov.ma","mail e ete bien cree","Mail AMDIE");
        // if(!$response){
        //     $io->error("erreur d'envoi des mail");
        // }
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return 0;
    }
}
