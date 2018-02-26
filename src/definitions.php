<?php

use Dieselnet\Application\CommandMapper;
use Dieselnet\Domain\Authorization\Token;
use Dieselnet\Infrastructure\Persistance;

return [
    Psr\Container\ContainerInterface::class => DI\create(DI\Container::class),
    Token\RepositoryInterface::class => DI\create(Persistance\TokenRepository::class),
    CommandMapper::class => DI\create(CommandMapper::class)->constructor(
        'Dieselnet\\Application\\Commands\\',
        'Dieselnet\\Application\\Handlers\\'
    )
];
