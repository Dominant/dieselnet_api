<?php

namespace Dieselnet\Infrastructure\Config;

use Exception;

class Config
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $this->resolveEnv($data);  
    }

    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function get(string $key, $default = null)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }

        return $default;
    }

    private function resolveEnv(array $data)
    {
        array_walk_recursive($data, function(&$value, $key) {
            if (preg_match('/^env\((.+)\)/i', $value, $matches)) {
                $envVarKey = $matches[1];
                $envVarVal = getenv($envVarKey);

                if (!$envVarVal) {
                    throw new Exception(sprintf("%s env var is not configured", $envVarKey));
                }

                $value = $envVarVal;
            }
        });

        return $data;
    }
}
