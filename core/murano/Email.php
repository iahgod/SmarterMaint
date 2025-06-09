<?php

namespace core\murano;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use \src\Config;
use \core\murano\DB;

class Email {

    public static function enviar($toEmail, $name, $assunto, $mensagem, $anexos = []){
        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->SMTPDebug = 2; // Mostra detalhes da comunicação SMTP (para desenvolvimento)
            $mail->Debugoutput = 'html'; // Ou 'echo' ou 'error_log' se quiser customizar a saída
            $mail->Host       = Config::HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = Config::USER;
            $mail->Password   = Config::PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = Config::PORT;
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            // Remetente e destinatário
            $mail->setFrom(Config::FROM_EMAIL, Config::FROM_NAME);
            $mail->addAddress($toEmail, $name);
            $mail->addReplyTo(Config::FROM_EMAIL, Config::FROM_NAME);

            // Conteúdo
            $mail->isHTML(true);
            $mail->Subject = $assunto;
            $mail->Body    = $mensagem;
            $mail->AltBody = strip_tags($mensagem);

            // Anexos
            foreach ($anexos as $anexo) {
                if (isset($anexo['tmp_name']) && is_uploaded_file($anexo['tmp_name'])) {
                    $mail->addAttachment($anexo['tmp_name'], $anexo['name']);
                }
            }

            $mail->send();
            return true;

        } catch (Exception $e) {
            // Opcional: logar erro
            $erro = "Erro ao enviar e-mail para $toEmail: " . $mail->ErrorInfo . "\n";
            DB::table('logs')->insert([
                'tipo' => 'email',
                'mensagem' => $erro,
                'data' => date('Y-m-d H:i:s')
            ]);
            return false;
        }
    }

}