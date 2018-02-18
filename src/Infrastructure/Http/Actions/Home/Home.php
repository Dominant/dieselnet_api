<?php

namespace Dieselnet\Infrastructure\Http\Actions\Home;

use Dieselnet\Infrastructure\Http\Actions\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Home extends AbstractAction
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param                        $args
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        $response->getBody()->write('home');
        return $response;
    }
}