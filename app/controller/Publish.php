<?php

namespace app\controller;

use services\Email;

class Publish
{
    public function index($request, $response)
    {
        $response->getBody()->write('Publicar!');

        return $response;
    }
}