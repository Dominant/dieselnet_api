<?php

namespace Dieselnet\Application;

use Dieselnet\Application\Response\Success;

interface QueryInterface
{
    /**
     * @param Request $request
     *
     * @return Success
     */
    public function execute(Request $request): Success;
}
