<?php

namespace app\model;

class Admin extends Model
{

    public static function isDataValid(object $data)
    {
        $isValid = true;

        $mandatoryFields = [
            'username',
            'useremail',
            'password'
        ];

        foreach ($mandatoryFields as $fields)
        {
            if (!$data->$fields)
            {
                $isValid = false;
            }
        }

        return $isValid;

    }

    public static function createAdmin(object $data)
    {
        self::database()
        ->query(
            "INSERT INTO admins (
                email,
                username,
                password,
                can_create_posts,
                can_delete_posts,
                can_create_posts
                can_delete_users
            ) VALUES (
                '$data->email',
                '$data->username',
                '$data->password',
                '$data->canCreatePosts',
                '$data->canDeletePosts',
                '$data->canCreateUsers',
                '$data->canDeleteUsers'
            )"
        );
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

    public static function deleteAdmin($id)
    {
        self::database()
        ->query("DELETE FROM admins WHERE id=$id");
    }
}