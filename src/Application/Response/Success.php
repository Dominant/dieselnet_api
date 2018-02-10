<?php

namespace Dieselnet\Application\Response;

class Success extends AbstractResponse
{
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
