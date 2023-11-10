<?php

namespace app\controller;

use app\view\View;

class Favorites extends View
{
    public function index($request, $response)
    {
        $this->setView('favorites.html');

        $this->getView()->render($response, self::$viewName);

        return $response;
    }
}