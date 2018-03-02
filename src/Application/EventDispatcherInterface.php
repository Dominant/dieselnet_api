<?php

namespace Dieselnet\Application;

use Dieselnet\Domain\Common\DomainEventInterface;

interface EventDispatcherInterface
{
    /**
     * @param DomainEventInterface $event
     */
    public function dispatch(DomainEventInterface $event): void;

    /**
     * @param string $eventName
     * @param $listener
     * @return mixed
     */
    public function addListener(string $eventName, $listener);
}
