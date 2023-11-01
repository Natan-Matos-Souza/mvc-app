<?php

namespace app\controller;

use app\service\Email;
use app\view\View;
use Slim\Views\Twig;

class Post extends View
{
    public function index($request, $response)
    {
        $this->setView('index.html');

        $this->getView()->render($response, self::$viewName);

        return $response;
    }

    public function list($request, $response, $args)
    {
        $postId = $args['id'];

        $this->setView('post.html');

        $this->getView()->render($response, self::$viewName);

        return $response;
    }

    public function create()
    {
        
    }

    public function store()
    {

    }
}