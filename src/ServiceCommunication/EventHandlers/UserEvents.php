<?php

namespace Dieselnet\ServiceCommunication\EventHandlers;

use Dieselnet\Domain\User\Events\UserSignupEvent;
use Dieselnet\ServiceCommunication\MessageBroker\MessageBroker;

class UserEvents
{
    /**
     * @var MessageBroker
     */
    private $messageBroker;

    /**
     * @param MessageBroker $messageBroker
     */
    public function __construct(MessageBroker $messageBroker)
    {
        $this->messageBroker = $messageBroker;
    }

    /**
     * @param UserSignupEvent $event
     */
    public function onUserSignup(UserSignupEvent $event)
    {

    }
}
