<?php

namespace Dieselnet\Infrastructure\Http\Middlewares;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface MiddlewareInterface
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param callable          $next
     *
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface;
}
