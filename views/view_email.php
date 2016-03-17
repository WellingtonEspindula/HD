<?php
ini_set('display_errors', 1);

include_once 'default/top.php';
require_once '../dao/daoemail.php';
require_once '../dao/daoemail_cotacao.php';
require_once '../dao/daoemail_boleto_atualizado.php';


$daoEmail = DaoEmail::getInstance();

?>
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

        }
    } else {
        echo "Página inválida!";
    }
    ?>
</div>
<?php
include_once 'default/bottom.php';
?>
