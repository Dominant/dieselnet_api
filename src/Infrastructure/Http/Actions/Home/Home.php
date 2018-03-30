<?php

namespace Dieselnet\Infrastructure\Http\Actions\Home;

use Dieselnet\Application\Response\Success;
use Dieselnet\Infrastructure\Http\Actions\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Home extends AbstractAction
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->jsonResponse($response, new Success());
    }
}
