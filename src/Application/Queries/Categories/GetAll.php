<?php

namespace Dieselnet\Application\Queries\Categories;

use Dieselnet\Application\QueryInterface;
use Dieselnet\Application\Request;
use Dieselnet\Application\Response\Success;

class GetAll implements QueryInterface
{
    /**
     * @param Request $request
     *
     * @return Success
     */
    public function execute(Request $request): Success
    {
        return new Success();
    }
}
