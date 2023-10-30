<?php

namespace app\controller;

use app\view\View;
use Slim\Views\Twig;

class Home extends View
{
    public function index($request, $response)
    {
        
        $this->setView('index.html');
        

        $this->getView()->render($response, self::$viewName, [
            "firstName" => "Natan",
            "lastName" => "Matos"
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