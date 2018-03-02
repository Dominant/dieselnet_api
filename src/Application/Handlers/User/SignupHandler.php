<?php

namespace Dieselnet\Application\Handlers\User;

use Dieselnet\Application\CommandHandlerInterface;
use Dieselnet\Application\Commands\User\SignupCommand;
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
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
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
        } else {
            $response = new Error(500, ['technical error.']);
        }

        return $response;
    }
}
