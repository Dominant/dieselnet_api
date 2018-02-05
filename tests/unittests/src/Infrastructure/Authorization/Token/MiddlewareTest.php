<?php

namespace Dieselnet\Infrastructure\Authorization\Token;

use Dieselnet\Domain\Authorization\Token\Verifier;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Slim\Http\Request;

class MiddlewareTest extends TestCase
{
    /**
     * @test
     */
    public function validTokenExecutesNextChain()
    {
        /** @var Request|MockObject $requestMock */
        $requestMock = $this->createMock(Request::class);
        $requestMock->expects($this->at(0))
            ->method('getHeaderLine')
            ->willReturn('token');
        $requestMock->expects($this->at(1))
            ->method('getAttribute')
            ->willReturn(true);

        /** @var ResponseInterface|MockObject $responseMock */
        $responseMock = $this->createMock(ResponseInterface::class);

        /** @var Verifier|MockObject $verifierMock */
        $verifierMock = $this->createMock(Verifier::class);
        $verifierMock->expects($this->once())
            ->method('isValid')
            ->willReturn(true);

        /** @var callable|MockObject $nextChainCallableMock */
        $nextChainCallableMock = $this->createPartialMock(\stdClass::class, ['__invoke']);
        $nextChainCallableMock->expects($this->once())
            ->method('__invoke')
            ->with($requestMock, $responseMock)
            ->willReturn($responseMock);

        $classUnderTest = new Middleware($verifierMock);
        $result = $classUnderTest($requestMock, $responseMock, $nextChainCallableMock);
        $this->assertSame($responseMock, $result);
    }

    /**
     * @test
     */
    public function invalidTokenBreaksChain()
    {
        /** @var Request|MockObject $requestMock */
        $requestMock = $this->createMock(Request::class);
        $requestMock->expects($this->at(0))
            ->method('getHeaderLine')
            ->willReturn('token');
        $requestMock->expects($this->at(1))
            ->method('getAttribute')
            ->willReturn(new class {
                public function getName()
                {
                    return 'notPublicRoute';
                }
            });

        $responseBodyMock = $this->createMock(StreamInterface::class);
        $responseBodyMock->expects($this->once())
            ->method('write')
            ->with(json_encode([
                'error' => 'invalidToken'
            ]));

        /** @var ResponseInterface|MockObject $responseMock */
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->expects($this->at(0))
            ->method('withStatus')
            ->with(403)
            ->willReturn($responseMock);
        $responseMock->expects($this->at(1))
            ->method('getBody')
            ->willReturn($responseBodyMock);

        /** @var Verifier|MockObject $verifierMock */
        $verifierMock = $this->createMock(Verifier::class);
        $verifierMock->expects($this->once())
            ->method('isValid')
            ->willReturn(false);

        /** @var callable|MockObject $nextChainCallableMock */
        $nextChainCallableMock = $this->createPartialMock(\stdClass::class, ['__invoke']);

        $classUnderTest = new Middleware($verifierMock);
        $result = $classUnderTest($requestMock, $responseMock, $nextChainCallableMock);
        $this->assertSame($responseMock, $result);
    }

    /**
     * @test
     */
    public function notFoundRouteReturns404Response()
    {
        /** @var Request|MockObject $requestMock */
        $requestMock = $this->createMock(Request::class);
        $requestMock->expects($this->at(0))
            ->method('getHeaderLine')
            ->willReturn('token');
        $requestMock->expects($this->at(1))
            ->method('getAttribute')
            ->willReturn(null);

        $responseBodyMock = $this->createMock(StreamInterface::class);
        $responseBodyMock->expects($this->once())
            ->method('write')
            ->with(json_encode([
                'error' => 'pageNotFound'
            ]));

        /** @var ResponseInterface|MockObject $responseMock */
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock->expects($this->at(0))
            ->method('withStatus')
            ->with(404)
            ->willReturn($responseMock);
        $responseMock->expects($this->at(1))
            ->method('getBody')
            ->willReturn($responseBodyMock);

        /** @var Verifier|MockObject $verifierMock */
        $verifierMock = $this->createMock(Verifier::class);
        $verifierMock->expects($this->once())
            ->method('isValid')
            ->willReturn(false);

        /** @var callable|MockObject $nextChainCallableMock */
        $nextChainCallableMock = $this->createPartialMock(\stdClass::class, ['__invoke']);

        $classUnderTest = new Middleware($verifierMock);
        $result = $classUnderTest($requestMock, $responseMock, $nextChainCallableMock);
        $this->assertSame($responseMock, $result);
    }
}
