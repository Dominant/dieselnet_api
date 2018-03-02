<?php

namespace Dieselnet\Infrastructure\Persistance;

use Dieselnet\Domain\Authorization\Token\RepositoryInterface;
use Dieselnet\Domain\Authorization\Token\Token;

class TokenRepository implements RepositoryInterface
{
    /**
     * @param string $token
     *
     * @return Token|null
     */
    public function fetch(string $token): ?Token
    {
        return null;
    }
}
