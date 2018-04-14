<?php

namespace Dieselnet\Application\Commands\User;

use Dieselnet\Application\CommandInterface;
use Dieselnet\Domain\Kernel\AggregateId;

class AddWishlistCommand implements CommandInterface
{
    /**
     * @var AggregateId
     */
    private $userId;

    /**
     * @var int
     */
    private $machineId;

    /**
     * @param AggregateId $userId
     * @param int $machineId
     */
    public function __construct(AggregateId $userId, int $machineId)
    {
        $this->userId = $userId;
        $this->machineId = $machineId;
    }

    /**
     * @return AggregateId
     */
    public function getUserId(): AggregateId
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getMachineId(): int
    {
        return $this->machineId;
    }
}
