<?php

namespace Dieselnet\Domain\Authorization\Token;

interface RepositoryInterface
{
    /**
     * @param string $token
     * @return Token|null
     */
    public function find(string $token): ?Token;

    /**
     * @param Token $token
     * @return bool
     */
    public function save(Token $token): bool;
}
