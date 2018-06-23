<?php

namespace App\Controller;

use App\Repository\UserStatLogRepository;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserStatsHistoryController extends Controller
{
    /**
     * @var \App\Repository\UserStatLogRepository
     */
    private $userStatLogRepo;

    public function __construct(UserStatLogRepository $userStatLogRepo)
    {
        $this->userStatLogRepo = $userStatLogRepo;
    }

    /**
     * @Route("/user-stats-history", name="user_stats_history")
     */
    public function index()
    {
        $json = [];
        $mins = 15;

        foreach ($this->userStatLogRepo->getLatestLogs($mins) as $log) {
            $data = [];

            foreach($log->getData() as $algo) {
                $name = $algo->getAlgorithm()->getName();
                $data[$name] = [
                    'name' => $name,
                    'balance' => number_format($algo->getBalance(), 8)
                ];
            }

            $json[] = [
                'data' => $data,
                'timestamp' => $log->getTimestamp()->getTimestamp()
            ];
        }

        return $this->json($json);
    }
}
