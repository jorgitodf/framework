<?php

namespace App\Controllers\Auth;

use Slim\Views\Twig;
use Slim\Http\Request;
use Slim\Http\Response;
use Firebase\JWT\JWT;
use App\Validations\ValidationUser;
use App\Models\User;

class AuthController
{
    private $view;
    private $validations;
    private $model_user;

    /**
     * AuthController constructor.
     * @param $view
     */
    public function __construct(Twig $view)
    {
        $this->view = $view;
        $this->validations = new ValidationUser();
        $this->model_user = new User();
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

        $user = $this->model_user->where('email', $email)->first();

        if (!is_null($user) && password_verify($password, $user->password)) {
            $key = 'SECRET_KEY';
            $data = [
                'iat' => time(),
                'exp' => time() + (60 * 60 * 24 * 360),
                'user' => $user->email
            ];
            $token = JWT::encode($data, $key);
            return $response->withJson(['base_url' => base_url(), 'token' => $token], 201);
        } else {
            return $response->withJson(['error' => 'E-mail não cadastrado!'], 401);
        }

    }

    public function newRegister(Request $request, Response $response, array $args)
    {
        return $this->view->render($response, 'auth/register.twig');
    }

    public function create(Request $request, Response $response, array $args)
    {
        $data = [
            'name' => filter_input(INPUT_POST, 'name'),
            'email' => filter_input(INPUT_POST, 'email'),
            'password' => filter_input(INPUT_POST, 'password'),
            're-password' => filter_input(INPUT_POST, 're_password')
        ];

        $error = $this->validations->validateUser($data);

        unset($data['re-password']);

        if (!$error) {
            $this->model_user->create($data);
            return $response->withJson(['base_url' => base_url(), 'success' => 'Usuário Cadastrado com Sucesso!'],201);
        } else {
            return $response->withJson(['error' => $error], 500);
        }
    }

}