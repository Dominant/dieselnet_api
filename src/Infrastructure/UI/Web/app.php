<?php

require_once PROJECT_ROOT . '/src/container.php';

use Dieselnet\DIKeys;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use \Dieselnet\Infrastructure\UI\Web\Actions as WebActions;

$app = new Slim\App($container);
$app->add($container->get(DIKeys::TOKEN_VERIFIER_MIDDLEWARE));
$app->add($container->get(DIKeys::JSON_RESPONSE_MIDDLEWARE));

$app->get('/', function(RequestInterface $request, ResponseInterface $response) {
    $response->getBody()->write('home');
    return $response;
})->setName('index');

$app->get('/signup', WebActions\User\Signup::class)->setName('signup');

return $app;
