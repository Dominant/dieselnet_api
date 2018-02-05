<?php

namespace Dieselnet\Domain\Authorization\Token;

class Verifier
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
     * @param string $token
     *
     * @return bool
     */
    public function isValid(string $token): bool
    {
        if (empty($token)) {
            return false;
        }

        $token = $this->repository->getByToken($token);
        $isValid = !is_null($token);

        return $isValid;
    }
}
