<?php

namespace Dieselnet\Domain\User;

class PortalDetails
{
    const TYPE_BUSINESS = 'business';
    const TYPE_PRIVATE = 'private';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @param int $id
     * @param string $type
     */
    public function __construct(
        int $id = 0,
        string $type = self::TYPE_BUSINESS
    ) {
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }
}
