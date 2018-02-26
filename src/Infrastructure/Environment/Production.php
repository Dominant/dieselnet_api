<?php

namespace Dieselnet\Infrastructure\Environment;

final class Production extends AbstractEnvironment
{
    /**
     * @return string
     */
    public function name(): string
    {
        return self::PRODUCTION;
    }

    /**
     * @return bool
     */
    public function isProduction(): bool
    {
        return true;
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
        return false;
    }
}
