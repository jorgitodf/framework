<?php

namespace App\Framework;


abstract class Controller
{
    /**
     * @return mixed
     */
    abstract public function index($request, $response, $args);

    /**
     * @return mixed
     */
    abstract public function show();

    /**
     * @return mixed
     */
    abstract public function create($request, $response, $args);

    /**
     * @return mixed
     */
    abstract public function update();

    /**
     * @return mixed
     */
    abstract public function delete();

}