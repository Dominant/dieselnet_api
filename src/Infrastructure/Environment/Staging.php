<?php

namespace Dieselnet\Infrastructure\Environment;

final class Staging extends AbstractEnvironment
{
    /**
     * @return string
     */
    public function name(): string
    {
        return self::STAGING;
    }

    /**
     * @return bool
     */
    public function isProduction(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isDevelopment(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isStaging(): bool
    {
        return true;
    }
}
