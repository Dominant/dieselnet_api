<?php

namespace Dieselnet\Domain\User;

class Wishlist
{
    /**
     * @var Machine[]
     */
    private $machines;

    /**
     * @param Machine[] $machines
     */
    public function __construct(array $machines)
    {
        $this->machines = $machines;
    }

    /**
     * @param Machine $machine
     */
    public function add(Machine $machine): void
    {
        $this->machines[] = $machine;
    }

    /**
     * @param Machine $machineToRemove
     */
    public function remove(Machine $machineToRemove): void
    {
        foreach ($this->machines as $index => $machine) {
            if ($machine->equals($machineToRemove)) {
                unset($this->machines[$index]);
            }
        }
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->machines;
    }
}
