<?php

namespace Client\Nicehash;

use Client\Nicehash\Requests;

class Client
{
    private $request;

    public function __construct()
    {
        $this->request = $this->newRequest();
    }

    public function getRequest()
    {
        return $this->request;
    }

    private function newRequest()
    {
        return new Request();
    }

    public function getStatsGlobalCurrent()
    {
        $request = new Requests\Pub\StatsGlobalCurrent($this);

        return $request->fetch();
    }

    public function getVersion()
    {
        $request = new Requests\Pub\Version($this);

        return $request->fetch();
    }
}