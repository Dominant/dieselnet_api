<?php

namespace Dieselnet\Infrastructure\Http\Middlewares;

use Dieselnet\Domain\Authorization\Token\Verifier;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;

class TokenVerifierMiddleware implements MiddlewareInterface
{
    const APP_TOKEN_NAME = 'X_DIESELNET_TOKEN';
    const PUBLIC_ALLOWED_ROUTES = [
        'signup',
        'verify-code',
        'options-check'
    ];

    /**
     * @var Verifier
     */
    private $verifier;

    /**
     * @param Verifier $verifier
     */
    public function __construct(Verifier $verifier)
    {
        $this->verifier = $verifier;
    }

    /**
     * @param RequestInterface|Request  $request
     * @param ResponseInterface $response
     * @param callable $next
     *
     * @return mixed
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
    {
        $token = $request->getHeaderLine(self::APP_TOKEN_NAME);
        $isValid = $this->verifier->isValid($token);

        $route = $request->getAttribute('route');

        if (is_null($route)) {
            $response = $response->withStatus(404);
            $response->getBody()->write(json_encode([
                'error' => 'pageNotFound'
            ]));
            return $response;
        }

        if (!$isValid && !$this->isPublicRoute($route->getName())) {
            $response = $response->withStatus(403);
            $response->getBody()->write(json_encode([
                'error' => 'invalidToken'
            ]));
        } else {
            $response = $next($request, $response);
        }

        return $response;
    }

    /**
     * @param string $routeName
     *
     * @return bool
     */
    private function isPublicRoute(string $routeName): bool
    {
        return in_array($routeName, self::PUBLIC_ALLOWED_ROUTES);
    }
}
