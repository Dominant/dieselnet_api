<?php

namespace Dieselnet\Domain\User;

class VerificationCode
{
    /**
     * @var int
     */
    private $code;

    /**
     * @param int $code
     */
    public function __construct(int $code)
    {
        $this->code = $code;
    }

    /**
     * @return VerificationCode
     */
    public static function generate(): self
    {
        $code = rand(1000, 9999);
        return new self($code);
    }

    /**
     * @param VerificationCode $verificationCode
     * @return bool
     */
    public function assertSame(VerificationCode $verificationCode): bool
    {
        return assert($this->code, (string) $verificationCode);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->code;
    }
}
