<?php

namespace app\model;

class Admin extends Model
{
    public static function createAdmin()
    {
        
    }

    public static function getAdminPermissions()
    {

    }

    public static function isValid(object $data)
    {
        $isValid = false;
        

        $findUser = self::database()->query("SELECT password from admins WHERE email=$data->email");

        if ($findUser->num_rows < 1)
        {
            return $isValid = false;
        }

        $userPassword = $findUser->fetch_all(MYSQLI_ASSOC);

        if (password_verify($data->password, $userPassword))
        {
            
            $userInfo = (object) self::database()->query("SELECT * from admins WHERE email=$email")->fetch_all(MYSQLI_ASSOC);



            $_SESSION['admin'] = true;
            $_SESSION['adminUsername'] = $userInfo->username;
            


        } else {
            return $isValid = false;
        }

    }


}