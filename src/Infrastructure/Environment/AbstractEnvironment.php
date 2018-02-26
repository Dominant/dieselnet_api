<?php

namespace Dieselnet\Infrastructure\Environment;

abstract class AbstractEnvironment implements EnvironmentInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws ConfigKeyException
     */
    public function config(string $key)
    {
        if (!isset($this->config[$key])) {
            throw new ConfigKeyException(sprintf('%s config key is not defined.', $key));
        }

        return $this->config($key);
    }
}
