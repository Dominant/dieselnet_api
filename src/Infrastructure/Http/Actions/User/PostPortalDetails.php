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

class PostPortalDetails extends AbstractAction
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

        $requestParams = $request->getParsedBody();
        $userPortalDetails = new UserDetails(
            $requestParams['company_name'],
            $requestParams['firstname'],
            $requestParams['lastname'],
            $requestParams['email'],
            $requestParams['address']
        );

        $user->getPortalDetails()->setType($requestParams['type']);
        $portalService->synchronizeWithPortal($user, $userPortalDetails);
        $userRepository->save($user);

        return $this->jsonResponse($response, new Success(200, [
            'portalAccountId' => $user->getPortalDetails()->getId()
        ]));
    }
}
