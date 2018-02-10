<?php

namespace Dieselnet\Application\Handlers\User;

use Dieselnet\Application\CommandHandlerInterface;
use Dieselnet\Application\Commands\User\SignupCommand;
use Dieselnet\Application\Response\ResponseInterface;
use Dieselnet\Application\Response\Success;

class SignupHandler implements CommandHandlerInterface
{
    /**
     * @param SignupCommand $command
     *
     * @return ResponseInterface
     */
    public function handle(SignupCommand $command): ResponseInterface
    {
        return new Success([
            'test' => true
        ]);
    }
}
