<?php

namespace Client\Nicehash\Requests\Pub;

use Client\Nicehash\Requests\AbstractRequest;
use Client\Nicehash\Requests\RequestableInterface;

class Version extends AbstractRequest implements RequestableInterface
{
    public function initialize()
    {
        $this->setUri('');
    }

    public function fetch()
    {
        $data = $this->fetchData();

        return $data['api_version'];
    }
}