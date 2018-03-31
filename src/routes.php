<?php

use Dieselnet\Infrastructure\Http\Actions as WebActions;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$app->get('/', WebActions\Home\Home::class)->setName('home');
$app->post('/signup', WebActions\User\Signup::class)->setName('signup');
$app->post('/verify', WebActions\User\VerifyCode::class)->setName('verify-code');
$app->options('/[{path:.*}]', function(ServerRequestInterface $request, ResponseInterface $response) {
    $response = $response->withHeader('Access-Control-Allow-Headers', 'X-Dieselnet-token, Content-Type');
    return $response->withStatus(200);
})->setName('options-check');
