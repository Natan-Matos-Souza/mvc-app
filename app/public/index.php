<?php

require "../../vendor/autoload.php";

session_start();

use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

$path = dirname(__DIR__, 2);

$dotenv = Dotenv::createImmutable($path);
$dotenv->load();


$app = AppFactory::create();

require "../routes/router.php";


$app->run();