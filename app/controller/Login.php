<?php

namespace app\controller;

use app\model\Admin;
use app\services\FlashMessage;
use app\view\View;

class Login extends View
{
    public function index($request, $response)
    {
        $this->setView('login.html');

        $this->getView()->render($response, self::$viewName);

        return $response;
    }

    public function auth($request, $response)
    {

       $data = $request->getParsedBody();


       var_dump($data);
        
       return $response;

    }
}