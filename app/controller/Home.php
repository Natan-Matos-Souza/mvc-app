<?php

namespace app\controller;

class Home
{
    public function index($request, $response)
    {
        $response->getBody()->write('Olá!');

        return $response;
    }

    public function show($request, $response, $args)
    {
        $postId = $args['id'];

        $response->getBody()->write($postId);

        return $response;

    }
}