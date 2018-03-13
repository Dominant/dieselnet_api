<?php

namespace Dieselnet\Infrastructure\Persistance;

use Dieselnet\Domain\User\RepositoryInterface;
use Dieselnet\Domain\User\User;
use Doctrine\ORM\ORMException;

class UserRepository extends AbstractRepository implements RepositoryInterface
{
    /**
     * @var string
     */
    protected $entityRepositoryClass = User::class;

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user): bool
    {
        try {
            $this->em()->persist($user);
            $this->em()->flush();
        } catch (ORMException $e) {
            return false;
        }

        return true;
    }

    /**
     * @param string $phone
     * @return bool
     */
    public function phoneAlreadyUsed(string $phone): bool
    {
        $user = $this->repository()->findOneBy([
            'details.phone' => $phone
        ]);

        return !is_null($user);
    }

    /**
     * @param string $phone
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
}
