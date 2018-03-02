<?php

namespace Dieselnet\Application\Handlers\User;

use Dieselnet\Application\CommandHandlerInterface;
use Dieselnet\Application\Commands\User\SignupCommand;
use Dieselnet\Application\EventDispatcherInterface;
use Dieselnet\Domain\User\Events\UserSignupEvent;
use Dieselnet\Application\Response\Error;
use Dieselnet\Application\Response\ResponseInterface;
use Dieselnet\Application\Response\Success;
use Dieselnet\Domain\User\Details;
use Dieselnet\Domain\User\RepositoryInterface;
use Dieselnet\Domain\User\User;
use Dieselnet\Domain\User\VerificationCode;

class SignupHandler implements CommandHandlerInterface
{
    /**
     * @var RepositoryInterface
     */
    private $repository;
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param RepositoryInterface $repository
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(RepositoryInterface $repository, EventDispatcherInterface $eventDispatcher)
    {
        $this->repository = $repository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param SignupCommand $command
     *
     * @return ResponseInterface
     */
    public function handle(SignupCommand $command): ResponseInterface
    {
        $user = new User(
            new Details($command->getPhoneNumber()),
            false,
            VerificationCode::generate()
        );

        if ($this->repository->save($user)) {
            $response = new Success();
            $this->eventDispatcher->dispatch(new UserSignupEvent($user));
        } else {
            $response = new Error(500, ['technical error.']);
        }

        return $response;
    }
}
