<?php

namespace Dieselnet\Infrastructure\Persistance;

use Dieselnet\Domain\Kernel\AggregateId;
use Dieselnet\Domain\User\RepositoryInterface;
use Dieselnet\Domain\User\User;

class UserRepository extends AbstractRepository implements RepositoryInterface
{
    /**
     * @var string
     */
    protected $entityRepositoryClass = User::class;

    /**
     * @param User $user
     *
     * @return bool
     */
    public function save(User $user): bool
    {
        return $this->store($user);
    }

    /**
     * @param string $phone
     *
     * @return User|null
     */
    public function findByPhone(string $phone): ?User
    {
        /** @var User|\null $user */
        $user = $this->repository()->findOneBy([
            'details.phone' => $phone
        ]);

        return $user;
    }

    /**
     * @param AggregateId $userId
     *
     * @return User|null
     */
    public function find(AggregateId $userId): ?User
    {
        /** @var User | null $user */
        $user = $this->repository()->find((string)$userId);

        return $user;
    }
}
