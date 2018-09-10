<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['view'] = function($c) {
    $settings = $c->get('settings');
    return new Slim\Views\Twig($settings['view']['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// eloquent
$container['db'] = function($c) {
    $manager = new \Illuminate\Database\Capsule\Manager;
    $manager->addConnection($c->get('settings')['db']);
    $manager->setAsGlobal();
    $manager->bootEloquent();
    return $manager->getConnection('default');
};
$container['db'];

// Controllers
$container['HomeController'] = function($c) {
    return new \App\Controllers\HomeController($c->get('view'));
};


