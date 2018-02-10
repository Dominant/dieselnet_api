<?php

namespace Dieselnet\Application\Response;

class Error extends AbstractResponse
{
    /**
     * Identify if response is successful.
     *
     * @return bool
     */
    public function isSuccess(): bool
    {
        return false;
    }

    /**
     * Identify if response is not successful.
     *
     * @return bool
     */
    public function isError(): bool
    {
        return true;
    }
}
