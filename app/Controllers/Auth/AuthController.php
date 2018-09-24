<?php

namespace App\Controllers\Auth;

use Slim\Views\Twig;
use Slim\Http\Request;
use Slim\Http\Response;
use Firebase\JWT\JWT;
use App\Validations\ValidationUser;

class AuthController
{
    private $view;
    private $validations;

    /**
     * AuthController constructor.
     * @param $view
     */
    public function __construct(Twig $view)
    {
        $this->view = $view;
        $this->validations = new ValidationUser();
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
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $re_password = filter_input(INPUT_POST, 're_password');

        $data = ['name' => $name, 'email' => $email, 'password' => $password, 're-password' => $re_password];

        $error = $this->validations->validateUser($data);

        if (!$error) {
            return $response->withJson(['base_url' => base_url(), 'success' => 'Usuário Cadastrado com Sucesso!'],201);
        } else {
            return $response->withJson(['error' => $error], 500);
        }
    }

}