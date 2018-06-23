<?php
declare(strict_types=1);

namespace Client\Nicehash\Requests;

use Client\Nicehash\Client;
use GuzzleHttp\Psr7\Request;

abstract class AbstractRequest
{
    /**
     * @var \Client\Nicehash\Client
     */
    private $client;

    /**
     * Uniform Resource Identifier of this request
     * @var String
     */
    private $uri;

    /**
     * @param \Client\Nicehash\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->initialize();
    }

    /**
     * Get NiceHash client
     * @return \Client\Nicehash\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Make the request to nicehash and return the result
     * @return array
     */
    protected function fetchData(): ?array
    {
        $fetch = $this->client->getRequest()->fetch($this);

        return $fetch['result'];
    }

    /**
     * Set the URI of the request
     * @param string $uri
     */
    protected function setUri($uri)
    {
        $request = $this->client->getRequest();
        $this->uri = str_replace(
            ['{apiid}', '{apikey}', '{address}'],
            [$request->getApiId(), $request->getApiKey(), $request->getAddress()],
            $uri
        );
    }

    /**
     * Get the URI of the request
     * @param string $uri
     */
    public function getUri(): ?string
    {
        return $this->uri;
    }
}