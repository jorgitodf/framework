<?php
// DIC configuration

use App\Framework\Exceptions\NotFoundHandler;

$container = $app->getContainer();

// view renderer
$container['view'] = function($c) {
    $settings = $c->get('settings');
    $view = new Slim\Views\Twig($settings['view']['template_path']);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $basePath));
    return $view;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// BD Eloquent
$container['db'] = function($c) {
    $manager = new \Illuminate\Database\Capsule\Manager;
    $manager->addConnection($c->get('settings')['db']);
    $manager->setAsGlobal();
    $manager->bootEloquent();
    return $manager->getConnection('default');
};
$container['db'];

// Erros
$container['notFoundHandler'] = function ($c) { 
    return new NotFoundHandler($c->get('view'), function ($request, $response) use ($c) { 
        return $c['response']->withStatus(404); 
    }); 
};

// Controllers
$container['HomeController'] = function($c) {
    return new \App\Controllers\HomeController($c->get('view'));
};
$container['AuthController'] = function($c) {
    return new \App\Controllers\Auth\AuthController($c->get('view'));
};


