<?php

namespace app\controller;

use app\model\Posts;

class PostsApi {

    public function list($request, $response, $args)
    {
        
        $postData = Posts::getPost($args['id'], 15);

        $response
        ->getBody()
        ->write(json_encode($postData, JSON_UNESCAPED_UNICODE));

        return $response
        ->withHeader('Content-Type', 'application/json');
    }

    public function index($request, $response, $args)
    {

        return $response
        ->withHeader('Content-Type', 'application/json');
    }

}