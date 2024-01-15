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

        $this->getView()->render($response, self::$viewName, [
            "hasFlashMessage"   => FlashMessage::hasFlashMessage(),
            "flashMessageType"  => FlashMessage::showFlashMessageType(),
            "flashMessageText"  => FlashMessage::showFlashMessage()
        ]);

        FlashMessage::destroy();

        return $response;
    }

    public function auth($request, $response, $args)
    {

        $userData = (object) $request->getParsedBody();
        
        FlashMessage::createErrorMessage('Dados inválidos!');

        if (Admin::authenticate($userData))
        {
            FlashMessage::createSuccessMessage('Usuário válido!');
            return $response
            ->withHeader('Location', 'http://localhost:8082/dashboard')
            ->withStatus(302);
        }
        
        FlashMessage::createErrorMessage('Usuário inválido!');

        return $response
        ->withHeader('Location', 'http://localhost:8082/login')
        ->withStatus(302);

    }
}