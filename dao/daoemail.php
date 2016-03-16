<?php

require_once './../bd/conexao.php';
require_once './../model/Email.php';

class DaoEmail
{
    public static $instance;

    private function __construct()
    {
        //
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
            self::$instance = new DaoEmail();
        return self::$instance;
    }

    public function SelecionaEmails()
    {
        $sql = "SELECT idEMAIL, DESTINATÁRIO as destinatario,  horario,  HOST_idHOST as `host`, situacao "
            . "FROM EMAIL "
            . "ORDER BY horario DESC";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->execute();

        return $p_sql->fetchAll(PDO::FETCH_CLASS, "Email");
    }

}