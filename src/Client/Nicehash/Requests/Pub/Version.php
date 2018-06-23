<?php
declare(strict_types=1);

namespace Client\Nicehash\Requests\Pub;

use Client\Nicehash\Requests\AbstractRequest;
use Client\Nicehash\Requests\RequestableInterface;

class Version extends AbstractRequest implements RequestableInterface
{
    /**
     * {@inheritDoc}
     */
    public function initialize()
    {
        $this->setUri('');
    }

    /**
     * {@inheritDoc}
     */
    public function fetch(): ?string
    {
        $data = $this->fetchData();

        return $data['api_version'];
    }
}