<?php

namespace app\controller;

use app\services\FlashMessage;

class Logout
{
    public function logout($request, $response)
    {
        if ($_SESSION['admin'])
        {
            session_destroy();
            FlashMessage::createSuccessMessage('Logout realizado com sucesso!');
        }


        return $response
        ->withHeader('Location', 'http://localhost:8082/login')
        ->withStatus(301);
    }
}