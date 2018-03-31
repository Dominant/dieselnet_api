<?php

namespace Dieselnet\Infrastructure\Http\Middlewares;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CorsResponseMiddleware implements MiddlewareInterface
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
        $response = $response->withHeader('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
