<?php

namespace Dieselnet\Domain\User;

interface RepositoryInterface
{
    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user): bool;
}
