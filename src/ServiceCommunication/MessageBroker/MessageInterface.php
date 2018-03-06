<?php

namespace Dieselnet\ServiceCommunication\MessageBroker;

interface MessageInterface
{
    /**
     * @return string
     */
    public function queueName(): string;

    /**
     * @return string
     */
    public function toJson(): string;
}
