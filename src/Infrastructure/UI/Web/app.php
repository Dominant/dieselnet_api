<?php

require_once PROJECT_ROOT . '/src/container.php';

use Dieselnet\DIKeys;
use Dieselnet\Infrastructure\Authorization;
use Dieselnet\Infrastructure\Common\JsonRequestMiddleware;
use Dieselnet\Infrastructure\Common\JsonResponseMiddleware;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use \Dieselnet\Infrastructure\UI\Web\Actions as WebActions;

$app = new Slim\App($container);
$app->add(new Authorization\Token\Middleware($container->get(DIKeys::TOKEN_VERIFIER)));
$app->add(new JsonRequestMiddleware());
$app->add(new JsonResponseMiddleware());

$app->get('/', function(RequestInterface $request, ResponseInterface $response) {
    $response->getBody()->write('home');
    return $response;
})->setName('index');

$app->get('/signup', WebActions\User\Signup::class)->setName('signup');

return $app;
