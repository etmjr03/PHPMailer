<?php

require __DIR__.'/vendor/autoload.php';

use \App\Comunicacao\Email;

$enderecos = '';
$assunto = 'Olá, tudo bem?';
$mensagem = file_get_contents('./mensagem.php');
$anexos = 'teste';
$ccs = 'teste';
$bccs = 'teste';

$obEmail = new Email;
$sucesso = $obEmail->enviarEmail($enderecos, $assunto, $mensagem);

require __DIR__.'/index.html';

echo $sucesso ? '<p style="color: #FFF; font-size: 24px;">Mensagem enviada!' : $obEmail->getError();