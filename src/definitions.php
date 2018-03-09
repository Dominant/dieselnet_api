<?php

use Dieselnet\Application\CommandMapper;
use Dieselnet\Domain\Authorization\Token;
use Dieselnet\Domain\User;
use Dieselnet\Infrastructure\Config\Config;
use Dieselnet\Infrastructure\Events\SymfonyEventDispatcherAdapter;
use Dieselnet\Infrastructure\Persistance;
use Dieselnet\Application;
use Symfony\Component\EventDispatcher\EventDispatcher;
use PhpAmqpLib\Connection\AMQPStreamConnection;

return [
    Psr\Container\ContainerInterface::class => DI\autowire(DI\Container::class),
    Token\RepositoryInterface::class => DI\autowire(Persistance\TokenRepository::class),
    User\RepositoryInterface::class => DI\autowire(Persistance\UserRepository::class),
    Application\EventDispatcherInterface::class => DI\autowire(SymfonyEventDispatcherAdapter::class)
        ->constructor(DI\autowire(EventDispatcher::class)),
    CommandMapper::class => DI\create(CommandMapper::class)->constructor(
        'Dieselnet\\Application\\Commands\\',
        'Dieselnet\\Application\\Handlers\\'
    ),

    Config::class => DI\factory(function() {
        $file = PROJECT_ROOT . '/src/config.yaml';
        $data = \Symfony\Component\Yaml\Yaml::parse(file_get_contents($file));

        return new Dieselnet\Infrastructure\Config\Config($data);
    }),

    AMQPStreamConnection::class => DI\factory(function (Config $config) {
        $amqpConfig = $config->get('rabbitmq');

        return new AMQPStreamConnection(
            $amqpConfig['host'],
            $amqpConfig['port'],
            $amqpConfig['user'],
            $amqpConfig['pass']
        );
    })
];
