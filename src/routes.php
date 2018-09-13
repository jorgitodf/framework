<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->options('/{routes:.+}', function ($req, $res, $args) {
    return $res;
});

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/auth/login', 'LoginController:login')->setName('login');
$app->post('/auth/login', 'LoginController:login')->setName('login');


