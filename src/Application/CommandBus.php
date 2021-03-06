<?php

namespace Dieselnet\Application;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class CommandBus
{
    /**
     * @var CommandMapper
     */
    private $commandMapper;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param CommandMapper      $commandMapper
     * @param ContainerInterface $container
     */
    public function __construct(CommandMapper $commandMapper, ContainerInterface $container)
    {
        $this->commandMapper = $commandMapper;
        $this->container = $container;
    }

    /**
     * @param CommandInterface $command
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function handle(CommandInterface $command): void
    {
        $this->getHandler($command)->handle($command);
    }

    /**
     * @param CommandInterface $command
     * @return CommandHandlerInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function getHandler(CommandInterface $command): CommandHandlerInterface
    {
        try {
            $handlerClassName = $this->commandMapper->getCommandHandler(get_class($command));
        } catch (NotMappedException $exception) {
            throw new NotFoundException();
        }

        try {
            $handler = $this->container->get($handlerClassName);
        } catch (NotFoundExceptionInterface $exception) {
            throw new NotFoundException();
        }

        return $handler;
    }
}
