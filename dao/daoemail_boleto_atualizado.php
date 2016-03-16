<?php

require_once(dirname(__FILE__) . "./../bd/conexao.php");
require_once(dirname(__FILE__) . "./../model/EmailBoletoAtualizado.php");

class DaoEmailBoletoAtualizado
{

    public static $instance;

    private function __construct()
    {
        //
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
            self::$instance = new DaoEmailBoletoAtualizado();
        return self::$instance;
    }

    public function Inserir(EmailBoletoAtualizado $emailBoletoAtualizado)
    {
        try {
            $sql = "INSERT INTO EMAIL ("
                . "DESTINATÁRIO, "
                . "HORARIO, "
                . "HOST_idHOST) "
                . " VALUES ("
                . ":destinatario,"
                . "now(),"
                . ":host);";

            $sql2 = "INSERT INTO EMAIL_BOLETO_ATL ("
                . "EMAIL_idEMAIL, "
                . "NUM_NOTA, "
                . "VENCIMENTO) "
                . " VALUES ( "
                . ":lastid, "
                . ":numeroNota, "
                . ":vencimento "
                . ");";

            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":destinatario", $emailBoletoAtualizado->getDestinatario());
            $p_sql->bindValue(":host", $emailBoletoAtualizado->getHost()->getIdHost());
            $bool = $p_sql->execute();
            $id = Conexao::getInstance()->lastInsertId();

            $p_sql2 = Conexao::getInstance()->prepare($sql2);
            $p_sql2->bindValue(":lastid", $id);
            $p_sql2->bindValue(":numeroNota", $emailBoletoAtualizado->getNumeroNota());
            $p_sql2->bindValue(":vencimento", $emailBoletoAtualizado->getVencimento());
            $p_sql2->execute();

            return $id;
        } catch (Exception $e) {
            print $e;
        }
    }

    public function SelecionaAnexosPorID($id)
    {
        try {
            $sql = "SELECT ARQUIVO FROM EMAIL_BOLETO_ATL "
                . "JOIN ANEXO_EMAIL_BOLETO_ATUALIZADO ON EMAIL_BOLETO_ATL_EMAIL_idEMAIL = EMAIL_idEMAIL "
                . "WHERE EMAIL_idEMAIL = :id";

            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":id", $id);
            $p_sql->execute();
            $result = $p_sql->fetchAll();
            $anexos = new ArrayObject();
            foreach ($result as $row) {
                $anexos->append($row['ARQUIVO']);
            }
            return $anexos;
        } catch (Exception $ex) {

        }
    }

    public function emailNaoEnviado($id)
    {
        $sql = "UPDATE email SET SITUACAO = 'N' WHERE email.idEMAIL = :id;";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $id);
        return $p_sql->execute();
    }

}
