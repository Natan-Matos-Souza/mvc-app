<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;

$path = __DIR__;

$dontenv = Dotenv::createImmutable($path);
$dontenv->load();

switch ($_SERVER['argv'][1])
{
    case 'create':

        $database = new mysqli($_ENV['DATABASEHOST'], $_ENV['DATABASEUSER'], $_ENV['DATABASEPASS'], $_ENV['DATABASE']);


        $databaseQueries = [
            'CREATE TABLE users(id int(30) NOT NULL AUTO_INCREMENT,name varchar(60),email varchar(60),primary key(id))'
        ];

        foreach ($databaseQueries as $query)
        {
            $database->query($query);
        }
        

        break;

    case 'help':
        print "Comandos disponíveis:\n";

        print "\ncreate: cria as tabelas no banco de dados.\n";

        print "\ndrop: apaga as tabelas geradas no banco de dados.\n";
        print "\n";
        break;

    case 'drop':
        $database = new mysqli($_ENV['DATABASEHOST'], $_ENV['DATABASEUSER'], $_ENV['DATABASEPASS'], $_ENV['DATABASE']);

        $database->query('DROP TABLE users');
        break;

    default:
        print 'Comando inválido!';
}