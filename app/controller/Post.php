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
        $this->setView('posts.html');

        $posts = Posts::getAllPosts(25);

        // var_dump($posts);

        $this->getView()->render($response, self::$viewName, [
            "posts" => $posts
        ]);

        return $response;
    }

    public function destroy($request, $response)
    {
        if (!$_SESSION['canDeletePosts'])
        {
            return $response
            ->withStatus(401);
        }

        $data = (int) explode("=", $request->getBody()->getContents())[1];

        if (Posts::deletePost($data))
        {
            return $response
            ->withStatus(204);
        } else {
            return $response
            ->withStatus(500);
        }



    }

    public function delete($request, $response, $args)
    {
        if (!$_SESSION['canDeletePosts'])
        {
            FlashMessage::createErrorMessage('Você não possui permissão!');

            return $response
            ->withHeader('Location', 'http://localhost/dashboard')
            ->withStatus(301);
        }

        $posts = Posts::getAllPosts(25);

        $this->setView('delete.html');

        $this->getView()->render($response, self::$viewName, [
            "posts" => $posts,
            "userName" => $_SESSION['adminUsername']
        ]);

        if ($_SESSION['admin'] && $_SESSION['canDeletePosts'])
        {
            return $response;
        } else {

            FlashMessage::createErrorMessage('Você não possui permissão!');

            return $response
            ->withHeader('Location', 'http://localhost:8082/dashboard')
            ->withStatus(301);
        }
    }

    public function show($request, $response, $args)
    {
        
        $this->setView('post.html');

        $this->getView()->render($response, self::$viewName, [
            "postId" => $args['id']
        ]);

        
        return $response;
    }

    public function create($request, $response)
    {
        if (!$_SESSION['canCreatePosts'])
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
        if (!$_SESSION['canCreatePosts'])
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