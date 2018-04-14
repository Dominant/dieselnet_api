<?php

namespace Dieselnet\Application\Commands\User;

use Dieselnet\Application\CommandInterface;
use Dieselnet\Domain\Kernel\AggregateId;

class GetWishlistCommand implements CommandInterface
{
    /**
     * @var AggregateId
     */
    private $userId;

    /**
     * @param AggregateId $userId
     */
    public function __construct(AggregateId $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return AggregateId
     */
    public function getUserId(): AggregateId
    {
        return $this->userId;
    }
}
