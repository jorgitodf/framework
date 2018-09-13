<?php

namespace App\Controllers\Auth;

use Slim\Views\Twig;
use Slim\Http\Request;
use Slim\Http\Response;

class LoginController
{
    private $view;

    /**
     * LoginController constructor.
     * @param $view
     */
    public function __construct(Twig $view)
    {
        $this->view = $view;
    }


    /**
     * @return mixed
     */
    public function login(Request $request, Response $response, array $args)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'email' => filter_input(INPUT_POST, 'email'),
                'password' => filter_input(INPUT_POST, 'password')
            ];
            return $response->withJson($data, 201);
        }

        return $this->view->render($response, 'auth/login.twig');
    }

}