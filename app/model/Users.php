<?php

namespace app\model;

use app\services\FlashMessage;
use app\services\Email;

class Users extends Database
{
    public static function validateEmail(object $data)
    {

        $isValid = false;

        if (filter_var($data->useremail, FILTER_VALIDATE_EMAIL))
        {
            $query = "SELECT * FROM users WHERE email=?"; //Prepara query para procurar e-mail

            $stmt = self::database()->prepare($query);

            $stmt->execute([
                $data->useremail
            ]);

            $stmt->rowCount() < 1 ?  $isValid = true : FlashMessage::createErrorMessage('Email já cadastrado!');

        }

        return $isValid;

    }

    public static function createUser(object $data)
    {
        $query = "INSERT INTO users(name, email) VALUES (?, ?)";

        $stmt = self::database()->prepare($query);

        $stmt->execute([
            $data->username,
            $data->useremail
        ]);
        
        Email::sendWelcome($data);
    }

    public static function getUsersEmail()
    {

        $stmt = self::database()->prepare("SELECT email FROM users");
        $stmt->execute();

        return $stmt->fetchAll();
    }
}