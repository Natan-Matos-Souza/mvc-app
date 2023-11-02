<?php

namespace app\controller;

use app\view\View;
use app\services\FlashMessage;


class User extends View
{

    public function create($request, $response)
    {

        FlashMessage::createSuccessMessage('Cadastrado com sucesso!');

        $this->setView('cadastro.html');

        $this->getView()->render($response, self::$viewName, [
            "hasFlashMessage" => FlashMessage::hasFlashMessage(),
            "flashMessageType" => FlashMessage::showFlashMessageType(),
            "flashMessageText" => FlashMessage::showFlashMessage()
        ]);

        return $response;
    }

    public function store()
    {

    }


}