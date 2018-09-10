<?php

namespace App\Controllers;

use App\Framework\Controller;
use Slim\Views\Twig;
use Slim\Http\Request;
use Slim\Http\Response;


class HomeController extends Controller
{
    private $view;

    /**
     * HomeController constructor.
     * @param $view
     */
    public function __construct(Twig $view)
    {
        $this->view = $view;
    }


    /**
     * @return mixed
     */
    public function index(Request $request, Response $response, array $args)
    {
        return $this->view->render($response, 'home/index.twig');
    }

    /**
     * @return mixed
     */
    public function show(Request $request, Response $response)
    {
        // TODO: Implement show() method.
    }

    /**
     * @return mixed
     */
    public function create(Request $request, Response $response)
    {
        // TODO: Implement create() method.
    }

    /**
     * @return mixed
     */
    public function update(Request $request, Response $response)
    {
        // TODO: Implement update() method.
    }

    /**
     * @return mixed
     */
    public function delete(Request $request, Response $response)
    {
        // TODO: Implement delete() method.
    }
}