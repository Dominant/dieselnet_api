<?php

namespace Dieselnet\Application\Commands;

use PHPUnit\Framework\TestCase;

class CommandMapperTest extends TestCase
{
    /**
     * @test
     * @expectedException \Dieselnet\Application\Commands\NotMappedException
     */
    public function notMappedExceptionIsThrown()
    {
        $classUnderTest = new CommandMapper();
        $classUnderTest->getCommandHandler('Test\\Handler\\Not\\Mapped');
    }

    /**
     * @test
     */
    public function mappedCommandReturnCorrectHandlerName()
    {
        $classUnderTest = new CommandMapper();
        $expectedResult = 'Test\\Handler\\MappedHandler';
        $result = $classUnderTest->getCommandHandler('Test\\Handler\\MappedCommand');

        $this->assertEquals($expectedResult, $result);
    }
}
