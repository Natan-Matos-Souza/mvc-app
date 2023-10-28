<?php

namespace services;

use PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as PHPMailerException;


class Email
{
    public static function sendWelcome(object $user)
    {

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->Host = $_ENV['EMAILHOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['EMAIL'];
            $mail->Password = $_ENV['EMAILPASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;


        } catch(PHPMailerException $e)
        {
            print $e;
        }

    }

    public static function notifyUsers($postData)
    {

    }
}