<?php

namespace App\Framework;


abstract class Controller
{
    /**
     * @return mixed
     */
    abstract public function index();

    /**
     * @return mixed
     */
    abstract public function show();

    /**
     * @return mixed
     */
    abstract public function create();

    /**
     * @return mixed
     */
    abstract public function update();

    /**
     * @return mixed
     */
    abstract public function delete();

}