<?php

namespace Dieselnet\Infrastructure\Http\Actions\User;

use Dieselnet\Application\Commands\User\VerifyCodeCommand;
use Dieselnet\Infrastructure\Http\Actions\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class VerifyCode extends AbstractAction
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
        $params = $request->getParsedBody();
        $command = new VerifyCodeCommand($params['phone'], $params['code']);
        /** @var VerifyCodeCommand $handler */
        $handler = $this->commandBus()->getHandler($command);
        $handlerResponse = $handler->handle($command);

        return $this->jsonResponse($response, $handlerResponse);
    }
}