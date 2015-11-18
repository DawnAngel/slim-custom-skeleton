<?php

namespace App\Controllers;

abstract class BaseController
{
    protected $app;

    public function __construct()
    {
        $this->app = \Slim\Slim::getInstance();
    }

    protected function responseJSON($scope = array())
    {
        header("Content-Type: application/json");
        echo json_encode($scope);
    }
}
