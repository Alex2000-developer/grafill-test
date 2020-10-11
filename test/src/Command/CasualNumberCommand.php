<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\CasualNumberGenerator;

class CasualNumberCommand extends Command
{
    protected static $defaultName = 'app:casual-number';

    protected function configure()
    {
        $this
            ->setDescription('Creates a Casual Number from service')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $message = new CasualNumberGenerator;
        $number = $message->getCasualNumber();
        $output->writeln('Numero Casuale: '.$number);
        return 0;
    }
}
