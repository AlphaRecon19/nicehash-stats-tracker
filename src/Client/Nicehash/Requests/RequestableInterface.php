<?php
declare(strict_types=1);

namespace Client\Nicehash\Requests;

interface RequestableInterface
{
    /**
     * Setup the class ready for making requests
     */
    public function initialize();

    /**
     * Make the request, process and then return the data
     * @return array|string
     */
    public function fetch();
}