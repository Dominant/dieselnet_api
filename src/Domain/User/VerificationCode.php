<?php

namespace Dieselnet\Domain\User;

class VerificationCode
{
    /**
     * @var string
     */
    private $code;

    /**
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return VerificationCode
     */
    public static function generate(): self
    {
        $code = (string) rand(1000, 9999);
        return new self($code);
    }

    /**
     * @param string $code
     * @return VerificationCode
     */
    public static function fromString(string $code): self
    {
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
