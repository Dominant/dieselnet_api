<?php

namespace Dieselnet\Infrastructure\Environment;

final class Detector
{
    const ENVIRONMENT = 'ENVIRONMENT';

    public static function fromEnvironmentVars(): EnvironmentInterface
    {
        $envVar = getenv(self::ENVIRONMENT);

        switch ($envVar) {
            case EnvironmentInterface::PRODUCTION:
                $env = new Production([]);
                break;
            case EnvironmentInterface::STAGING:
                $env = new Staging([]);
                break;
            default:
                $env = new Development([]);

        }

        return $env;
    }
}
