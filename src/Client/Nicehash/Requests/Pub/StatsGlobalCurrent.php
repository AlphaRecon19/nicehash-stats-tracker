<?php
declare(strict_types=1);

namespace Client\Nicehash\Requests\Pub;

use Client\Nicehash\Requests\AbstractRequest;
use Client\Nicehash\Requests\RequestableInterface;

class StatsGlobalCurrent extends AbstractRequest implements RequestableInterface
{
    /**
     * {@inheritDoc}
     */
    public function initialize()
    {
        $this->setUri('method=stats.global.current');
    }

    /**
     * {@inheritDoc}
     */
    public function fetch(): ?array
    {
        $repo = $this->getClient()->getAlgorithmRepo();
        $data = $this->fetchData();

        foreach ($data['stats'] as $algo) {
            $algorithm = $repo->getAlgoById($algo['algo']);
            $algo['algo'] = $algorithm;

            $stats[$algorithm->getName()] = $algo;
        }

        return $stats;
    }
}