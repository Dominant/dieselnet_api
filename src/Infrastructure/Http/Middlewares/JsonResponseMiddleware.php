<?php

namespace Dieselnet\Infrastructure\Http\Middlewares;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class JsonResponseMiddleware implements MiddlewareInterface
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param callable          $next
     *
     * @return mixed
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
    {
        $response = $next($request, $response);
        $response = $response->withHeader('Content-type', 'application/json');

        return $response;
    }
}
