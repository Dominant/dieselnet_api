<?php

namespace Dieselnet\Infrastructure\Persistance;

use Dieselnet\Domain\Authorization\Token\RepositoryInterface;
use Dieselnet\Domain\Authorization\Token\Token;

class TokenRepository extends AbstractRepository implements RepositoryInterface
{
    /**
     * @var string
     */
    protected $entityRepositoryClass = Token::class;

    /**
     * @param string $token
     *
     * @return Token|null
     */
    public function find(string $token): ?Token
    {
        return $this->repository()->find($token);
    }

    /**
     * @param Token $token
     * @return bool
     */
    public function save(Token $token): bool
    {
        $qb = $this->em()->createQueryBuilder();
        $qb->delete(Token::class, 't');
        $qb->where('t.reference = :reference');
        $qb->setParameter('reference', (string) $token->getReference());
        $qb->getQuery()->execute();

        return $this->store($token);
    }
}
