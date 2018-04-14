<?php

namespace Dieselnet\Infrastructure\Http\Actions\User;

use Dieselnet\Application\Commands\User\GetWishlistCommand;
use Dieselnet\Application\Handlers\User\GetWishlistHandler;
use Dieselnet\Domain\Kernel\AggregateId;
use Dieselnet\Infrastructure\Http\Actions\AbstractAction;
use Psr\Http\Message\ResponseInterface;

class GetWishlist extends AbstractAction
{
    /**
     * @param string $reference
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function __invoke(string $reference, ResponseInterface $response): ResponseInterface
    {
        $command = new GetWishlistCommand(AggregateId::fromString($reference));
        /** @var GetWishlistHandler $handler */
        $handler = $this->commandBus()->getHandler($command);
        $handlerResponse = $handler->handle($command);

        return $this->jsonResponse($response, $handlerResponse);
    }
}
