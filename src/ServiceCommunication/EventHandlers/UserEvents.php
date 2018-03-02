<?php

namespace Dieselnet\ServiceCommunication\EventHandlers;

use Dieselnet\Domain\User\Events\UserSignupEvent;

class UserEvents
{
    /**
     * @param UserSignupEvent $event
     */
    public function onUserSignup(UserSignupEvent $event)
    {
        echo $event->getUser()->verificationCode();
        exit;
    }
}
