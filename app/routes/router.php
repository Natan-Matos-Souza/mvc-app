<?php

$app->get('/', '\app\controller\Home:index');

$app->get('/posts/{id}', '\app\controller\Post:show');
$app->get('/posts', '\app\controller\Post:index');

$app->get('/cadastrar', '\app\controller\User:create');
$app->post('/cadastrar', '\app\controller\User:store');

$app->get('/login', '\app\controller\Login:index');
$app->post('/login', '\app\controller\Login:auth');
$app->get('/logout', '\app\controller\Logout:logout');

$app->get('/dashboard', '\app\controller\Dashboard:index');
$app->get('/dashboard/post', '\app\controller\Post:create');
$app->post('/dashboard/post', '\app\controller\Post:store');
$app->delete('/dashboard/post/apagar', '\app\controller\Post:destroy');
$app->get('/dashboard/post/apagar', '\app\controller\Post:delete');



$app->get('/api/posts/{id}', '\app\controller\PostsApi:list');
$app->get('/api/posts/', '\app\controller\PostsApi:index');

$app->get('/favorites', '\app\controller\Favorites:index');

$app->get('/debug', function($request, $response) {
    var_dump($_SESSION);

    return $response;
});