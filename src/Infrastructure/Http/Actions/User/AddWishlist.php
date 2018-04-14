<?php

namespace Dieselnet\Infrastructure\Http\Actions\User;

use Dieselnet\Application\Commands\User\AddWishlistCommand;
use Dieselnet\Application\Handlers\User\AddWishlistHandler;
use Dieselnet\Domain\Kernel\AggregateId;
use Dieselnet\Infrastructure\Http\Actions\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AddWishlist extends AbstractAction
{
    /**
     * @param string $reference
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function __invoke(string $reference, ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = $request->getParsedBody();
        $command = new AddWishlistCommand(
            AggregateId::fromString($reference),
            $params['machineId']
        );
        /** @var AddWishlistHandler $handler */
        $handler = $this->commandBus()->getHandler($command);
        $handlerResponse = $handler->handle($command);

        return $this->jsonResponse($response, $handlerResponse);
    }
}
