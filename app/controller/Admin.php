<?php

namespace app\controller;

use app\view\View;
use app\services\FlashMessage;

class Admin extends View
{
    public function store($request, $response, $args)
    {
        if ($_SESSION['admin'] && $_SESSION['canCreateUser'])
        {

        } else {
            FlashMessage::createErrorMessage('Você não possui permissão!');
            return $response
            ->withHeader('Location', 'http://localhost:8082/dashboard')
            ->withStaus(301);
        }

        return $response;
    }

    public function create($request, $response, $args)
    {

    }

    public function list($request, $response, $args)
    {

    }
}