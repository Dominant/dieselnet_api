<?php

namespace Dieselnet\Domain\User;

class Machine implements \JsonSerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var User
     */
    private $user;

    /**
     * @var int
     */
    private $machineId;

    /**
     * @param User $user
     * @param int $machineId
     */
    public function __construct(
        User $user,
        int $machineId
    ) {
        $this->user = $user;
        $this->machineId = $machineId;
    }

    /**
     * @return int
     */
    public function getMachineId(): int
    {
        return $this->machineId;
    }

    /**
     * @param Machine $machine
     *
     * @return bool
     */
    public function equals(Machine $machine): bool
    {
        return $this->getMachineId() === $machine->getMachineId();
    }

    /**
     * @return null
     */
    public function detachFromUser()
    {
        $this->user = null;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getMachineId()
        ];
    }
}
