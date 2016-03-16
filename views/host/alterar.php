<?php
ini_set('display_errors', 1);

include_once '../default/top.php';
require_once '../../model/host.php';
require_once '../../dao/daohost.php';

if (isset($_POST['nome'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $host = new Host();
    $host->setIdHost($id);
    $host->setNome($nome);
    $host->setEmail($email);
    $host->setSenha($senha);

    $daoHost = DaoHost::getInstance();
    $bool = $daoHost->Editar($host);


    if ($bool) {
        header("location: list.php");
    } else {
        echo '<script language="javascript">';
        echo 'var aux = confirm("Ocorreu um erro durante a modificação de registro!");';
        echo 'if (aux) {';
        echo '  location.href = "list.php";';
        echo '}';
        echo '</script>';
    }
} else {
    include_once './alterar_form.php';
}

include_once '../default/bottom.php'
?>
