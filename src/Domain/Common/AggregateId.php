<?php

namespace Dieselnet\Domain\Common;

use Ramsey\Uuid\Uuid;

class AggregateId
{
    /**
     * @var string
     */
    private $id;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $id
     * @return AggregateId
     */
    public static function fromString(string $id)
    {
        return new self($id);
    }

    /**
     * @return AggregateId
     */
    public static function generate(): self
    {
        return new self(Uuid::uuid4());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->id;
    }
}