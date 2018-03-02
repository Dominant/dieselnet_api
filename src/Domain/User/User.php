<?php

namespace Dieselnet\Domain\User;

class User
{
    /**
     * @var Details
     */
    private $details;

    /**
     * @var bool
     */
    private $isVerified;

    /**
     * @var VerificationCode
     */
    private $verificationCode;

    /**
     * @param Details $details
     * @param bool $isVerified
     * @param VerificationCode $verificationCode
     */
    public function __construct(
        Details $details,
        bool $isVerified,
        VerificationCode $verificationCode
    ) {
        $this->details = $details;
        $this->isVerified = $isVerified;
        $this->verificationCode = $verificationCode;
    }

    /**
     * @return Details
     */
    public function details(): Details
    {
        return $this->details;
    }

    /**
     * @param VerificationCode $verificationCode
     * @throws InvalidVerificationCodeException
     */
    public function verifyCode(VerificationCode $verificationCode): void
    {
        if (!$this->verificationCode->assertSame($verificationCode)) {
            throw new InvalidVerificationCodeException();
        }
    }

    /**
     * @return VerificationCode
     */
    public function verificationCode(): VerificationCode
    {
        return $this->verificationCode;
    }
}
