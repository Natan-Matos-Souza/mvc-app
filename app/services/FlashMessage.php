<?php

namespace app\services;

class FlashMessage
{
    public static function createErrorMessage($message)
    {
        $_SESSION['hasFlashMessage'] = true;
        $_SESSION['flashMessageType'] = 'danger';
        $_SESSION['flashMessageText'] = $message;
    }

    public static function createSuccessMessage($message)
    {
        $_SESSION['hasFlashMessage'] = true;
        $_SESSION['flashMessageType'] = 'success';
        $_SESSION['flashMessageText'] = $message;
    }

    public static function hasFlashMessage()
    {
        return $_SESSION['hasFlashMessage'];
    }

    public static function showFlashMessage()
    {
       return $_SESSION['flashMessageText'];
    }

    public static function showFlashMessageType()
    {
        return $_SESSION['flashMessageType'];
    }
}