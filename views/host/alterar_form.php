<?php
require_once '../../model/host.php';
require_once '../../dao/daohost.php';

$daoHost = DaoHost::getInstance();

$id = $_GET['id'];
$host = $daoHost->SelecionaID($id);
?>
<h3>Alterar endereço de email:</h3>
<div class="ln_solid"></div>
<form action="" method="POST" class="form-horizontal form-label-left">
    <input type="number" hidden name="id" id="id" value="<?php echo $id ?>">

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome"> Nome
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control col-md-7 col-xs-12" id="nome" type="text"
                   name="nome" value="<?php echo $host->getNome(); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email""> Email
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control col-md-7 col-xs-12" id="email" type="email"
                   name="email" value="<?php echo $host->getEmail(); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="senha""> Senha
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="form-control col-md-7 col-xs-12" id="senha" type="password"
                   name="senha">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <button class="btn btn-success pull-right" type="submit">Alterar</button>
        </div>
    </div>
</form>