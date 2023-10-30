<?php

namespace app\services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as PHPMailerException;


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
            $mail->Password = $_ENV['EMAILPASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->SMTPAuth = true;
            $mail->Port = 465;

            $mail->setFrom($_ENV['EMAIL']);
            $mail->addAddress($userInfo->email);


            $mail->isHTML(true);
            $mail->Subject = 'Apenas um teste';
            $mail->Body = "Olá, $userInfo->firstName! Estou apenas realizando um teste!";
            $mail->AltBody = 'Olá, estou apenas realizando um teste!';

            $mail->send();


        } catch(PHPMailerException $e)
        {
            print $e;
        }

    }

    public static function notifyUsers($postData)
    {

    }
}