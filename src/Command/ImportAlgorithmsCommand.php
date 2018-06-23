<?php
declare(strict_types=1);

namespace App\Command;

use App\Entity\Algorithm;
use App\Repository\AlgorithmRepository;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Yaml\Yaml;

class ImportAlgorithmsCommand extends Command
{
    protected static $defaultName = 'app:import-algorithms';

    /**
     * @var \App\Repository\AlgorithmRepository
     */
    private $algorithmsRepo;

    public function __construct(AlgorithmRepository $algorithmsRepo)
    {
        parent::__construct();
        $this->algorithmsRepo = $algorithmsRepo;
    }

    protected function configure()
    {
        $this->setDescription('Import nicehash algorithms from config/algorithms.yaml');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Importing algorithms');

        $file = __DIR__.'/../../config/algorithms.yaml';
        $algorithms = Yaml::parseFile($file);
        $io->progressStart(count($algorithms));

        foreach ($algorithms as $algorithm => $key) {
            $io->progressAdvance();

            $entity = $this->algorithmsRepo->findOneBy(['nicehashId' => $key]);
            if (null === $entity) {
                $entity = new Algorithm;
            }

            $entity->setNicehashId($key)
                ->setName($algorithm)
            ;
            $this->algorithmsRepo->save($entity);
        }

        $io->progressFinish();
        $io->success('Algorithms count:' . count($this->algorithmsRepo->findAll()));
    }
}
