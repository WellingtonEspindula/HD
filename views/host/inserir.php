<?php
ini_set('display_errors', 1);
include_once '../default/top.php';
require_once '../../model/host.php';
require_once '../../dao/daohost.php';

if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $host = new Host();
    $host->setNome($nome);
    $host->setEmail($email);
    $host->setSenha($senha);

    $daoHost = DaoHost::getInstance();
    $bool = $daoHost->Inserir($host);

    if ($bool) {
        //redirect("views/host/list.php");
    } else {
        echo '<script language="javascript">';
        echo 'var aux = confirm("Ocorreu um erro durante a inserção de registro!");';
        echo 'if (aux) {';
        echo '  location.href = "list.php";';
        echo '}';
        echo '</script>';
    }
} else {
    include_once './insert_form.php';
}
include_once '../default/bottom.php';
?>







