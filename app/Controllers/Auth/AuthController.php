<?php

namespace App\Controllers\Auth;

use Slim\Views\Twig;
use Slim\Http\Request;
use Slim\Http\Response;
use Firebase\JWT\JWT;

class AuthController
{
    private $view;

    /**
     * AuthController constructor.
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
        return $this->view->render($response, 'auth/login.twig');
    }

    public function logar(Request $request, Response $response, array $args)
    {
        $data = [
            'email' => filter_input(INPUT_POST, 'email'),
            'password' => filter_input(INPUT_POST, 'password')
        ];
        var_dump($data);exit;
        $email = 'jspaiva.1977@gmail.com';
        
        if ($data['email'] == $email) {
            $success = 'Dados válidos';
            return $response->withJson($success, 201);
        } else {
            $error = 'Dados inválidos';
            return $response->withJson($error, 500);
        }
    }

    public function getToken(Request $request, Response $response, array $args)
    {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        
        $hash = password_hash($password, \PASSWORD_DEFAULT);
        $emailUser = 'jspaiva.1977@gmail.com';

        if ($email == $emailUser) {
            $key = 'SECRET_KEY';
            $data = [
                'iat' => time(),
                'exp' => time() + (60 * 60 * 24 * 360),
                'user' => $emailUser
            ];
            $token = JWT::encode($data, $key);
            return $response->withJson(['token' => $token], 201);
        } else {
            $error = 'E-mail não cadastrado!';
            return $response->withJson(['error' => $error], 500);
        }

    }

    public function newRegister(Request $request, Response $response, array $args)
    {
        return $this->view->render($response, 'auth/register.twig');
    }

    public function create(Request $request, Response $response, array $args)
    {
        $email = filter_input(INPUT_POST, 'email');
        //var_dump($request->getParam('email'));exit;
        var_dump($email);exit;
        /*
        $data = [
            'email' => filter_input(INPUT_POST, 'email'),
            'password' => filter_input(INPUT_POST, 'password')
        ];
        var_dump($data);exit;
        $email = 'jspaiva.1977@gmail.com';

        if ($data['email'] == $email) {
            $success = 'Dados válidos';
            return $response->withJson($success, 201);
        } else {
            $error = 'Dados inválidos';
            return $response->withJson($error, 500);
        }
        */
    }

}