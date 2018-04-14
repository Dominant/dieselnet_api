<?php

namespace Dieselnet\Infrastructure\Http\Actions\User;

use Dieselnet\Application\Commands\User\DeleteWishlistCommand;
use Dieselnet\Application\Handlers\User\DeleteWishlistHandler;
use Dieselnet\Domain\Kernel\AggregateId;
use Dieselnet\Infrastructure\Http\Actions\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DeleteWishlist extends AbstractAction
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
        $command = new DeleteWishlistCommand(
            AggregateId::fromString($reference),
            $params['machineId']
        );
        /** @var DeleteWishlistHandler $handler */
        $handler = $this->commandBus()->getHandler($command);
        $handlerResponse = $handler->handle($command);

        return $this->jsonResponse($response, $handlerResponse);
    }
}
