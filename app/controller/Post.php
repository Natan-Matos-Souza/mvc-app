<?php

namespace app\controller;

use app\service\Email;
use app\view\View;
use Slim\Views\Twig;

class Post
{
    public function index()
    {

    }

    public function list($request, $response, $args)
    {
        $postId = $args['id'];

        $response->getBody()->write($postId);

        return $response;
    }

    public function create()
    {

    }

    public function store()
    {

    }
}