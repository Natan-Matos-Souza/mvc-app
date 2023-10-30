<?php

namespace app\view;

use Exception;
use Slim\Views\Twig;

abstract class View
{
    static $pathToTemplates = __DIR__;
    static $viewName;

    public function setView($view)
    {
        self::$viewName = $view;
    }

    public function getView()
    {
        return Twig::create(self::$pathToTemplates, ["cache" => false]);
    }
}
