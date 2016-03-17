<?php
include_once '../../default/top.php';
?>
<h3>Envio de email de cotação
</h3>
<div class="ln_solid"></div>
<div id="form">
    <?php
    require_once './../../../dao/daohost.php';
    require_once './../../../dao/daoemail_cotacao.php';
    require_once './../../../dao/daocotacao.php';
    require_once './../../../model/EmailCotacao.php';
    require_once './../../../model/Cotacao.php';
    require_once './../../../email/cotacao.php';

    if (isset($_POST['count'])) {
        $daohost = DaoHost::getInstance();
        $daoEmailCotacao = DaoEmailCotacao::getInstance();
        $daoCotacao = DaoCotacao::getInstance();

        $emailCotacao = new EmailCotacao();

        $host = $_POST['host'];
        $emailCotacao->setHost($daohost->SelecionaID($host));
        $emailCotacao->setDestinatario($_POST['destinatario']);
        $emailCotacao->setTranportadora($_POST['transportadora']);

        $id = $daoEmailCotacao->Inserir($emailCotacao);

        $emailCotacao->setIdEmail($id);

        $count = $_POST['count'];

        for ($i = 1; $i <= $count; $i++) {
            $cotacao = new Cotacao();

            $cotacao->setNome_empresa($_POST['nome_empresa' . $i]);
            $cotacao->setCnpj((int)$_POST['cnpj' . $i]);
            $cotacao->setCidade($_POST['cidade' . $i]);
            $cotacao->setVolume($_POST['volume' . $i]);
            $cotacao->setLitros(doubleval($_POST['litros' . $i]));
            $cotacao->setValor_nota_fiscal_e(doubleval($_POST['valor_nfe' . $i]));
            $cotacao->setFrete($_POST['frete' . $i]);
            $cotacao->setEmail($emailCotacao);

            $daoCotacao->Inserir($cotacao);

        }

        $emailCotacao = $daoEmailCotacao->getEmailCotacaoCotacoes($emailCotacao->getIdEmail());

        $enviarEmailCotacao = MailCotacao::getInstance();
        $bool2 = $enviarEmailCotacao->sendMail($emailCotacao);

        if ($bool2) {
            //redirect("views/dashboard.php");
        } else {
            $daoEmailCotacao->emailNaoEnviado($emailCotacao->getIdEmail());
            echo '<script language="javascript">';
            echo 'var aux = confirm("Ocorreu um erro durante o envio ou inserção do registro de email!");';
            echo 'if (aux) {';
            echo '  location.href = "../../../";';
            echo '}';
            echo '</script>';
        }
    } else {
        include_once('form_enviar.php');
    }
    ?>
</div>
<?php
include_once '../../default/bottom.php';
?>
