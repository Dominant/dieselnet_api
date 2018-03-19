<?php

use Dieselnet\Infrastructure\Http\Actions as WebActions;

$app->get('/', WebActions\Home\Home::class)->setName('home');
$app->post('/signup', WebActions\User\Signup::class)->setName('signup');
$app->post('/verify', WebActions\User\VerifyCode::class)->setName('verify-code');
