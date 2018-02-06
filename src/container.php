<?php

use Dieselnet\DIKeys;

use Dieselnet\Domain\Authorization\Token\Verifier;
use Dieselnet\Infrastructure\Authorization\Token\Repository;

$container = new Slim\Container([
    'settings' => [
        'determineRouteBeforeAppMiddleware' => true
    ]
]);

$container[DIKeys::TOKEN_REPOSITORY] = function () {
    return new Repository();
};

$container[DIKeys::TOKEN_VERIFIER] = function () use ($container) {
    return new Verifier($container->get(DIKeys::TOKEN_REPOSITORY));
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
