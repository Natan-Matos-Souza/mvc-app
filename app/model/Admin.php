<?php

namespace app\model;

use app\services\FlashMessage;

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
        $data->password = password_hash($data->password, PASSWORD_BCRYPT);

        $findEmail = self::database()
        ->query("SELECT email FROM admins WHERE email='$data->useremail'");

        if (!$findEmail->num_rows > 0)
        {
            self::database()
            ->query(
                "INSERT INTO admins (
                    email,
                    username,
                    password,
                    can_create_posts,
                    can_delete_posts,
                    can_create_users,
                    can_delete_users
                ) VALUES (
                    '$data->useremail',
                    '$data->username',
                    '$data->password',
                    '$data->canCreatePosts',
                    '$data->canDeletePosts',
                    '$data->canCreateUsers',
                    '$data->canDeleteUsers'
                )"
            );

            FlashMessage::createSuccessMessage('Usuário criado com sucesso!');
        } else {
            FlashMessage::createErrorMessage('E-mail já cadastrado!');
        }
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