<?php

use Dieselnet\Infrastructure\Http\Actions as WebActions;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$app->get('/', WebActions\Home\Home::class)->setName('home');
$app->post('/signup', WebActions\User\Signup::class)->setName('signup');
$app->post('/verify', WebActions\User\VerifyCode::class)->setName('verify-code');

# Wishlist
$app->get('/user/{reference}/wishlist', WebActions\User\GetWishlist::class)->setName('get-user-wishlist');
$app->post('/user/{reference}/wishlist', WebActions\User\AddWishlist::class)->setName('add-machine-to-wishlist');
$app->delete('/user/{reference}/wishlist', WebActions\User\DeleteWishlist::class)->setName('delete-machine-from-wishlist');

# CORS HEADER SUPPORT
$app->options('/[{path:.*}]', function(ServerRequestInterface $request, ResponseInterface $response) {
    $response = $response->withHeader('Access-Control-Allow-Headers', 'X-Dieselnet-token, Content-Type');
    $response = $response->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');

    return $response->withStatus(200);
})->setName('options-check');
