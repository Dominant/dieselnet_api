<?php

namespace Dieselnet\Application\Handlers\User;

use Dieselnet\Application\CommandHandlerInterface;
use Dieselnet\Application\Commands\User\DeleteWishlistCommand;
use Dieselnet\Application\Response\ResponseInterface;
use Dieselnet\Application\Response\Success;
use Dieselnet\Domain\User\Machine;
use Dieselnet\Domain\User\RepositoryInterface;

class DeleteWishlistHandler implements CommandHandlerInterface
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
     * @param DeleteWishlistCommand $command
     *
     * @return ResponseInterface
     */
    public function handle(DeleteWishlistCommand $command): ResponseInterface
    {
        $user = $this->repository->find($command->getUserId());
        $machineId = $command->getMachineId();
        $machine = new Machine($user, $machineId);

        $user->removeMachineFromWishlist($machine);
        $this->repository->save($user);

        return new Success();
    }
}
