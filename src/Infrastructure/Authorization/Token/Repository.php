<?php

namespace Dieselnet\Infrastructure\Authorization\Token;

use Dieselnet\Domain\Authorization\Token\RepositoryInterface;
use Dieselnet\Domain\Authorization\Token\Token;

class Repository implements RepositoryInterface
{
    /**
     * @param string $token
     *
     * @return Token|null
     */
    public function getByToken(string $token): ? Token
    {
        return null;
    }
}
