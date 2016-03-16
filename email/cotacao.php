<?php

require_once "Mail.php";
require_once 'Mail/mime.php';
require_once(dirname(__FILE__) . './../model/EmailCotacao.php');

class MailCotacao
{

    public static $instance;

    private function __construct()
    {
        //
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
            self::$instance = new MailCotacao();
        return self::$instance;
    }

    public function sendMail(EmailCotacao $emailCotacao)
    {

        $cabecalho_message = "<!DOCTYPE HTML>
                <html>
                    <head>
                        <meta charset='utf-8'>
                    </head>
                    <body>
                        <p>Bom dia,</p>
                        <br>
                        <p>Precisa de cotação, pela <strong>" . $emailCotacao->getTranportadora() . "</strong>, para:</p>";


        $rodape_message = "<br>
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

        $message = $cabecalho_message;
        foreach ($emailCotacao->getCotacoes() as $cotacao) {
            $item_message = "<table>
                            <tr>
                                <td>Empresa:</td>
                                <td> " . $cotacao->getNome_empresa() . "</td>
                            </tr>
                            <tr>
                                <td>CNPJ:</td>
                                <td> " . $cotacao->getCnpj() . "</td>
                            </tr>
                            <tr>
                                <td>Cidade-sede:</td>
                                <td> " . $cotacao->getCidade() . "</td>
                            </tr>
                            <tr>
                                <td>Volume:</td>
                                <td> " . $cotacao->getVolume() . "</td>
                            </tr>
                            <tr>
                                <td>Litros:</td>
                                <td> " . $cotacao->getLitros() . " litros</td>
                            </tr>
                            <tr>
                                <td>Valor da NF-e:</td>
                                <td> R$ " . $cotacao->getValor_nota_fiscal_e() . "</td>
                            </tr>
                            <tr>
                                <td>Frete:</td>
                                <td> " . $cotacao->getFrete() . "</td>
                            </tr>
                        </table>
                        <br>";

            $message .= $item_message;
        }

        $message .= $rodape_message;

        $from = $emailCotacao->getHost()->getEmail();
        $to = $emailCotacao->getDestinatario();
        $subject = utf8_decode("Cotação");

        $host = "smtp.osr.terra.com.br";
        $username = $emailCotacao->getHost()->getEmail();
        $password = $emailCotacao->getHost()->getSenha();

        $headers = array('MIME-Version' => '1.0rn',
            'Content-Type' => "text/html; charset=utf-8",
            'From' => $from,
            'To' => $to,
            'Subject' => $subject);

        $smtp = Mail::factory('smtp', array('host' => $host,
            'auth' => true,
            'username' => $username,
            'password' => $password));

        $mail = $smtp->send($to, $headers, $message);

        return (!PEAR::isError($mail));

    }

}

?>
