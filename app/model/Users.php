<?php

namespace app\model;

class Users extends Model
{
    public static function isValid(array $userData)
    {
        return $isValid;
    }

    public static function userCreate(array $userData)
    {
        
    }

    public static function getUsersEmail()
    {
        $data = self::database()->query('SELECT email from users')->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
}