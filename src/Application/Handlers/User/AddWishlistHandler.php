<?php

namespace Dieselnet\Application\Handlers\User;

use Dieselnet\Application\CommandHandlerInterface;
use Dieselnet\Application\Commands\User\AddWishlistCommand;
use Dieselnet\Application\Response\ResponseInterface;
use Dieselnet\Application\Response\Success;
use Dieselnet\Domain\User\Machine;
use Dieselnet\Domain\User\RepositoryInterface;

class AddWishlistHandler implements CommandHandlerInterface
{
    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param AddWishlistCommand $command
     *
     * @return ResponseInterface
     */
    public function handle(AddWishlistCommand $command): ResponseInterface
    {
        $user = $this->repository->find($command->getUserId());
        $machineId = $command->getMachineId();
        $machine = new Machine($user, $machineId);

        $user->addMachineToWishlist($machine);
        $this->repository->save($user);

        return new Success();
    }
}
