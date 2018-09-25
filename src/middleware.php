<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\

$app->add(new \Tuupola\Middleware\JwtAuthentication([
    "regexp" => "/(.*)/",
    "header" => "Authorization",
    "path" => "/",
    "ignore" => "/auth", 
    "realm" => "Protected",
    "secret" => "SECRET_KEY"
]));

$app->add(function ($request, $response, $next) {
    $token = filter_input(INPUT_GET, 'token');
    if ($token) {
        $request = $request->withHeader("Authorization", $token);
    }
    return $next($request, $response);
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, PUT, DELETE, POST, OPTIONS');
});

