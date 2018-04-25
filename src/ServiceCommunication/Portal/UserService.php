<?php

namespace Dieselnet\ServiceCommunication\Portal;

use Dieselnet\Domain\User\PortalDetails;
use Dieselnet\Domain\User\User;
use Dieselnet\Infrastructure\Config\Config;
use Guzzle\Http\Client as HttpClient;

class UserService
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @param Config $config
     * @param HttpClient $client
     */
    public function __construct(Config $config, HttpClient $client)
    {
        $this->config = $config;
        $this->client = $client;
    }

    /**
     * @param User $user
     *
     * @return UserDetails|null
     */
    public function getPortalDetails(User $user): ?UserDetails
    {
        if (!$user->hasPortalAccount()) {
            return null;
        }

        $requestUrl = $this->config->get('portal')['infoUrl'];
        $response = $this->client->post($requestUrl, [], [
            'id' => $user->getPortalDetails()->getId(),
            'secret' => $this->getSecret()
        ])->send()->getBody(true);

        $response = json_decode($response, JSON_OBJECT_AS_ARRAY);

        return new UserDetails(
            $response['company_name'],
            $response['firstname'],
            $response['lastname'],
            $response['email'],
            $response['address']
        );
    }

    /**
     * @param User $user
     * @param UserDetails $portalDetails
     */
    public function synchronizeWithPortal(User $user, UserDetails $portalDetails)
    {
        $requestUrl = $user->hasPortalAccount() ?
            $this->config->get('portal')['updateUrl']
            : $this->config->get('portal')['registerUrl'];

        $response = $this->client->post(
            $requestUrl,
            [],
            $this->getPortalRequestPayload($user, $portalDetails)
        )->send()->getBody(true);

        $response = json_decode($response, JSON_OBJECT_AS_ARRAY);

        if (!$user->hasPortalAccount()) {
            $user->changePortalDetails(new PortalDetails(
                $response['account_id'],
                $user->getPortalDetails()->getType()
            ));
        }
    }

    /**
     * @param User $user
     * @param UserDetails $portalDetails
     *
     * @return array
     */
    private function getPortalRequestPayload(User $user, UserDetails $portalDetails)
    {
        return [
            'telephone' => $user->details()->phone(),
            'secret' => $this->getSecret(),
            'account_id' => $user->getPortalDetails()->getId()
        ] + $portalDetails->toPortalRequestPayload();
    }

    private function getSecret()
    {
        return $this->config->get('portal')['secret'];
    }
}
