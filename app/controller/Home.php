<?php

namespace app\controller;

use app\view\View;
use Slim\Views\Twig;
use app\services\FlashMessage;

class Home extends View
{
    public function index($request, $response)
    {
        
        $this->setView('index.html');
        
        flashMessage::createSuccessMessage('Post criado com sucesso!');

        $this->getView()->render($response, self::$viewName, [
            "firstName" => "Natan",
            "lastName" => "Matos",
            "flashMessageType" => flashMessage::showFlashMessageType(),
            "hasFlashMessage" => flashMessage::hasFlashMessage(),
            "flashMessageText" => flashMessage::showFlashMessage()
        ]);

        return $response;
    }

    public function show($request, $response, $args)
    {
        $postId = $args['id'];

        $response->getBody()->write($postId);

        return $response;

    }
}