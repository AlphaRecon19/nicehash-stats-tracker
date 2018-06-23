<?php
declare(strict_types=1);

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

    public function __construct(Client $nicehash)
    {
        parent::__construct();
        $this->nicehash = $nicehash;
    }

    protected function configure()
    {
        $this->setDescription('');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $nicehash = $this->nicehash;

        dump($nicehash->getVersion());
        dump($nicehash->getBalance());
        dump($nicehash->getStatsGlobalCurrent());
        dump($nicehash->getStatsProvider());
    }
}
