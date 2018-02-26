<?php

namespace Dieselnet\Infrastructure\Environment;

interface EnvironmentInterface
{
    const DEVELOPMENT = 'development';
    const PRODUCTION = 'production';
    const STAGING = 'staging';

    /**
     * @return string
     */
    public function name(): string;

    /**
     * @return bool
     */
    public function isProduction(): bool;

    /**
     * @return bool
     */
    public function isDevelopment(): bool;

    /**
     * @return bool
     */
    public function isStaging(): bool;

    /**
     * @param string $key
     * @return mixed
     */
    public function config(string $key);
}
