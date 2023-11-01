<?php

namespace app\model;

class Admin extends Model
{
    public static function createAdmin()
    {
        
    }

    public static function isValid(object $data)
    {
        $isValid = false;
        

        $findUser = self::database()->query("SELECT password from admins WHERE email='$data->email'");

        if ($findUser->num_rows < 1)
        {
            return $isValid = false;
        }

        $userPassword = (object) $findUser->fetch_array(MYSQLI_ASSOC);


        if (password_verify($data->password, $userPassword->password))
        {
            
            $userInfo = (object) self::database()->query("SELECT * from admins WHERE email='$data->email'")->fetch_array(MYSQLI_ASSOC);


            $_SESSION['admin'] = true;
            $_SESSION['adminUsername'] = $userInfo->username;
            $_SESSION['canCreatePosts'] = $userInfo->can_create_posts;
            $_SESSION['canCreateUsers'] = $userInfo->can_create_users;
            $_SESSION['canDeletePosts'] = $userInfo->can_delete_posts;

            $isValid = true;

            var_dump($_SESSION['canCreateUsers']);

            return $isValid;
            


        } else {
            return $isValid = false;
        }

    }


}