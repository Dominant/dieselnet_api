<?php

namespace Dieselnet\Domain\User;

use Dieselnet\Domain\Common\AggregateId;

class User
{
    /**
     * @var AggregateId
     */
    private $id;

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
     * @param AggregateId $id
     * @param Details $details
     * @param bool $isVerified
     * @param VerificationCode $verificationCode
     */
    public function __construct(
        AggregateId $id,
        Details $details,
        bool $isVerified,
        VerificationCode $verificationCode
    ) {
        $this->id = $id;
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

        $this->isVerified = true;
    }

    /**
     * @return VerificationCode
     */
    public function verificationCode(): VerificationCode
    {
        return $this->verificationCode;
    }

    /**
     * @param Details $details
     */
    public function changeDetails(Details $details)
    {
        $this->details = $details;
    }

    /**
     * @param VerificationCode $verificationCode
     */
    public function changeVerificationCode(VerificationCode $verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

    /**
     * @return AggregateId
     */
    public function getId(): AggregateId
    {
        return $this->id;
    }
}
