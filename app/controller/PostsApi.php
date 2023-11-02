<?php

namespace app\controller;

class PostsApi {

    public function list($request, $response, $args)
    {

        $response->getBody()->write(
            json_encode($args, JSON_UNESCAPED_UNICODE)
        );

        return $response
        ->withHeader('Content-Type', 'application/json');
    }

    public function index($request, $response, $args)
    {

        return $response
        ->withHeader('Content-Type', 'application/json');
    }

}