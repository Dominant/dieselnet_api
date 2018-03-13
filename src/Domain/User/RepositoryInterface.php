<?php

namespace Dieselnet\Domain\User;

interface RepositoryInterface
{
    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user): bool;

    /**
     * @param string $phone
     * @return bool
     */
    public function phoneAlreadyUsed(string $phone): bool;

    /**
     * @param string $phone
     * @return User|null
     */
    public function findByPhone(string $phone): ?User;
}
