<?php

namespace Dieselnet\Domain\Authorization\Token;

class Token
{
    /**
     * @var string
     */
    private $token;

    /**
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function token(): string
    {
        return $this->token;
    }
}
