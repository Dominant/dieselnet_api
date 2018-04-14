<?php

namespace Dieselnet\Domain\User;

use Dieselnet\Domain\Kernel\AggregateId;

interface RepositoryInterface
{
    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user): bool;

    /**
     * @param string $phone
     * @return User|null
     */
    public function findByPhone(string $phone): ?User;

    /**
     * @param AggregateId $userId
     *
     * @return User|null
     */
    public function find(AggregateId $userId): ?User;
}
