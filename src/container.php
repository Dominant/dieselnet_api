<?php

use Dieselnet\DIKeys;
use Dieselnet\Application;
use Dieselnet\Application\Handlers;
use Dieselnet\Domain\Authorization\Token\Verifier;
use Dieselnet\Infrastructure\Persistance\TokenRepository;

$container = new Slim\Container([
    'settings' => [
        'debug' => true,
        'determineRouteBeforeAppMiddleware' => true,
    ]
]);

$container[DIKeys::TOKEN_REPOSITORY] = function () {
    return new TokenRepository();
};

$container[DIKeys::TOKEN_VERIFIER] = function () use ($container) {
    return new Verifier($container->get(DIKeys::TOKEN_REPOSITORY));
};

$container[DIKeys::COMMAND_BUS] = function () use ($container) {
    return new Application\CommandBus(new Application\CommandMapper(
        'Dieselnet\\Application\\Commands\\',
        'Dieselnet\\Application\\Handlers\\'
    ), $container);
};

$container[Handlers\User\SignupHandler::class] = function () {
    return new Handlers\User\SignupHandler();
};

return $container;
