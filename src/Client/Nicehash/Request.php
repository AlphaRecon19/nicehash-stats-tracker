<?php

namespace Client\Nicehash;

use GuzzleHttp\Client;
use GuzzleHttp\json_decode;

class Request
{
    private $baseUrl = 'https://api.nicehash.com';

    private $client;

    public function __construct()
    {
        $this->getClient();
    }

    public function getClient()
    {
        if ($this->client === null) {
            $this->client = new Client([
                'base_uri' => $this->baseUrl,
                'timeout'  => 10,
            ]);
        }

        return $this->client;
    }

    public function fetch($request)
    {
        $response = $this->client->send(
            new \GuzzleHttp\Psr7\Request('GET', "api?{$request->getUri()}")
        );
        $contents = $response->getBody()->getContents();
        $json = json_decode($contents, true);

        return $json;
    }
}