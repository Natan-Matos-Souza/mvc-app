<?php

$app->get('/', '\app\controller\Home:index');

$app->get('/publicar', '\app\controller\Post:create');
$app->post('/publicar', '\app\controller\Post:store');
$app->get('/posts/{id}', '\app\controller\Post:list');
$app->get('/posts', '\app\controller\Post:index');

$app->get('/cadastrar', '\app\controller\User:create');
$app->post('/cadastrar', '\app\controller\User:store');

$app->get('/login', '\app\controller\Login:index');
$app->post('/login', '\app\controller\Login:auth');

$app->get('/api/posts/{id}', '\app\controller\PostsApi:list');
$app->get('/api/posts/', '\app\controller\PostsApi:index');