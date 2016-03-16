<?php

require_once(dirname(__FILE__) . "./../bd/conexao.php");
require_once(dirname(__FILE__) . "./../model/AnexoEmailBoletoAtualizado.php");

class DaoAnexoEmailBoletoAtualizado {

    public static $instance;

    private function __construct() {
        //
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new DaoAnexoEmailBoletoAtualizado();
        return self::$instance;
    }

    public function Inserir(AnexoEmailBoletoAtualizado $anexoEmailBoletoAtualizado) {
        try {
            $sql = "INSERT INTO ANEXO_EMAIL_BOLETO_ATUALIZADO ("
                    . "ARQUIVO, "
                    . "EMAIL_BOLETO_ATL_EMAIL_idEMAIL) "
                    . " VALUES ("
                    . ":arquivo,"
                    . ":boletoAtl);";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":arquivo", $anexoEmailBoletoAtualizado->getArquivo());
            $p_sql->bindValue(":boletoAtl", $anexoEmailBoletoAtualizado->getEmailBoletoAtualizado()->getIdEmail());
            return $p_sql->execute();
        } catch (Exception $e) {
            print $e;
        }
    }

}
