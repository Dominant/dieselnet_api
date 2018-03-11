<?php

$autoloadFile = realpath(__DIR__ . '/../vendor/autoload.php');
require_once $autoloadFile;

$configFile = realpath(__DIR__ . '/../src/config.yaml');
$config = \Symfony\Component\Yaml\Yaml::parseFile($configFile);

return [
    'driver' => $config['database']['driver'],
    'host' => $config['database']['host'],
    'port' => $config['database']['port'],
    'dbname' => $config['database']['dbname'],
    'user' => $config['database']['user'],
    'password' => $config['database']['pass'],
    'charset' => 'UTF8',
];
