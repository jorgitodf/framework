<?php

namespace App\Framework;

use Slim\Http\Request;
use Slim\Http\Response;

abstract class Controller
{
    /**
     * @return mixed
     */
    abstract public function index(Request $request, Response $response, array $args);

    /**
     * @return mixed
     */
    abstract public function show(Request $request, Response $response);

    /**
     * @return mixed
     */
    abstract public function create(Request $request, Response $response);

    /**
     * @return mixed
     */
    abstract public function update(Request $request, Response $response);

    /**
     * @return mixed
     */
    abstract public function delete(Request $request, Response $response);

}