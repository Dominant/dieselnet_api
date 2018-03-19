<?php

namespace Dieselnet\Application\Handlers\User;

use Dieselnet\Application\CommandHandlerInterface;
use Dieselnet\Application\Commands\User\VerifyCodeCommand;
use Dieselnet\Application\Response\Error;
use Dieselnet\Application\Response\ResponseInterface;
use Dieselnet\Application\Response\Success;
use Dieselnet\Domain\DomainException;
use Dieselnet\Domain\User\InvalidVerificationCodeException;
use Dieselnet\Domain\User\RepositoryInterface;
use Dieselnet\Domain\User\VerificationCode;

class VerifyCodeHandler implements CommandHandlerInterface
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
     * @param VerifyCodeCommand $command
     * @return ResponseInterface
     */
    public function handle(VerifyCodeCommand $command): ResponseInterface
    {
        try {
            $phone = $command->getPhoneNumber();
            $user = $this->repository->findByPhone($phone);

            if ($user == null) {
                $response = new Error(400, ['bad request.']);
            } else {
                $user->verifyCode(new VerificationCode($command->getCode()));
                $response = new Success();
                $this->repository->save($user);
            }

        } catch (DomainException | InvalidVerificationCodeException $exception) {
            $response = new Error(400, ['bad request']);
        }

        return $response;
    }
}
