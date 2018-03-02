<?php

namespace Dieselnet\Application\Response;

abstract class AbstractResponse implements ResponseInterface
{
    /**
     * @var array
     */
    private $payload;

    /**
     * @var int
     */
    private $httpCode;

    /**
     * @param int $httpCode
     * @param array $payload
     */
    public function __construct(int $httpCode, array $payload = [])
    {
        $this->payload = $payload;
        $this->httpCode = $httpCode;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * @return int
     */
    public function httpCode(): int
    {
        return $this->httpCode;
    }
}
