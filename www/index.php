<?php

define('PROJECT_ROOT', realpath(__DIR__ . '/../'));

require_once '../vendor/autoload.php';
require_once '../src/Infrastructure/UI/Web/app.php';

$app->run();
