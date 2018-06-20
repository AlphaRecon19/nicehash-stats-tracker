<?php

namespace Client\Nicehash\Requests;

use GuzzleHttp\Psr7\Request;

abstract class AbstractRequest
{
    private $client;

    private $name;

    private $uri;

    public function __construct($client)
    {
        $this->client = $client;
        $this->initialize();
    }

    protected function fetchData()
    {
        $fetch = $this->client->getRequest()->fetch($this);

        return $fetch['result'];
    }

    protected function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    protected function setUri($uri)
    {
        $this->uri = $uri;
    }

    public function getUri()
    {
        return $this->uri;
    }
}