# Como utlizar o projeto
Para utilizar esse projeto é necessário ter o **_Composer_** instalado em sua máquina, pois, sem ele, você não conseguirá instalar as dependências necessárias.

### Principais Dependências Utilizadas:
- Slim Framework: simples framework PHP.
- Slim/Twig: Template Engine Twig com suporte ao Slim.
- PHPMailer: Dependência para envio de e-mails.
- Vlucas/PHPDotenv: Dependência para utilização do .env (variáveis de ambiente).

Para instalar todas as dependências, digite em seu terminal:

````bash
composer install
````


Após isso, inicie a aplicação com o comando:

````bash
php -S localhost:8082 -t app/public
````

Para que a aplicação funcione corretamente, é necessário utilizar a **_migration_** do projeto. Para isso, certifique-se de que todas as informações do banco de dados MySQL estejam declaradas no arquivo **_.env_** e execute o comando:
        
````bash
php migration.php create
````