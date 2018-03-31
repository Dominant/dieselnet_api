<?php

namespace Dieselnet\Application\Handlers\User;

use Dieselnet\Application\CommandHandlerInterface;
use Dieselnet\Application\Commands\User\VerifyCodeCommand;
use Dieselnet\Application\Response\Error;
use Dieselnet\Application\Response\ResponseInterface;
use Dieselnet\Application\Response\Success;
use Dieselnet\Domain\Authorization\Token;
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
     * @var Token\RepositoryInterface
     */
    private $tokenRepository;

    /**
     * @param RepositoryInterface $repository
     * @param Token\RepositoryInterface $tokenRepository
     */
    public function __construct(RepositoryInterface $repository, Token\RepositoryInterface $tokenRepository)
    {
        $this->repository = $repository;
        $this->tokenRepository = $tokenRepository;
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
                $token = Token\Token::generateFor($user->getId());

                $this->repository->save($user);
                $this->tokenRepository->save($token);

                $response = new Success(200, [
                    'token' => (string) $token,
                    'reference' => (string) $user->getId()
                ]);
            }

        } catch (DomainException | InvalidVerificationCodeException $exception) {
            $response = new Error(400, ['wrong code']);
        }

        return $response;
    }
}
