<?php

use Dieselnet\Application\CommandMapper;
use Dieselnet\Domain\Authorization\Token;
use Dieselnet\Domain\User;
use Dieselnet\Infrastructure\Config\Config;
use Dieselnet\Infrastructure\Events\SymfonyEventDispatcherAdapter;
use Dieselnet\Infrastructure\Persistance;
use Dieselnet\Application;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\EventDispatcher\EventDispatcher;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Dieselnet\Infrastructure\Environment;

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
    }),

    EntityManager::class => DI\factory(function (Config $config) {
        $mappingPaths = array(PROJECT_ROOT . '/src/Infrastructure/Persistance/mapping');
        $isDevMode = Environment\Detector::fromEnvironmentVars()->isDevelopment();
        $xmlConfig = Setup::createXMLMetadataConfiguration($mappingPaths, $isDevMode);
        $xmlConfig->setAutoGenerateProxyClasses(true);
        $connectionParams = array(
            'dbname' => $config->get('database')['dbname'],
            'user' => $config->get('database')['user'],
            'password' => $config->get('database')['pass'],
            'host' => $config->get('database')['host'],
            'driver' => 'pdo_mysql',
        );
        $connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $xmlConfig);
        \Doctrine\DBAL\Types\Type::addType(Persistance\Types\AggregateId::NAME, Persistance\Types\AggregateId::class);

        return EntityManager::create($connection, $xmlConfig);
    })
];
