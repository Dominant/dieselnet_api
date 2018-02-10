<?php

require_once PROJECT_ROOT . '/src/container.php';

use Dieselnet\DIKeys;
use Dieselnet\Infrastructure\Authorization;
use Dieselnet\Infrastructure\Http\Middlewares\JsonRequestMiddleware;
use Dieselnet\Infrastructure\Http\Middlewares\JsonResponseMiddleware;
use Dieselnet\Infrastructure\Http\Middlewares\TokenVerifierMiddleware;
use \Dieselnet\Infrastructure\Http\Actions as WebActions;

$app = new Slim\App($container);
$app->add(new TokenVerifierMiddleware($container->get(DIKeys::TOKEN_VERIFIER)));
$app->add(new JsonRequestMiddleware());
$app->add(new JsonResponseMiddleware());

$app->get('/', WebActions\Home\Home::class)->setName('home');
$app->get('/signup', WebActions\User\Signup::class)->setName('signup');

return $app;
