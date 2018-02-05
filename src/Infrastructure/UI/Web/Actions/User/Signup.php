<?php

namespace Dieselnet\Infrastructure\UI\Web\Actions\User;

use Dieselnet\Infrastructure\UI\Web\Actions\AbstractAction;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Signup extends AbstractAction
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param                   $args
     *
     * @return ResponseInterface
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, $args): ResponseInterface
    {
        return $this->writeToResponse($response, [
            'test' => true
        ]);
    }
}
