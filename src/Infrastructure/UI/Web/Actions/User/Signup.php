<?php

namespace Dieselnet\Infrastructure\UI\Web\Actions\User;

use Dieselnet\Application\Commands\User\SignupCommand;
use Dieselnet\Application\Commands\User\SignupHandler;
use Dieselnet\Infrastructure\UI\Web\Actions\AbstractAction;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class Signup extends AbstractAction
{
    /**
     * @param ServerRequestInterface  $request
     * @param ResponseInterface $response
     * @param $args
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $command = new SignupCommand('', '');
        /** @var SignupHandler $handler */
        $handler = $this->commandBus()->getHandler($command);
        $handler->handle($command);

        return $this->writeToResponse($response, [
            'test' => true
        ]);
    }
}
