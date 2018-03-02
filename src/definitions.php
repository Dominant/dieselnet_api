<?php

use Dieselnet\Application\CommandMapper;
use Dieselnet\Domain\Authorization\Token;
use Dieselnet\Domain\User;
use Dieselnet\Infrastructure\Events\SymfonyEventDispatcherAdapter;
use Dieselnet\Infrastructure\Persistance;
use Dieselnet\Application;
use Symfony\Component\EventDispatcher\EventDispatcher;

return [
    Psr\Container\ContainerInterface::class => DI\autowire(DI\Container::class),
    Token\RepositoryInterface::class => DI\autowire(Persistance\TokenRepository::class),
    User\RepositoryInterface::class => DI\autowire(Persistance\UserRepository::class),
    Application\EventDispatcherInterface::class => DI\autowire(SymfonyEventDispatcherAdapter::class)
        ->constructor(DI\autowire(EventDispatcher::class)),
    CommandMapper::class => DI\create(CommandMapper::class)->constructor(
        'Dieselnet\\Application\\Commands\\',
        'Dieselnet\\Application\\Handlers\\'
    )
];
