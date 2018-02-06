<?php

namespace Dieselnet\Infrastructure\UI\Web\Actions;

use Dieselnet\Application\Commands\CommandBus;
use Dieselnet\DIKeys;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractAction implements ActionInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * @return CommandBus
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function commandBus(): CommandBus
    {
        return $this->getContainer()->get(DIKeys::COMMAND_BUS);
    }

    /**
     * @param ResponseInterface $response
     * @param                   $content
     * @param bool              $isJson
     *
     * @return ResponseInterface
     */
    public function writeToResponse(ResponseInterface $response, $content, $isJson = true): ResponseInterface
    {
        $content = $isJson ? json_encode($content) : $content;
        $response->getBody()->write($content);

        return $response;
    }
}
