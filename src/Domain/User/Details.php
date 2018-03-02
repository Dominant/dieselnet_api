<?php

namespace Dieselnet\Domain\User;

class Details
{
    /**
     * @var string
     */
    private $phone;

    /**
     * @param string $phone
     */
    public function __construct(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function phone(): string
    {
        return $this->phone;
    }
}
