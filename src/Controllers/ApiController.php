<?php

namespace App\Controllers;

class ApiController extends BaseController
{
    /**
     * http://docs.slimframework.com/request/method/
     * Api Base Sample
     *
     * @return void
     */
    public function indexAction()
    {
        $scope = array(
            'get'  => $this->app->request->get(),
            'post' => $this->app->request->post(),
        );

        $this->responseJSON($scope);
    }

}
