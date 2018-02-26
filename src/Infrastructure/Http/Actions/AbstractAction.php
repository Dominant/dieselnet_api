<?php

namespace Dieselnet\Infrastructure\Http\Actions;

use Dieselnet\Application\CommandBus;
use Dieselnet\Application\Response\ResponseInterface as HandlerResponseInterface;
use Dieselnet\DIKeys;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractAction
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
        return $this->getContainer()->get(CommandBus::class);
    }

    /**
     * @param ResponseInterface        $response
     * @param HandlerResponseInterface $handlerResponse
     *
     * @return ResponseInterface
     */
    public function jsonResponse(ResponseInterface $response, HandlerResponseInterface $handlerResponse): ResponseInterface
    {
        $response->getBody()->write(json_encode([
            'success' => $handlerResponse->isSuccess(),
            'payload' => $handlerResponse->getPayload()
        ]));

        return $response;
    }
}
