<?php

require_once(dirname(__FILE__) . "./../bd/conexao.php");
require_once(dirname(__FILE__) . "./../model/Cotacao.php");
require_once(dirname(__FILE__) . "./../model/EmailCotacao.php");

class DaoCotacao {

  public static $instance;

  private function __construct() {
    //
  }

  public static function getInstance() {
    if (!isset(self::$instance))
    self::$instance = new DaoCotacao();
    return self::$instance;
  }

  public function Inserir(Cotacao $cotacao) {
    try {
      $sql = "INSERT INTO COTACAO ("
      . "NOME_EMP, "
      . "CNPJ, "
      . "CIDADE, "
      . "VOL, "
      . "LITROS, "
      . "VALOR_NFE, "
      . "FRETE, "
      ." EMAIL_COTACAO_EMAIL_idEMAIL) "
      . " VALUES ("
      . ":nome_empresa,"
      . ":cnpj,"
      . ":cidade,"
      . ":volume,"
      . ":litros,"
      . ":valor_nota_fiscal_e,"
      . ":frete,"
      . ":email"
      . ");";

      $p_sql = Conexao::getInstance()->prepare($sql);
      $p_sql->bindValue(":nome_empresa", $cotacao->getNome_empresa());
      $p_sql->bindValue(":cnpj", $cotacao->getCnpj());
      $p_sql->bindValue(":cidade", $cotacao->getCidade());
      $p_sql->bindValue(":volume", $cotacao->getVolume());
      $p_sql->bindValue(":litros", $cotacao->getLitros());
      $p_sql->bindValue(":valor_nota_fiscal_e", $cotacao->getValor_nota_fiscal_e());
      $p_sql->bindValue(":frete", $cotacao->getFrete());
      $p_sql->bindValue(":email", $cotacao->getEmail()->getIdEmail());
      $bool = $p_sql->execute();
      $id = Conexao::getInstance()->lastInsertId();

      return $bool;
    } catch (Exception $e) {
      print $e;
    }
  }

}



?>
