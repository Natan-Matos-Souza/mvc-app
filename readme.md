# Como utlizar o projeto
Para utilizar esse projeto é necessário ter o **_Composer_** instalado em sua máquina, pois, sem ele, você não conseguirá instalar as dependências necessárias.

### Principais Dependências Utilizadas:
- Slim Framework: simples framework PHP.
- Slim/Twig: Template Engine Twig com suporte ao Slim.
- PHPMailer: Dependência para envio de e-mails.
- Vlucas/PHPDotenv: Dependência para utilização do .env (variáveis de ambiente).

Para instalar todas as dependências, digite em seu terminal:

    composer install

Após isso, inicie a aplicação com o comando:

     php -S localhost:8082 -t app/public

Infelizmente, esse projeto não possui uma **_migration_** para a criação de tabelas automatizadas. Em breve, trabalharei nisso.