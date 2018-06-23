<?php
declare(strict_types=1);

namespace Client\Nicehash\Requests\Pub;

use Client\Nicehash\Requests\AbstractRequest;
use Client\Nicehash\Requests\RequestableInterface;

class StatsProvider extends AbstractRequest implements RequestableInterface
{
    /**
     * {@inheritDoc}
     */
    public function initialize()
    {
        $this->setUri('method=stats.provider&addr={address}');
    }

    /**
     * {@inheritDoc}
     */
    public function fetch(): ?array
    {
        $repo = $this->getClient()->getAlgorithmRepo();
        $data = $this->fetchData();

        $stats = [];
        $total = (float) 0;

        foreach ($data['stats'] as $algo) {
            $algorithm = $repo->getAlgoById($algo['algo']);
            $algo['algo'] = $algorithm;

            $stats[$algorithm->getName()] = $algo;
            $total += $algo['balance'];
        }

        return $stats + [
            'meta' => [
                'total' => $total
            ]
        ];
    }
}