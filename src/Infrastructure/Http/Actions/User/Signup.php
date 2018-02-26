<?php

namespace Dieselnet\Infrastructure\Http\Actions\User;

use Dieselnet\Application\Commands\User\SignupCommand;
use Dieselnet\Application\Handlers\User\SignupHandler;
use Dieselnet\Infrastructure\Http\Actions\AbstractAction;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Signup extends AbstractAction
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $command = new SignupCommand('', '');
        /** @var SignupHandler $handler */
        $handler = $this->commandBus()->getHandler($command);
        $handlerResponse = $handler->handle($command);

        return $this->jsonResponse($response, $handlerResponse);
    }
}
