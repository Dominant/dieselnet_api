<?php

namespace Dieselnet\Domain\Authorization\Token;

interface RepositoryInterface
{
    public function fetch(string $token): ?Token;
}
