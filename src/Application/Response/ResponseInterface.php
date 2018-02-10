<?php

namespace Dieselnet\Application\Response;

interface ResponseInterface
{
    /**
     * Identify if response is successful.
     *
     * @return bool
     */
    public function isSuccess(): bool;

    /**
     * Identify if response is not successful.
     *
     * @return bool
     */
    public function isError(): bool;

    /**
     * Get response payload.
     *
     * @return array
     */
    public function getPayload(): array;
}
