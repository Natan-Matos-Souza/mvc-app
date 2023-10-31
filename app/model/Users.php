<?php

namespace model;

class User extends Model
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
        return $this->database()->query('SELECT EMAIL from users')->fetch_all(MYSQLI_ASSOC);
    }
}