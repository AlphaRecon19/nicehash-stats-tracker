<?php

namespace Client\Nicehash;

use Client\Nicehash\Requests;

class Client
{
    /**
     * @var \Client\Nicehash\Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getBalance()
    {
        $request = new Requests\Prv\Balance($this);

        return $request->fetch();
    }

    public function getStatsGlobalCurrent()
    {
        $request = new Requests\Pub\StatsGlobalCurrent($this);

        return $request->fetch();
    }

    public function getStatsProvider()
    {
        $request = new Requests\Pub\StatsProvider($this);

        return $request->fetch();
    }

    public function getVersion()
    {
        $request = new Requests\Pub\Version($this);

        return $request->fetch();
    }
}