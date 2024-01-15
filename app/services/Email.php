<?php

namespace app\services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

use app\model\Users;


class Email
{
    public static function sendWelcome(object $userInfo)
    {

        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->Encode = 'base64';

        try {

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->Port = 465;

            $mail->setFrom($_ENV['EMAIL']);
            $mail->addAddress($userInfo->useremail);


            $mail->isHTML(true);
            $mail->Subject = 'Apenas um teste';
            $mail->Body = "<h1>Olá, $userInfo->username</h1><br><br><h2>Você foi cadastrado com sucesso!</h2>";
            $mail->AltBody = 'Olá, estou apenas realizando um teste!';

            $mail->send();


        } catch(PHPMailerException $e)
        {
            print $e;
        }

    }

    public static function notifyUsers($postData)
    {

        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->Encode = 'base64';

        try {

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL'];
            $mail->Password = $_ENV['EMAILPASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->Port = 465;

            $mail->setFrom($_ENV['EMAIL']);


            $usersToSend = Users::getUsersEmail();

            foreach ($usersToSend as $user)
            {
                $user = (object) $user;
                $mail->addAddress($user->email);
            }


            $mail->isHTML(true);
            $mail->Subject = 'Nova Publicação Realizada';
            $mail->Body = "Olá! Temos novidades na plataforma. Venha conferir! Link: http://localhost:8082/posts/$postData->id";
            $mail->AltBody = 'Olá, estou apenas realizando um teste!';

            $mail->send();

        } catch(PHPMailerException $e)
        {
            print $e;
        }
    }
}