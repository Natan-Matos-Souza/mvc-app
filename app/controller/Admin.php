<?php

namespace app\controller;

use app\view\View;
use app\services\FlashMessage;

class Admin extends View
{
    public function store($request, $response)
    {
        
        $isValid = true;

        $data = [];

        $mandatoryFields = [
            "username",
            "useremail",
            "password"
        ];

        $permissions = [
            "canCreatePosts",
            "canDeletePosts",
            "canCreateUsers",
            "canDeleteUsers"
        ];

        foreach ($mandatoryFields as $field)
        {
            $sentData = $request->getParsedBody();

            if ($sentData[$field])
            {
                $data[$field] = $sentData[$field];
            } else {
                $isValid = false;
            }
        }

        

        foreach ($permissions as $permission)
        {
            $sentData = $request->getParsedBody();

            (isSet($sentData[$permission])) ? $data[$permission] = $sentData[$permission] : $data[$permission] = false;
        }

        if ($isValid)
        {
            var_dump($data);    
        } else {

            FlashMessage::createErrorMessage('Preencha todos os campos obrigatórios!');

            return $response
            ->withHeader('Location', 'http://localhost:8082/dashboard')
            ->withStatus(301);
        }

        return $response;

    }

    public function create($request, $response, $args)
    {
        if (!$_SESSION['admin'] && !$_SESSION['canCreateUsers'])
        {
            FlashMessage::createErrorMessage('Você não possui permissão!');

            return $response
            ->withHeader('Location', 'http://localhost:8082/dashboard')
            ->withStatus(301);
        }
        $this->setView('createusers.html');

        $this->getView()->render($response, self::$viewName, [
            "userName" => $_SESSION['adminUsername']
        ]);

        return $response;
    }

}