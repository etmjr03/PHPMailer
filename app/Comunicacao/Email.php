<?php

namespace App\Comunicacao;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class Email {

    // credenciais de acesso ao SMTP do Email
    const HOST      = 'smtp.office365.com';
    const USER      = 'seu email aqui';
    const PASS      = 'sua senha aqui';
    const SECURE    = 'TLS';
    const PORT      = 587;
    const CHARSET   = 'UTF-8';

    // dados do remetente
    const FROM_EMAIL = 'email do remetente';
    const FROM_NAME  = 'nome do remetente';

    // mensagem de erro
    private $error;

    public function getError() {
        return $this->error;
    }

    /** 
     * $enderecos string ou array
     * $assunto string ou array
     * $mensagem - html string
     * $anexos string
     * $ccs string ou array
     * $bccs string ou array
     * return **boolean**
    **/

    // Métodos responsável por enviar um e-mail
    public function enviarEmail($enderecos, $assunto, $mensagem, $anexos = [], $ccs = [], $bccs = []) {
        // limpar a mensagem de erro
        $this->error = '';

        // instanciar o PHPMailer
        $obMail = new PHPMailer(true);

        try {
        // credenciais de acesso ao SMTP
        $obMail->isSMTP();
        $obMail->Host       = self::HOST;
        $obMail->SMTPAuth   = true;
        $obMail->Username   = self::USER;
        $obMail->Password   = self::PASS;
        $obMail->SMTPSecure = self::SECURE;
        $obMail->Port       = self::PORT;
        $obMail->CharSet    = self::CHARSET;

        // remetente
        $obMail->setFrom(self::FROM_EMAIL, self::FROM_NAME);

        // destinatários
        $enderecos = is_array($enderecos) ? $enderecos : [$enderecos];
        foreach($enderecos as $endereco){
            $obMail->addAddress($endereco);
        }

        // anexos
        $anexos = is_array($anexos) ? $anexos : [$anexos];
        foreach($anexos as $anexo){
            $obMail->addAttachment($anexos);
        }

        // ccs - cópia visível
        $ccs = is_array($ccs) ? $ccs : [$ccs];
        foreach($ccs as $cc){
            $obMail->addCC($cc);
        }

        // bccs - cópia oculta
        $bccs = is_array($bccs) ? $bccs : [$bccs];
        foreach($bccs as $bcc){
            $obMail->addBCC($bcc);
        }

        // conteúdo do e-mail
        $obMail->isHTML(true);
        $obMail->Subject = $assunto;
        $obMail->Body = $mensagem;

        // manda o e-mail
        return $obMail->send();

        } catch (PHPMailerException $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }
}