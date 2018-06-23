<?php
declare(strict_types=1);

namespace App\Command;

use App\Entity\AlgorithmLog;
use App\Entity\UserStatLog;
use App\Repository\UserStatLogRepository;

use Client\Nicehash\Client;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FetchUserStatsCommand extends Command
{
    protected static $defaultName = 'app:fetch-user-stats';

    /**
     * @var \Client\Nicehash\Client
     */
    private $nicehash;

    /**
     * @var \App\Repository\UserStatLogRepository
     */
    private $userStatLogRepo;

    public function __construct(Client $nicehash, UserStatLogRepository $userStatLogRepo)
    {
        parent::__construct();
        $this->nicehash = $nicehash;
        $this->userStatLogRepo = $userStatLogRepo;
    }

    protected function configure()
    {
        $this->setDescription('Fetch and then store stats from NiceHash');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->section('Fetching stats from NiceHash');

        $nicehash = $this->nicehash;
        $stats = $nicehash->getStatsProvider();
        $meta = null;
        $log = new UserStatLog;

        $io->progressStart(count($stats));
        foreach ($stats as $name => $algo) {
            $io->progressAdvance();
            // Skip the meta array but save it for later
            if ('meta' === $name) {
                $meta = $algo;
                continue;
            }
            $algorithm = $algo['algo'];
            $balance = $algo['balance'];

            // Skip algorithm with a balance of 0
            if ('0' === $balance) {
                continue;
            }

            $log->addData((new AlgorithmLog)
                ->setAlgorithm($algorithm)
                ->setBalance((float) $balance)
            );
        }

        $this->userStatLogRepo->save($log);
        $io->progressFinish();
        $io->success('Complete');
    }
}
