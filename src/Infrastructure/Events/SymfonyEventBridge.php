<?php

namespace Dieselnet\Infrastructure\Events;

use Dieselnet\Domain\Common\DomainEventInterface;
use Symfony\Component\EventDispatcher\Event;

class SymfonyEventBridge extends Event
{
    /**
     * @var DomainEventInterface
     */
    private $event;

    /**
     * @param DomainEventInterface $event
     */
    public function __construct(DomainEventInterface $event)
    {
        $this->event = $event;
    }

    /**
     * @return DomainEventInterface
     */
    public function getSourceEvent(): DomainEventInterface
    {
        return $this->event;
    }
}
