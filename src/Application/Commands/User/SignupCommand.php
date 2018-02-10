<?php

namespace Dieselnet\Application\Commands\User;

use Dieselnet\Application\CommandInterface;

class SignupCommand implements CommandInterface
{
    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $deviceId;

    /**
     * @param string $phoneNumber
     * @param string $deviceId
     */
    public function __construct(string $phoneNumber, string $deviceId)
    {
        $this->deviceId = $deviceId;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getDeviceId(): string
    {
        return $this->deviceId;
    }
}
