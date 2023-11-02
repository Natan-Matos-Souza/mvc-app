<?php

namespace app\controller;

use app\services\FlashMessage;

class Logout
{
    public function logout($request, $response)
    {
        if ($_SESSION['admin'])
        {
            $_SESSION['admin'] = false;
            $_SESSION['canCreateUser'] = false;
            $_SESSION['canCreatePost'] = false;
            $_SESSION['canDeletePost'] = false;
            
            FlashMessage::createSuccessMessage('Logout realizado com sucesso!');
        }


        return $response
        ->withHeader('Location', 'http://localhost:8082/login')
        ->withStatus(301);
    }
}