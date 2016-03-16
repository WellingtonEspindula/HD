<?php

require_once "Mail.php";
require_once 'Mail/mime.php';
require_once(dirname(__FILE__) . './../model/EmailBoletoAtualizado.php');
require_once(dirname(__FILE__) . './../dao/daoemail_boleto_atualizado.php');

class MailBoletoAtualizado {

    public static $instance;

    private function __construct() {
        //
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new MailBoletoAtualizado();
        return self::$instance;
    }

    public function sendMail(EmailBoletoAtualizado $emailBoletoAtualizado) {
        $daoEmailBoletoAtualizado = DaoEmailBoletoAtualizado::getInstance();
        $anexos = $daoEmailBoletoAtualizado->SelecionaAnexosPorID($emailBoletoAtualizado->getIdEmail());
        $dirConst = dirname(__FILE__) . "./../";

        $html = "<!DOCTYPE HTML>
                <html>
                    <head>
                        <meta http-equiv='Content-Type'  content='text/html charset = UTF-8' />
                    </head>
                    <body>
                        <p>Bom dia</p>
                        <br>
                        <p>Segue em anexo a 2ª via atualizada do boleto conforme solicitado.</p>
                        <table>
                            <tr>
                                <td><strong>Nº doc:</strong></td>
                                <td> " . $emailBoletoAtualizado->getNumeroNota() . "</td>
                            </tr>
                            <tr>
                                <td><strong>Vencimento:</strong></td>
                                <td> " . date_format(date_create($emailBoletoAtualizado->getVencimento()), "d/m/Y") . "</td>
                            </tr>
                        </table>
                        <br>
                        <p>
                        OBS.:<br>
                        FOI VERIFICADO A OCORRÊNCIA DE FALHAS NO ENVIO DOS BOLETOS POR PARTE DE NOSSOS PRESTADORES DE SERVIÇO, BANCO DO ESTADO DO RIO GRANDE DO SUL (BANRISUL) E AGÊNCIA DOS CORREIOS. POR ESSE MOTIVO ESTAMOS REENVIANDO AOS NOSSOS CLIENTES SEUS BOLETOS.<br>
                        CASO JÁ TENHA RECEBIDO SEU BOLETO, DESCONSIDERE ESSE E-MAIL.<br>
                        <br>
                        <strong>
                        *POR GENTILEZA CONFIRMAR RECEBIMENTO DE E-MAIL.
                        </strong>
                        </p>
                        <br>
                        <p>Att,
                        <br><br><br>
                        <strong>
                        HD HIDROQUIMICA
                        <br><br>
                        Marques e Agliardi Ltda.<br>
                        CNPJ: 06.263.956/0001-62<br>
                        BR 101 Km 98 nº 2010<br>
                        Osório/RS<br>
                        (51) 3663-6363
                        </strong>
                        </p>
                    </body>
                </html>";

        $from = $emailBoletoAtualizado->getHost()->getEmail();
        $to = $emailBoletoAtualizado->getDestinatario();
        $subject = "Boleto Atualizado";

        $host = "smtp.osr.terra.com.br";
        $username = $emailBoletoAtualizado->getHost()->getEmail();
        $password = $emailBoletoAtualizado->getHost()->getSenha();

        $crlf = "\n";
        $hdrs = array(
            'From' => $from,
            'Subject' => $subject
        );


        $mime = new Mail_mime(array('eol' => $crlf));

        $mime->setHTMLBody($html);
        foreach ($anexos as $file) {
            $anexo = $dirConst . $file;
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimetype = finfo_file($finfo, $anexo);
            finfo_close($finfo);
            $mime->addAttachment($anexo, $mimetype);
        }

        $body = $mime->get();
        $hdrs = $mime->headers($hdrs);

        $smtp = Mail::factory('smtp', array('host' => $host,
                    'auth' => true,
                    'username' => $username,
                    'password' => $password));

        $mail = $smtp->send($to, $hdrs, $body);
        return (!PEAR::isError($mail));
    }

}

?>
