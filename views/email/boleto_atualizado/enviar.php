<?php
include_once '../../default/top.php';
?>
    <h3>Envio de email de Boleto Atualizado</h3>
    <div class="ln_solid"></div>
    <div id="form">
        <?php
        ini_set('display_errors', 1);

        require_once './../../../dao/daohost.php';
        require_once './../../../dao/daoemail_boleto_atualizado.php';
        require_once './../../../dao/daoanexo_email_boleto_atualizado.php';
        require_once './../../../model/EmailBoletoAtualizado.php';
        require_once './../../../email/boleto_atualizado.php';

        if (isset($_POST['destinatario']) && isset($_FILES['uploads'])) {
            //Pegando e armazenando no BD as variáveis do form
            $host = $_POST['host'];
            $destinatario = $_POST['destinatario'];
            $numero_nota = $_POST['numero_nota'];
            $vencimento = $_POST['vencimento'];

            $daohost = DaoHost::getInstance();
            $host1 = $daohost->SelecionaID($host);

            //Criando objeto
            $emailBoletoAtualizado = new EmailBoletoAtualizado();
            $emailBoletoAtualizado->setHost($host1);
            $emailBoletoAtualizado->setDestinatario($destinatario);
            $emailBoletoAtualizado->setNumeroNota($numero_nota);
            $emailBoletoAtualizado->setVencimento($vencimento);

            //Inserindo objeto
            $daoEmailBoletoAtualizado = DaoEmailBoletoAtualizado::getInstance();
            $id = $daoEmailBoletoAtualizado->Inserir($emailBoletoAtualizado);

            $emailBoletoAtualizado->setIdEmail($id);

            //Pegando os arquivos
            $date = date('His_dmY');
            $comingBack = "./../../../";
            $basicDir = ("upload/anexos_boleto/" . $date);
            mkdir($comingBack . $basicDir, 0700);

            $daoAnexoEmailAtualizado = DaoAnexoEmailBoletoAtualizado::getInstance();

            $i = 0;
            foreach ($_FILES["uploads"]["error"] as $key => $error) {
                $array = explode('.', $_FILES['uploads']['name'][$i]);
                $extension = end($array);
                $basicPasta = $basicDir . "/_" . $i . "." . $extension;
                $realPasta = $comingBack . $basicPasta;
                move_uploaded_file($_FILES["uploads"]["tmp_name"][$i], $realPasta);
                ++$i;
                $anexoEmailAtualizado = new AnexoEmailBoletoAtualizado();
                $anexoEmailAtualizado->setArquivo($basicPasta);
                $anexoEmailAtualizado->setEmailBoletoAtualizado($emailBoletoAtualizado);
                $daoAnexoEmailAtualizado->Inserir($anexoEmailAtualizado);
            }

            $mailBoletoAtualizado = MailBoletoAtualizado::getInstance();
            $bool2 = $mailBoletoAtualizado->sendMail($emailBoletoAtualizado);

            if ($bool2) {
                //redirect("views/dashboard.php");
            } else {
                echo '<script language="javascript">';
                echo 'var aux = confirm("Ocorreu um erro durante o envio ou inserção do registro de email!");';
                echo 'if (aux) {';
                echo '  location.href = "../../../";';
                echo '}';
                echo '</script>';
            }
        } else {
            include_once('form_enviar.php');
        } ?>

    </div>
<?php
include_once '../../default/bottom.php'
?>