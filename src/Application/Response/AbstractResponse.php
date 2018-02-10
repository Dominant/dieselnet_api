<?php

namespace Dieselnet\Application\Response;

abstract class AbstractResponse implements ResponseInterface
{
    /**
     * @var array
     */
    private $payload;

    /**
     * @param array $payload
     */
    public function __construct(array $payload = [])
    {
        $this->payload = $payload;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }
}
