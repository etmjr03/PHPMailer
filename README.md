* Envio de email em PHP com PHPMailer

<h3>Como executar o projeto</h3>

- Requisitos:
NodeJS
Composer

- Executar os seguintes comandos no terminal
composer install
composer require phpmailer/phpmailer

<h3>configuração do projeto</h3>

- No arquivo Email.php
- const USER      = 'adicione seu email aqui';
- const PASS      = 'adicione sua senha aqui';

Essas informações são referentes a configuração do PHPMailer, ele usa suas credenciais para disparar os email, você pode utilizar um de teste, e em caso de projetos reais, pode receber essas informações via BANCO DE DADOS ou por alguma API, por exemplo, mas não se esqueça, não use essas informações sensíveis diretamente no código. 🙂

- const FROM_EMAIL = 'email do remetente';
- const FROM_NAME  = 'nome do remetente';

- No arquivo index.php
"$enderecos = 'recebe o email do destinatário';"