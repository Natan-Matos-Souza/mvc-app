<?php

namespace app\controller;

use app\view\View;

class Dashboard extends View
{
    public function index($request, $response)
    {
        if (!$_SESSION['admin'])
        {
            return $response
            ->withHeader('Location', 'http://localhost:8082/login')
            ->withStatus(301);
        }

        $this->setView('dashboard.html');


        $this->getView()->render($response, self::$viewName, [
            "userName" => $_SESSION['adminUsername']
        ]);


        return $response;

    }
}