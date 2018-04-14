<?php

namespace Dieselnet\Domain\Kernel;

interface DomainEventInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return array
     */
    public function getPayload(): array;

    /**
     * @return string
     */
    public function jsonPayload(): string;
}
