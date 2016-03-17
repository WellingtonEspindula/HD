<?php
ini_set('display_errors', 1);

include_once 'default/top.php';
require_once '../model/AnexoEmailBoletoAtualizado.php';
require_once '../dao/daoemail.php';
require_once '../dao/daoemail_cotacao.php';
require_once '../dao/daoemail_boleto_atualizado.php';
require_once '../dao/daoanexo_email_boleto_atualizado.php';


$daoEmail = DaoEmail::getInstance();

?>
<a href="dashboard.php">
    <i class="fa fa-chevron-left"></i>
    Voltar
</a>
<br>
<br>
<h3>Email enviado</h3>
<div class="ln_solid"></div>
<div class="x_panel">
    <?php

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $type = $daoEmail->getType($id);

        if ($type == "Cotação") {
            $daoEmailCotacao = DaoEmailCotacao::getInstance();
            $emailCotacao = $daoEmailCotacao->getEmailCotacaoById($id);

            ?>
            <!-- CONTENT MAIL -->
            <div class="x_title">
                <h4> <?php echo $type ?></h4>
                <div class="row">
                    <div class="col-md-12">
                        Destinatário: <strong><?php echo $emailCotacao->getDestinatario() ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        Horário: <strong><?php echo $emailCotacao->getHorario() ?></strong>
                    </div>
                </div>
            </div>

            <div class="x_content">
                <p><?php echo $daoEmailCotacao->getTextoEmailCotacao($id) ?></p>
            </div>

            <?php
        } else if ($type == "Boleto atualizado") {
            $daoEmailBoletoAtl = DaoEmailBoletoAtualizado::getInstance();
            $email = $daoEmail->SelecionaEmail($id);
            $emailBoletoAtl = $daoEmailBoletoAtl->selectionaBoletoAtualizado($id);
            ?>


            <div class="x_title">
                <h4> <?php echo $email->getType() ?></h4>
                <div class="row">
                    <div class="col-md-12">
                        Destinatário: <strong><?php echo $email->getDestinatario() ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        Horário: <strong><?php echo $email->getHorario() ?></strong>
                    </div>
                </div>
            </div>

            <div class="attachment">
                <p>
                    <span>Anexos: </span>
                    <?php
                    $anexos = $daoEmailBoletoAtl->SelecionaAnexosPorID($id);
                    $counter = 0;
                    foreach ($anexos as $anexo):
                        $counter++;
                        ?>
                        <br>
                        <a target="_blank" href="<?= BASE_URL . "/" . $anexo ?>"><?= $counter; ?></a>
                        <?php
                    endforeach;
                    ?>
                </p>
            </div>

            <div class="x_content">
                <p><?php echo $daoEmailBoletoAtl->getTextoEmailBoletoAtualizado($id) ?></p>
            </div>
            <?php
        }
    } else {
        echo "Página inválida!";
    }
    ?>
</div>
<?php
include_once 'default/bottom.php';
?>
