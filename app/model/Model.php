<?php

namespace app\model;

abstract class Model
{

    public static function database()
    {
        $database = new \mysqli($_ENV['DATABASEHOST'], $_ENV['DATABASEUSER'], $_ENV['DATABASEPASS'], $_ENV['DATABASE']);

        return $database;
    }
}