<?php

use Dieselnet\Infrastructure\Http\Actions as WebActions;

$app->get('/', WebActions\Home\Home::class)->setName('home');
$app->post('/signup', WebActions\User\Signup::class)->setName('signup');
$app->post('/verify', WebActions\User\VerifyCode::class)->setName('verify-code');
$app->options('/', function(ServerRequestInterface $request, ResponseInterface $response) {
    return $response->withStatus(200);
})->setName('options-check');
