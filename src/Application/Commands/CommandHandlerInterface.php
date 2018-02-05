<?php

namespace Dieselnet\Application\Commands;

interface CommandHandlerInterface
{
    public function handle(CommandInterface $command): void;
}
