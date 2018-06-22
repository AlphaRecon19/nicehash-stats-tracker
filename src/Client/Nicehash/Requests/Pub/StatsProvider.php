<?php

namespace Client\Nicehash\Requests\Pub;

use Client\Nicehash\Requests\AbstractRequest;
use Client\Nicehash\Requests\RequestableInterface;

class StatsProvider extends AbstractRequest implements RequestableInterface
{
    public function initialize()
    {
        $this->setUri('method=stats.provider&addr={address}');
    }

    public function fetch()
    {
        $data = $this->fetchData();

        $stats = $data['stats'];
        $total = (float) 0;

        foreach ($stats as $algo) {
            $total += $algo['balance'];
        }

        return $stats + [
            'meta' => [
                'total' => $total
            ]
        ];
    }
}