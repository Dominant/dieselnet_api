<?php

namespace Dieselnet\Domain\User;

use Dieselnet\Domain\Kernel\AggregateId;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @var ArrayCollection|Machine[]
     */
    private $wishlist;

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
        $this->wishlist = new ArrayCollection();
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

    /**
     * @return ArrayCollection
     */
    public function wishlist()
    {
        return $this->wishlist;
    }

    /**
     * @param Machine $machine
     */
    public function addMachineToWishlist(Machine $machine)
    {
        if (!$this->isMachineInWishlist($machine)) {
            $this->wishlist[] = $machine;
        }
    }

    /**
     * @param Machine $machine
     *
     * @return bool
     */
    public function isMachineInWishlist(Machine $machine): bool
    {
        $inWishlist = false;

        foreach ($this->wishlist as $machineInWishlist) {
            if ($machineInWishlist->equals($machine)) {
                $inWishlist = true;
                break;
            }
        }

        return $inWishlist;
    }

    /**
     * @param Machine $machine
     */
    public function removeMachineFromWishlist(Machine $machine)
    {
        foreach ($this->wishlist as $index => $machineInWishlist) {
            if ($machineInWishlist->equals($machine)) {
                $this->wishlist->remove($machineInWishlist);
                $machineInWishlist->detachFromUser();
            }
        }
    }
}
