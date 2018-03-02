<?php

namespace Dieselnet\Domain\User\Events;

use Dieselnet\Domain\Common\DomainEventInterface;
use Dieselnet\Domain\User\User;

class UserSignupEvent implements DomainEventInterface
{
    const NAME = 'user.signup';

    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return [
            'phone' => $this->user->details()->phone(),
            'verificationCode' => (string) $this->user->verificationCode()
        ];
    }

    /**
     * @return string
     */
    public function jsonPayload(): string
    {
        return json_encode($this->getPayload());
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
