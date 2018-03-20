<?php

namespace Dieselnet\Infrastructure\Persistance;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;

abstract class AbstractRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return EntityManager
     */
    public function em(): EntityManager
    {
        return $this->em;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    public function repository()
    {
        return $this->em()->getRepository($this->entityRepositoryClass);
    }

    /**
     * @param $object
     * @return bool
     */
    protected function store($object): bool
    {
        try {
            $this->em()->persist($object);
            $this->em()->flush();
        } catch (ORMException $e) {
            return false;
        }

        return true;
    }
}
