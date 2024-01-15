<?php

namespace app\controller;

use app\view\View;
use app\services\FlashMessage;
use app\model\Admin as AdminModel;

class Admin extends View
{

    public function destroy($request, $response)
    {

        if (!$_SESSION['canDeleteUsers'])
        {
            return $response
            ->withHeader('Location', 'http://localhost:8082/dashboard')
            ->withStatus(301);
        }

        $userId = explode('=', $request->getBody()->getContents())[1];

        if (AdminModel::deleteAdmin((int) $userId))
        {
            return $response
            ->withStaus(204);
        } else {
            return $response
            ->withStatus(500);
        }

        
    }

    public function delete($request, $response)
    {
        if (!$_SESSION['canDeleteUsers'])
        {
            FlashMessage::createErrorMessage('Você não possui permissão!');

            return $response
            ->withHeader('Location', 'http://localhost:8082/dashboard')
            ->withStatus(301);
        }

        $this->setView('deleteusers.html');

        $this->getView()->render($response, self::$viewName, [
            'userName' => $_SESSION['adminUsername'],
            'users' => AdminModel::getAllAdmins()
        ]);


        return $response;
    }

    public function store($request, $response)
    {
        
        if (!$_SESSION['canCreateUsers'])
        {
            FlashMessage::createErrorMessage('Você não possui permissão!');

            return $response
            ->withHeader('Location', 'http://localhost:8082/dashboard')
            ->withStatus(301);
        }

        $mandatoryFields = [
            'username',
            'useremail',
            'password'
        ];

        foreach ($mandatoryFields as $fields)
        {
            $data[$fields] = $request->getParsedBody()[$fields];
        }

        $permissions = [
            "canCreatePosts",
            "canDeletePosts",
            "canCreateUsers",
            "canDeleteUsers"
        ];        

        foreach ($permissions as $permission)
        {
            $sentData = $request->getParsedBody();

            (isSet($sentData[$permission])) ? $data[$permission] = true : $data[$permission] = 0;
        }

        if (AdminModel::isDataValid((object) $data))
        {
           
            AdminModel::createAdmin((object) $data);

        } else {

            FlashMessage::createErrorMessage('Preencha todos os campos obrigatórios!');
        }

        return $response
        ->withHeader('Location', 'http://localhost:8082/dashboard')
        ->withStatus(301);


    }

    public function create($request, $response, $args)
    {
        if (!$_SESSION['canCreateUsers'])
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