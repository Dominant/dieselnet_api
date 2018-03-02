<?php

namespace Dieselnet\Application\Response;

class Success extends AbstractResponse
{
    /**
     * @param int $httpCode
     * @param array $payload
     */
    public function __construct(int $httpCode = 200, array $payload = [])
    {
        parent::__construct($httpCode, $payload);
    }

    /**
     * Identify if response is successful.
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return true;
    }

    /**
     * Identify if response is not successful.
     *
     * @return bool
     */
    public function isError(): bool
    {
        return false;
    }
}
