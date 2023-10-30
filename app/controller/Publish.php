<?php

namespace app\controller;

use app\services\Email;
use app\view\View;
use Slim\Views\Twig;


class Publish extends View
{
    public function index($request, $response)
    {
        $response->getBody()->write('Publicar!');

        return $response;
    }
}