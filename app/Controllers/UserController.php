<?php

namespace App\Controllers;

use App\Framework\Controller;


class UserController extends Controller
{
    protected $container;

    /**
     * UserController constructor.
     * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @return mixed
     */
    public function index($request, $response, $args)
    {
        //$this->view->render($response, 'index.twig');
        //$resp = $this->container->get('response');
        //return 'Olá do Index User Controller';

        return $this->renderer->render($response, '../templates/index.phtml', $args);
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
    public function create($request, $response, $args)
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