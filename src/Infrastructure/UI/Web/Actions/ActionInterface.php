<?php

namespace Dieselnet\Infrastructure\UI\Web\Actions;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ActionInterface
{
    /**
     * @param ServerRequestInterface  $request
     * @param ResponseInterface $response
     * @param                   $args
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface;
}
