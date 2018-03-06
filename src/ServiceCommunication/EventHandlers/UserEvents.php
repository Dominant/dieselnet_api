<?php

namespace Dieselnet\ServiceCommunication\EventHandlers;

use Dieselnet\Domain\User\Events\UserSignupEvent;
use Dieselnet\ServiceCommunication\MessageBroker\MessageBroker;
use Dieselnet\ServiceCommunication\MessageBroker\Messages\SmsVerificationCode;

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
        $this->messageBroker->produce(new SmsVerificationCode(
            $event->getUser()->details()->phone(),
            $event->getUser()->verificationCode()
        ));
    }
}
