<?php

namespace Dieselnet\Infrastructure\Persistance;

use Dieselnet\Domain\User\RepositoryInterface;
use Dieselnet\Domain\User\User;

class UserRepository implements RepositoryInterface
{
    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user): bool
    {
        return true;
    }
}
