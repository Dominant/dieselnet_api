<?php

namespace Dieselnet\Infrastructure\Http\Middlewares;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class JsonRequestMiddleware implements MiddlewareInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     *
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
    {
        $contentType = $request->getHeaderLine('Content-type');

        if ($this->isCorsPreflightRequest($request)) {
            return $next($request, $response);
        }

        if (!preg_match('/^application\\/json/', $contentType)) {
            $response = $response->withStatus(400);
            $response->getBody()->write(json_encode([
                'error' => 'unsupportedContentType'
            ]));

            return $response;
        }

        return $next($request, $response);
    }

    protected function isCorsPreflightRequest($request): bool
    {
        $method = strtoupper($request->getMethod());
        return $method === 'OPTIONS';
    }
}
