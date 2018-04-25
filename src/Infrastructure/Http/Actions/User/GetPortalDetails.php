<?php

namespace Dieselnet\Infrastructure\Http\Actions\User;

use Dieselnet\Application\Response\Error;
use Dieselnet\Application\Response\Success;
use Dieselnet\Domain\Kernel\AggregateId;
use Dieselnet\Domain\User\RepositoryInterface;
use Dieselnet\Infrastructure\Http\Actions\AbstractAction;
use Dieselnet\ServiceCommunication\Portal\UserDetails;
use Dieselnet\ServiceCommunication\Portal\UserService;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class GetPortalDetails extends AbstractAction
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
        /** @var UserService $portalService */
        $portalService = $this->getContainer()->get(UserService::class);
        $userRepository = $this->getContainer()->get(RepositoryInterface::class);

        $user = $userRepository->find(AggregateId::fromString($reference));

        if ($user === null) {
            return $this->jsonResponse($response, new Error(404, [
                'error' => 'user-not-found'
            ]));
        }

        $userPortalDetails = $portalService->getPortalDetails($user);

        if ($userPortalDetails === null) {
            return $this->jsonResponse($response, new Error(
                404,
                ['telephone' => $user->details()->phone()]
            ));
        }

        return $this->jsonResponse($response, new Success(
            200,
            $userPortalDetails->toPortalRequestPayload() + [
                'telephone' => $user->details()->phone(),
                'type' => $user->getPortalDetails()->getType()
            ]
        ));
    }
}
