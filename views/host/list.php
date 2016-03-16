<?php
include_once '../default/top.php';
?>
    <div class="x_title">
        <h3>Endereços de emails cadastrados:</h3>
        <div class="clearfix"></div>
    </div>
    <div class="x_panel">
        <table class="table table-hover" border="0" align="center" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Email Cadastrado</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once('../../dao/daohost.php');
            require_once('../../model/host.php');

            $daohost = DaoHost::getInstance();
            $listaHosts = $daohost->SelecionaTudo();

            foreach ($listaHosts as $host) :
                ?>
                <tr>
                    <th scope="row"><?= $host->getIdHost() ?> </th>
                    <td> <?= $host->getNome() ?> </td>
                    <td> <?= $host->getEmail() ?> </td>
                    <td><a href="alterar.php?id= <?= $host->getIdHost() ?>">Alterar</a></td>
                    <td><a href="excluir.php?id=<?= $host->getIdHost() ?>">Remover</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <button type="button" class="btn btn-success pull-right" onclick="location.href = 'inserir.php'">Inserir
        </button>
    </div>

<?php
include_once '../default/bottom.php';
?>