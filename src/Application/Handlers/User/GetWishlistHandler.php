<?php

namespace Dieselnet\Application\Handlers\User;

use Dieselnet\Application\CommandHandlerInterface;
use Dieselnet\Application\Commands\User\GetWishlistCommand;
use Dieselnet\Application\Response\ResponseInterface;
use Dieselnet\Application\Response\Success;
use Dieselnet\Domain\User\RepositoryInterface;

class GetWishlistHandler implements CommandHandlerInterface
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
     * @param GetWishlistCommand $command
     *
     * @return ResponseInterface
     */
    public function handle(GetWishlistCommand $command): ResponseInterface
    {
        $user = $this->repository->find($command->getUserId());

        return new Success(200, [
            'wishlist' => $user->wishlist()->toArray()
        ]);
    }
}
