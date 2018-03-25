<?php

namespace Dieselnet\Domain\Authorization\Token;

use PHPUnit\Framework\TestCase;
use Dieselnet\Domain\Common\AggregateId;

class TokenTest extends TestCase
{
    /**
     * @test
     */
    public function constructWithTokenAndVerifyGetter()
    {
        $tokenString = 'tokenString';
        $classUnderTest = new Token($tokenString, new AggregateId('asdasdasdasdasd'));

        $this->assertSame($tokenString, $classUnderTest->token());
    }
}
