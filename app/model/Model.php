<?php

namespace Model;

abstract class Model
{

    public function database()
    {
        $database = new \mysqli($_ENV['DATABASEHOST'], $_ENV['DATABASEUSER'], $_USER['DATABASEPASS'], $_ENV['DATABASE']);

        return $database;
    }
}