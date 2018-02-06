<?php

namespace Dieselnet\Domain\Authorization\Token;

interface RepositoryInterface
{
    public function getByToken(string $token): ?Token;
}
