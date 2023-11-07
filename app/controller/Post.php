<?php

namespace app\controller;

use app\service\Email;
use app\view\View;
use Slim\Views\Twig;
use app\services\FlashMessage;
use app\model\Posts;

class Post extends View
{
    public function index($request, $response)
    {
        $this->setView('index.html');

        $this->getView()->render($response, self::$viewName);

        return $response;
    }

    public function list($request, $response, $args)
    {
        
        $this->setView('post.html');

        // $this->getView()->render($response, self::$viewName, [
        //     "postInfo" => Post::getPost($args['id'])
        // ]);

        var_dump($_SESSION);
        return $response;
    }

    public function create($request, $response)
    {
        if (!$_SESSION['admin'] && !$_SESSION['canCreatePosts'])
        {
            FlashMessage::createErrorMessage('Você não possui permissão');
            return $response->withHeader('Location', 'http://localhost:8082/dashboard')
            ->withStatus(302);
        }

        $this->setView('createpost.html');

        $this->getView()->render($response, self::$viewName, [
            "userName" => $_SESSION['adminUsername'],
            "hasFlashMessage" => FlashMessage::hasFlashMessage(),
            "flashMessageType" => FlashMessage::showFlashMessageType(),
            "flashMessageText" => FlashMessage::showFlashMessage()
        ]);

        return $response;
    }

    public function store($request, $response)
    {
        if (!$_SESSION['admin'] && !$_SESSION['canCreatePosts'])
        {
            FlashMessage::createErrorMessage('Você não possui permissão');
            $response->withHeader('Location', 'http://localhost:8082/dashboard')
            ->withStatus(302);
        }


        $formData = $request->getParsedBody();

        $data = (object) [
            "postTitle" => $formData['post-title'],
            "postContent" => $formData['post-content'],
            "postAuthor" => $_SESSION['adminUsername'],
            "postDate" => date('Y/m/d')
        ];

        // var_dump($data->postContent);


        if (Posts::validateFields($data))
        {
            Posts::create($data);
            FlashMessage::createSuccessMessage('Post criado com sucesso!');
        } else {
            FlashMessage::createErrorMessage('Preencha todos os campos');
        }

        return $response
        ->withHeader('Location', 'http://localhost:8082/dashboard')
        ->withStatus(302);

    }
}