<?php
declare(strict_types=1);

namespace Client\Nicehash\Requests\Prv;

use Client\Nicehash\Requests\AbstractRequest;
use Client\Nicehash\Requests\RequestableInterface;

class Balance extends AbstractRequest implements RequestableInterface
{
    /**
     * {@inheritDoc}
     */
    public function initialize()
    {
        $this->setUri('method=balance&id={apiid}&key={apikey}');
    }

    /**
     * {@inheritDoc}
     */
    public function fetch(): ?array
    {
        $data = $this->fetchData();

        return [
            'pending' => $data['balance_pending'],
            'confirmed' => $data['balance_confirmed'],
            'total' => $data['balance_pending'] + $data['balance_confirmed']
        ];
    }
}