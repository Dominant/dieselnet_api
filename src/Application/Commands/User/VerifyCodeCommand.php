<?php

namespace Dieselnet\Application\Commands\User;

use Dieselnet\Application\CommandInterface;

class VerifyCodeCommand implements CommandInterface
{
    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $code;

    /**
     * @param string $phoneNumber
     * @param string $code
     */
    public function __construct(string $phoneNumber, string $code)
    {
        $this->phoneNumber = $phoneNumber;
        $this->code = $code;
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
    public function getCode(): string
    {
        return $this->code;
    }
}
