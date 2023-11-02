<?php

namespace app\model;

class Users extends Model
{
    public static function isValid(object $data)
    {
        $isValid = false;

        if (filter_var($data->useremail, FILTER_VALIDATE_EMAIL))
        {
            $isValid = true;
        }

        return $isValid;
    }

    public static function createUser(object $data)
    {
        self::database()->query("INSERT INTO users(name, email) VALUES ('$data->username', '$data->useremail')");
    }

    public static function getUsersEmail()
    {
        $data = self::database()->query('SELECT email from users')->fetch_all(MYSQLI_ASSOC);
        return $data;
    }
}