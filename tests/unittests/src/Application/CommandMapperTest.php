<?php

namespace Dieselnet\Application\Commands;

use Dieselnet\Application\CommandMapper;
use PHPUnit\Framework\TestCase;

class CommandMapperTest extends TestCase
{
    /**
     * @test
     * @expectedException \Dieselnet\Application\NotMappedException
     */
    public function notMappedExceptionIsThrown()
    {
        $classUnderTest = new CommandMapper('Test', 'Test');
        $classUnderTest->getCommandHandler('Test\\Handler\\Not\\Mapped');
    }

    /**
     * @test
     */
    public function mappedCommandReturnCorrectHandlerName()
    {
        $classUnderTest = new CommandMapper('Test', 'Test');
        $expectedResult = 'Test\\Handler\\MappedHandler';
        $result = $classUnderTest->getCommandHandler('Test\\Handler\\MappedCommand');

        $this->assertEquals($expectedResult, $result);
    }
}
