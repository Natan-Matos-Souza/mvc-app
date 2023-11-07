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
            $_SESSION['canCreateUsers'] = false;
            $_SESSION['canCreatePosts'] = false;
            $_SESSION['canDeletePosts'] = false;
            
            FlashMessage::createSuccessMessage('Logout realizado com sucesso!');
        }


        return $response
        ->withHeader('Location', 'http://localhost:8082/login')
        ->withStatus(301);
    }
}