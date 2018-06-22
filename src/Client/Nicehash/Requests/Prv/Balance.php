<?php

namespace Client\Nicehash\Requests\Prv;

use Client\Nicehash\Requests\AbstractRequest;
use Client\Nicehash\Requests\RequestableInterface;

class Balance extends AbstractRequest implements RequestableInterface
{
    public function initialize()
    {
        $this->setUri('method=balance&id={apiid}&key={apikey}');
    }

    public function fetch()
    {
        $data = $this->fetchData();

        return [
            'pending' => $data['balance_pending'],
            'confirmed' => $data['balance_confirmed'],
            'total' => $data['balance_pending'] + $data['balance_confirmed']
        ];
    }
}