<?php

namespace Dieselnet\Infrastructure\Persistance;

use Doctrine\ORM\EntityManager;

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
}
