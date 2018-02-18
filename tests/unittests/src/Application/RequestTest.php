<?php

namespace Dieselnet\Application\Commands;

use Dieselnet\Application\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    /**
     * @test
     */
    public function getReturnsCorrectValue()
    {
        $classUnderTest = new Request([
            'key' => 'expected'
        ]);
        $this->assertEquals('expected', $classUnderTest->get('key'));
    }

    /**
     * @test
     */
    public function defaultValueReturned()
    {
        $classUnderTest = new Request([]);
        $this->assertEquals('default', $classUnderTest->get('key', 'default'));
    }

    /**
     * @test
     */
    public function nullReturnedIfParamDoesNotExists()
    {
        $classUnderTest = new Request([]);
        $this->assertNull($classUnderTest->get('key'));
    }
}
