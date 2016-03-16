<form enctype="multipart/form-data" action="" method="post" class="form-horizontal form-label-left">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="host"> Host:
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="form-control col-md-7 col-xs-12" id="host" type="text"
                    name="host">
                <?php
                require_once '../../../dao/daohost.php';

                $daohost = DaoHost::getInstance();
                $listaHosts = $daohost->SelecionaTudo();

                foreach ($listaHosts as $host) : ?>
                    <option value=" <?= $host->getIdHost() ?>"> <?= $host->getNome() ?></option>;
                <?php endforeach; ?>
                ?>

            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="destinatario"> Destinatário:
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control col-md-7 col-xs-12" id="destinatario" type="text"
                   name="destinatario">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="numero_nota"> Número do doc:
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control col-md-7 col-xs-12" id="numero_nota" type="number"
                   name="numero_nota">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vencimento"> Vencimento:
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control col-md-7 col-xs-12" id="vencimento" type="date"
                   name="vencimento">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="uploads"> Anexos:
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control col-md-7 col-xs-12" id="uploads" type="file" multiple
                   name="uploads[]">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button class="btn btn-success pull-right" type="submit">Enviar</button>
        </div>
    </div>

</form>