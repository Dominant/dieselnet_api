<?php

namespace Dieselnet\Domain\Authorization\Token;

use Dieselnet\Domain\Kernel\AggregateId;

class Token
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var AggregateId
     */
    private $reference;

    /**
     * @param string $token
     * @param AggregateId $reference
     */
    public function __construct(string $token, AggregateId $reference)
    {
        $this->token = $token;
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function token(): string
    {
        return $this->token;
    }

    /**
     * @param AggregateId $aggregateId
     * @return Token
     */
    public static function generateFor(AggregateId $aggregateId): self
    {
        $token = bin2hex(openssl_random_pseudo_bytes(32));
        return new self($token, $aggregateId);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->token;
    }

    /**
     * @return AggregateId
     */
    public function getReference(): AggregateId
    {
        return $this->reference;
    }
}
