<?php

use Dieselnet\DIKeys;

use Dieselnet\Domain\Authorization\Token\Verifier;
use Dieselnet\Infrastructure\Common\JsonResponseMiddleware;
use Dieselnet\Infrastructure\Authorization\Token\Middleware;
use Dieselnet\Infrastructure\Authorization\Token\Repository;

$container = new Slim\Container([
    'settings' => [
        'determineRouteBeforeAppMiddleware' => true
    ]
]);

$container[DIKeys::JSON_RESPONSE_MIDDLEWARE] = function () {
    return new JsonResponseMiddleware();
};

$container[DIKeys::TOKEN_REPOSITORY] = function () {
    return new Repository();
};

$container[DIKeys::TOKEN_VERIFIER] = function () use ($container) {
    return new Verifier($container->get(DIKeys::TOKEN_REPOSITORY));
};

$container[DIKeys::TOKEN_VERIFIER_MIDDLEWARE] = function () use ($container) {
    $tokenVerifier = $container->get(DIKeys::TOKEN_VERIFIER);

    return new Middleware($tokenVerifier);
};

$container[DIKeys::COMMAND_BUS] = function () use ($container) {
    return new \Dieselnet\Application\Commands\CommandBus(
        new \Dieselnet\Application\Commands\CommandMapper(),
        $container
    );
};

$container[\Dieselnet\Application\Commands\User\SignupHandler::class] = function () {
    return new \Dieselnet\Application\Commands\User\SignupHandler();
};

return $container;
