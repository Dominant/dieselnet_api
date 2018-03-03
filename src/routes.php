<?php

use Dieselnet\Infrastructure\Http\Actions as WebActions;

$app->get('/', WebActions\Home\Home::class)->setName('home');
$app->post('/signup', WebActions\User\Signup::class)->setName('signup');
