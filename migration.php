<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;

$path = __DIR__;

$dontenv = Dotenv::createImmutable($path);
$dontenv->load();

switch ($_SERVER['argv'][1])
{
    case 'create':

        break;

    case 'help':
        print "Execute o comando 'create' para criar as migrations\n";
        break;

    default:
        print 'Comando inválido!';
}