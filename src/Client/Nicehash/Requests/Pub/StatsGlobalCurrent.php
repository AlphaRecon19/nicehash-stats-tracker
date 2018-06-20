<?php

namespace Client\Nicehash\Requests\Pub;

use Client\Nicehash\Requests\AbstractRequest;
use Client\Nicehash\Requests\RequestableInterface;

class StatsGlobalCurrent extends AbstractRequest implements RequestableInterface
{
    public function initialize()
    {
        $this->setUri('method=stats.global.current');
    }

    public function fetch()
    {
        $data = $this->fetchData();

        return $data['stats'];
    }
}