<?php

use Dieselnet\Application\EventDispatcherInterface;
use Dieselnet\Domain\User\Events\UserSignupEvent;
use Dieselnet\ServiceCommunication\EventHandlers\UserEvents;

$container->get(EventDispatcherInterface::class)->addListener(
    UserSignupEvent::NAME, [UserEvents::class, 'onUserSignup']
);
