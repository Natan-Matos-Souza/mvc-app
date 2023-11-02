<?php

namespace app\controller;

use app\view\View;
use app\services\FlashMessage;
use app\model\Users;


class User extends View
{

    public function create($request, $response)
    {
        
        $this->setView('cadastro.html');

        $this->getView()->render($response, self::$viewName, [
            "hasFlashMessage" => FlashMessage::hasFlashMessage(),
            "flashMessageType" => FlashMessage::showFlashMessageType(),
            "flashMessageText" => FlashMessage::showFlashMessage()
        ]);

        FlashMessage::destroy();

        return $response;
    }

    public function store($request, $response)
    {
        $data = (object) $request->getParsedBody();

        if (Users::isValid($data))
        {
            Users::createUser($data);
            FlashMessage::createSuccessMessage('Usuário criado com sucesso!');
        }

        return $response
        ->withHeader('Location', 'http://localhost:8082/cadastrar')
        ->withStatus(301);
    }


}