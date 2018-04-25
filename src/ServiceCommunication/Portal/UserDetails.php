<?php

namespace Dieselnet\ServiceCommunication\Portal;

use Dieselnet\Domain\Assert;

class UserDetails
{
    /**
     * @var string
     */
    private $companyName;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $address;

    /**
     * @param string $companyName
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $address
     */
    public function __construct(
        string $companyName,
        string $firstName,
        string $lastName,
        string $email,
        string $address
    ) {
        Assert::notEmpty($companyName);
        Assert::notEmpty($firstName);
        Assert::notEmpty($lastName);
        Assert::notEmpty($email);
        Assert::notEmpty($address);

        $this->companyName = $companyName;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return array
     */
    public function toPortalRequestPayload()
    {
        return [
            'company_name' => $this->getCompanyName(),
            'firstname' => $this->getFirstName(),
            'lastname' => $this->getLastName(),
            'email' => $this->getEmail(),
            'address' => $this->getAddress()
        ];
    }
}
