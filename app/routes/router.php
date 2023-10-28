<?php

$app->get('/', '\app\controller\Home:index');

$app->get('/publicar', '\app\controller\Publish:index');

$app->get('/posts/{id}', '\app\controller\Home:show');