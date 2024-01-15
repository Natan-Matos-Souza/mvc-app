<?php

namespace app\model;

abstract class Database
{

    public static function database()
    {
        $database = new \PDO("mysql:host=$_ENV[DATABASE_HOST];dbname=$_ENV[DATABASE]", $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASS']);
        
        $database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $database->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);

        return $database;
    }
}