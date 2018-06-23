<?php
declare(strict_types=1);

namespace Client\Nicehash;

use App\Repository\AlgorithmRepository;
use Client\Nicehash\Requests;

class Client
{
    /**
     * @var \Client\Nicehash\Request
     */
    private $request;

    /**
     * @var \App\Repository\AlgorithmRepository
     */
    private $algorithmRepo;

    public function __construct(Request $request, AlgorithmRepository $algorithmRepo)
    {
        $this->request = $request;
        $this->algorithmRepo = $algorithmRepo;
    }

    /**
     * Get $request
     * @return \Client\Nicehash\Request
     */
    public function getRequest(): ?Request
    {
        return $this->request;
    }

    /**
     * Get $algorithmRepo
     * @return \App\Repository\AlgorithmRepository
     */
    public function getAlgorithmRepo(): ?AlgorithmRepository
    {
        return $this->algorithmRepo;
    }

    /**
     * Get current confirmed Bitcoin balance of the contifured wallet
     * @return array
     */
    public function getBalance(): ?array
    {
        $request = new Requests\Prv\Balance($this);

        return $request->fetch();
    }

    /**
     * Get current profitability (price) and hashing speed for all algorithms
     * @return array
     */
    public function getStatsGlobalCurrent(): ?array
    {
        $request = new Requests\Pub\StatsGlobalCurrent($this);

        return $request->fetch();
    }

    /**
     * Get current stats for provider for all algorithms
     * @return array
     */
    public function getStatsProvider(): ?array
    {
        $request = new Requests\Pub\StatsProvider($this);

        return $request->fetch();
    }

    /**
     * Get API version
     * @return string
     */
    public function getVersion(): ?string
    {
        $request = new Requests\Pub\Version($this);

        return $request->fetch();
    }
}