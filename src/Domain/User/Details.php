<?php

namespace Dieselnet\Domain\User;

use Dieselnet\Domain\Assert;

class Details
{
    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $deviceId;

    /**
     * @param string $phone
     * @param string $deviceId
     */
    public function __construct(
        string $phone,
        string $deviceId
    ) {
        Assert::notEmpty($phone);
        Assert::notEmpty($deviceId);

        $this->phone = $phone;
        $this->deviceId = $deviceId;
    }

    /**
     * @return string
     */
    public function phone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function deviceId(): string
    {
        return $this->deviceId;
    }
}
