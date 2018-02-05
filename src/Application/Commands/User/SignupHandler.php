<?php

namespace Dieselnet\Application\Commands\User;

use Dieselnet\Application\Commands\CommandHandlerInterface;
use Dieselnet\Application\Commands\CommandInterface;

class SignupHandler implements CommandHandlerInterface
{
    /**
     * @param CommandInterface|SignupCommand $command
     */
    public function handle(CommandInterface $command): void
    {

    }
}
