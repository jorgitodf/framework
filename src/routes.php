<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes


$app->get('/', 'HomeController:index')->setName('home');

$app->get('/auth/login', 'AuthController:login')->setName('login');
$app->post('/auth/logar', 'AuthController:logar')->setName('logar');
$app->post('/auth/token', 'AuthController:getToken')->setName('token');
$app->get('/auth/new-register', 'AuthController:newRegister')->setName('new-register');
$app->post('/auth/create', 'AuthController:create')->setName('create');


