<?php

namespace app\model;

use app\services\FlashMessage;

class Admin extends Database
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

    public static function createAdmin(object $data): bool
    {
        $data->password = password_hash($data->password, PASSWORD_BCRYPT);

        $query = "SELECT email FROM admins WHERE email=?";

        $stmt = self::database()->prepare($query);
        $stmt->execute([
            $data->useremail
        ]);

        if ($stmt->rowCount() < 1)
        {

            $query = "INSERT INTO admins (
                email,
                username,
                password,
                can_create_posts,
                can_delete_posts,
                can_create_users,
                can_delete_users
            ) VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = self::database()->prepare($query);

            $stmt->execute([
                $data->useremail,
                $data->username,
                $data->password,
                $data->canCreatePosts,
                $data->canDeletePosts,
                $data->canCreateUsers,
                $data->canDeleteUsers
            ]);

            FlashMessage::createSuccessMessage('Usuário criado com sucesso!');

            return true;
        }

        FlashMessage::createErrorMessage('E-mail já cadastrado!');
        return false;
    }

    public static function authenticate(object $data): bool
    {
        $isValid = false;

        $findUserByEmailQuery = "SELECT id, password from admins WHERE email=?";
        $findUserByEmailStmt = self::database()->prepare($findUserByEmailQuery);
        $findUserByEmailStmt->execute([
            $data->email
        ]);

        if ($findUserByEmailStmt->rowCount() < 1) return $isValid;

        $userPassword = $findUserByEmailStmt->fetch();


        if (password_verify($data->password, $userPassword->password))
        {
            
            $query = "SELECT * from admins WHERE id=?";
            $getUserInfoStmt = self::database()->prepare($query);
            $getUserInfoStmt->execute([
                $userPassword->id
            ]);

            $userInfo = $getUserInfoStmt->fetch();

            $_SESSION['admin'] = true;
            $_SESSION['adminUsername']  = $userInfo->username;
            $_SESSION['canCreatePosts'] = $userInfo->can_create_posts;
            $_SESSION['canCreateUsers'] = $userInfo->can_create_users;
            $_SESSION['canDeletePosts'] = $userInfo->can_delete_posts;
            $_SESSION['canDeleteUsers'] = $userInfo->can_delete_users;

            $isValid = true;

            return $isValid;
            


        }
        
        return $isValid = false;

    }

    public static function deleteAdmin(int $id)
    {
       $query = "DELETE FROM users WHERE id=?";

       $stmt = self::database()->prepare($query);
       $stmt->execute([
        $id
       ]);

    }

    public static function getAllAdmins()
    {
        $stmt = self::database()->prepare("SELECT id, email, username FROM admins");
        $stmt->execute();

        return $stmt->fetchAll();

    }
}