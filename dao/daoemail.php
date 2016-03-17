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
        $sql = "SELECT email.idEmail, DESTINATÁRIO as destinatario, horario, HOST_idHOST as `host`, situacao, "
            . "( CASE "
            . " WHEN email_boleto_atl.EMAIL_idEMAIL IS NOT NULL THEN 'Boleto atualizado' "
            . " WHEN email_cotacao.EMAIL_idEMAIL IS NOT null THEN 'Cotação' "
            . " END "
            . ") AS type "
            . "FROM email "
            . "LEFT JOIN email_boleto_atl ON email.idEMAIL = email_boleto_atl.EMAIL_idEMAIL "
            . "LEFT JOIN email_cotacao ON email.idEMAIL = email_cotacao.EMAIL_idEMAIL;";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->execute();

        return $p_sql->fetchAll(PDO::FETCH_CLASS, "Email");
    }

    //deprecaated method
    public function selectMostRecentEmail()
    {
        $sql = "SELECT idEmail, DESTINATÁRIO as destinatario,  horario,  HOST_idHOST as `host`, situacao "
            . "FROM EMAIL "
            . "ORDER BY horario DESC"
            . "LIMIT 1;";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->execute();

        return $p_sql->fetch(PDO::FETCH_CLASS, "Email");
    }

    public function getType($id)
    {
        $sql = "SELECT "
            . "( CASE "
            . " WHEN email_boleto_atl.EMAIL_idEMAIL IS NOT NULL THEN 'Boleto atualizado' "
            . " WHEN email_cotacao.EMAIL_idEMAIL IS NOT null THEN 'Cotação' "
            . " END "
            . ") AS type "
            . "FROM email "
            . "LEFT JOIN email_boleto_atl ON email.idEMAIL = email_boleto_atl.EMAIL_idEMAIL "
            . "LEFT JOIN email_cotacao ON email.idEMAIL = email_cotacao.EMAIL_idEMAIL "
            . "WHERE idEMAIL = :id;";

        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $id);
        $p_sql->execute();

        $result = $p_sql->fetch(PDO::FETCH_ASSOC);

        return $result["type"];

    }

}