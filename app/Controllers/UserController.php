<?php

namespace App\Controllers;

use App\Framework\Controller;
use Slim\Views\Twig;
use Slim\Http\Request;
use Slim\Http\Response;


class UserController extends Controller
{
    private $view;

    /**
     * UserController constructor.
     * @param $view
     */
    public function __construct(Twig $view)
    {
        $this->view = $view;
    }

    public function index()
    {
        return $this->view->render('layout.twig');
    }

    /**
     * @return mixed
     */
    public function home(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'home.twig');
    }

    /**
     * @return mixed
     */
    public function show()
    {
        // TODO: Implement show() method.
    }

    /**
     * @return mixed
     */
    public function create()
    {
        // TODO: Implement create() method.
    }

    /**
     * @return mixed
     */
    public function update()
    {
        // TODO: Implement update() method.
    }

    /**
     * @return mixed
     */
    public function delete()
    {
        // TODO: Implement delete() method.
    }
}