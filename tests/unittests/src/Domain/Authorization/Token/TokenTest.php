<?php

namespace Dieselnet\Domain\Authorization\Token;

use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{
    /**
     * @test
     */
    public function constructWithTokenAndVerifyGetter()
    {
        $tokenString = 'tokenString';
        $classUnderTest = new Token($tokenString);

        $this->assertSame($tokenString, $classUnderTest->token());
    }
}
