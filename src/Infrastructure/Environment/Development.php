<?php

namespace Dieselnet\Infrastructure\Environment;

final class Development extends AbstractEnvironment
{
    /**
     * @return string
     */
    public function name(): string
    {
        return self::DEVELOPMENT;
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
        return true;
    }

    /**
     * @return bool
     */
    public function isStaging(): bool
    {
        return false;
    }
}
