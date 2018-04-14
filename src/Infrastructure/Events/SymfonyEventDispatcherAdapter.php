<?php

namespace Dieselnet\Infrastructure\Events;

use Dieselnet\Application\EventDispatcherInterface;
use Dieselnet\Domain\Kernel\DomainEventInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class SymfonyEventDispatcherAdapter implements EventDispatcherInterface
{
    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(EventDispatcher $eventDispatcher, ContainerInterface $container)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->container = $container;
    }

    /**
     * @param DomainEventInterface $event
     */
    public function dispatch(DomainEventInterface $event): void
    {
        $this->eventDispatcher->dispatch($event->getName(), new SymfonyEventBridge($event));
    }

    /**
     * @param string $eventName
     * @param $listener
     * @return void
     */
    public function addListener(string $eventName, $listener): void
    {
        $this->eventDispatcher->addListener($eventName, function (SymfonyEventBridge $event) use ($listener) {
            $this->callListener($event->getSourceEvent(), $listener);
        });
    }

    /**
     * @param DomainEventInterface $event
     * @param $listener
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function callListener(DomainEventInterface $event, $listener): void
    {
        if (is_array($listener)) {
            $object = $listener[0];
            $method = $listener[1];

            if (is_string($object)) {
                $this->createAndCallObject($object, $method, $event);
            } else {
                $this->callObject($object, $method, $event);
            }
        }
    }

    /**
     * @param $object
     * @param $method
     * @param DomainEventInterface $event
     */
    private function callObject($object, $method, DomainEventInterface $event): void
    {
        if (method_exists($object, $method)) {
            $object->{$method}($event);
        }
    }

    /**
     * @param $objectClass
     * @param $method
     * @param DomainEventInterface $event
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function createAndCallObject($objectClass, $method, DomainEventInterface $event): void
    {
        $object = $this->container->get($objectClass);
        $this->callObject($object, $method, $event);
    }
}
