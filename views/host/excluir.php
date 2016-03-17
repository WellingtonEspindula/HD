<?php
require_once '../../dao/daohost.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $daoHost = DaoHost::getInstance();
    $bool = $daoHost->Excluir($id);


    if ($bool) {
        //redirect("views/host/list.php");
    } else {
        echo '<script language="javascript">';
        echo 'var aux = confirm("Ocorreu um erro ao excluir registro! Possivelmente, existem emails que foram enviados utilizando esse domínio.");';
        echo 'if (aux) {';
        echo '  location.href = "list.php";';
        echo '}';
        echo '</script>';
    }
}
?>