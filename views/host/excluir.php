<?php
ini_set('display_errors', 1);
require_once '../../dao/daohost.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $daoHost = DaoHost::getInstance();
    $bool = $daoHost->Excluir($id);


    if ($bool) {
        header("location:list.php");
    } else {
        echo '<script language="javascript">';
        echo 'var aux = confirm("Ocorreu um erro ao excluir registro!");';
        echo 'if (aux) {';
        echo '  location.href = "list.php";';
        echo '}';
        echo '</script>';
    }
}
?>