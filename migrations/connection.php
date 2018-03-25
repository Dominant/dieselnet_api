<?php

$autoloadFile = realpath(__DIR__ . '/../vendor/autoload.php');
require_once $autoloadFile;

$configFile = realpath(__DIR__ . '/../src/config.yaml');
$data = \Symfony\Component\Yaml\Yaml::parseFile($configFile);
$config = new \Dieselnet\Infrastructure\Config\Config($data);

return [
    'driver' => $config->get('database')['driver'],
    'host' => $config->get('database')['host'],
    'port' => $config->get('database')['port'],
    'dbname' => $config->get('database')['dbname'],
    'user' => $config->get('database')['user'],
    'password' => $config->get('database')['pass'],
    'charset' => 'UTF8'
];
