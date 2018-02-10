<?php

namespace Dieselnet\Infrastructure\Common;

use Dieselnet\Infrastructure\Http\Middlewares\JsonResponseMiddleware;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class JsonResponseMiddlewareTest extends TestCase
{
    /**
     * @test
     */
    public function jsonHeaderAddedToResponse()
    {
        /** @var RequestInterface|MockObject $requestMock */
        $requestMock = $this->createMock(RequestInterface::class);
        /** @var ResponseInterface|MockObject $responseMock */
        $responseMock = $this->createMock(ResponseInterface::class);
        $callable = function ($request, $response) {
            return $response;
        };
        $responseMock->expects($this->once())
            ->method('withHeader')
            ->with('Content-type', 'application/json')
            ->willReturnSelf();

        // verified by execution
        $classUnderTest = new JsonResponseMiddleware();
        $classUnderTest($requestMock, $responseMock, $callable);
    }
}
