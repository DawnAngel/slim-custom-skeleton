<?php

namespace App\Controllers;

class RootController extends BaseController
{
    public function indexAction()
    {
        $scope = array(
            'oneIsActive' => true,
        );

        $this->app->render('index.twig', $scope);
    }

}
