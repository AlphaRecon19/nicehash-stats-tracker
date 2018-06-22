<?php

namespace Client\Nicehash;

use Client\Nicehash\Requests\AbstractRequest;
use GuzzleHttp\Client;
use GuzzleHttp\json_decode;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class Request
{
    /**
    * API id used to identify miner on NiceHash
    * @var string
    */
    private $apiid;

    /**
     * API key used to authenticate with NiceHash
     * @var string
     */
    private $apikey;

    /**
     * Mining address on NiceHash
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $baseUrl = 'https://api.nicehash.com';

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    public function __construct(string $apiid, string $apikey, string $address)
    {
        $this->apiid = $apiid;
        $this->apikey = $apikey;
        $this->address = $address;
        $this->getClient();
    }

    /**
     * Get guzzle client
     * @return \GuzzleHttp\Client
     */
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

    /**
     * Get the configured API key
     * @return string
     */
    public function getApiKey()
    {
        return $this->apikey;
    }

    /**
     * Get the configured API id
     * @return string
     */
    public function getApiId()
    {
        return $this->apiid;
    }

    /**
     * Get the configured Bitcoin address
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }


    public function fetch($request)
    {
        dump($request->getUri());
        $response = $this->client->send(
            new GuzzleRequest('GET', "api?{$request->getUri()}")
        );
        $contents = $response->getBody()->getContents();
        $json = json_decode($contents, true);

        return $json;
    }
}