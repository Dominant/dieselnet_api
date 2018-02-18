<?php

namespace Dieselnet\Application;

class Request
{
    /**
     * @var array
     */
    private $params;

    /**
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * @param string $key
     * @param        $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $this->params[$key] ?? $default;
    }
}
