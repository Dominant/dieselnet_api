<?php

namespace Dieselnet\Domain\Authorization\Token;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class VerifierTest extends TestCase
{
    /**
     * @test
     */
    public function emptyStringFailsVerification()
    {
        /** @var RepositoryInterface|MockObject $repositoryMock */
        $repositoryMock = $this->createMock(RepositoryInterface::class);
        $classUnderTest = new Verifier($repositoryMock);
        $token = '';

        $this->assertFalse($classUnderTest->isValid($token));
    }

    /**
     * @test
     */
    public function notFoundTokenFailsVerification()
    {
        $token = 'tokenString';
        /** @var RepositoryInterface|MockObject $repositoryMock */
        $repositoryMock = $this->createMock(RepositoryInterface::class);
        $repositoryMock->expects($this->once())
            ->method('getByToken')
            ->with($token)
            ->willReturn(null);
        $classUnderTest = new Verifier($repositoryMock);

        $this->assertFalse($classUnderTest->isValid($token));
    }

    /**
     * @test
     */
    public function foundTokenSucceedsVerification()
    {
        $tokenString = 'tokenString';
        $token = $this->createMock(Token::class);
        /** @var RepositoryInterface|MockObject $repositoryMock */
        $repositoryMock = $this->createMock(RepositoryInterface::class);
        $repositoryMock->expects($this->once())
            ->method('getByToken')
            ->with($tokenString)
            ->willReturn($token);
        $classUnderTest = new Verifier($repositoryMock);

        $this->assertTrue($classUnderTest->isValid($tokenString));
    }
}
