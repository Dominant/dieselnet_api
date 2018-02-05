<?php

namespace Dieselnet\Infrastructure\UI\Web\Actions;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ActionInterface
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param                   $args
     *
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, $args): ResponseInterface;
}
