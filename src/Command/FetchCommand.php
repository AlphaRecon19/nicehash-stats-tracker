<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use Client\Nicehash\Client;

class FetchCommand extends Command
{
    protected static $defaultName = 'app:fetch';

    protected function configure()
    {
        $this->setDescription('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $nicehash = new Client();

        dump($nicehash->getVersion());
        dump($nicehash->getStatsGlobalCurrent());
    }
}
