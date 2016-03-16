<?php

    require_once(dirname(__FILE__) . "./../bd/conexao.php");
    require_once(dirname(__FILE__) . "./../model/Host.php");

class DaoHost{
    public static $instance;

    private function __construct() {
      //
    }

    public static function getInstance() {
       if (!isset(self::$instance))
        self::$instance = new DaoHost();
        return self::$instance;
      }

      public function Inserir(Host $host) {
        try {
          $sql = "INSERT INTO HOST (nome, email, senha) "
                  . "VALUES ( "
                  . ":nome, "
                  . ":email, "
                  . ":senha)";

          $p_sql = Conexao::getInstance()->prepare($sql);
          $p_sql->bindValue(":nome", $host->getNome());
          $p_sql->bindValue(":email", $host->getEmail());
          $p_sql->bindValue(":senha", $host->getSenha());
          return $p_sql->execute();
        } catch (Exception $e) {
          print $e;
        }
      }

      public function Editar(Host $host) {
        try {
          $sql = "UPDATE HOST set "
                  . "nome = :nome, "
                  . "email = :email, "
                  . "senha = :senha "
                  . "WHERE "
                  . "idHOST = :idHost";
          $p_sql = Conexao::getInstance()->prepare($sql);
          $p_sql->bindValue(":nome", $host->getNome());
          $p_sql->bindValue(":email", $host->getEmail());
          $p_sql->bindValue(":senha", $host->getSenha());
          $p_sql->bindValue(":idHost", $host->getIdHost());
          return $p_sql->execute();
        } catch (Exception $e) {
          print $e;
        }
      }

      public function Excluir($idHost){
        try{
          $sql = "DELETE FROM HOST WHERE idHOST = :idHost";
          $p_sql = Conexao::getInstance()->prepare($sql);
          $p_sql->bindValue(":idHost", $idHost);
          return $p_sql->execute();
        } catch (Exception $e) {
          echo $e;
        }
      }

      public function SelecionaID($idHost){
        try{
          $sql = "SELECT * FROM HOST WHERE idHOST = :idHost";
          $p_sql = Conexao::getInstance()->prepare($sql);
          $p_sql->bindValue(":idHost", $idHost);
          $p_sql->execute();
          return $this->populaHost($p_sql->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
          echo $e;
        }
      }

      public function SelecionaTudo(){
        try{
          $sql = "SELECT * FROM HOST";
          $p_sql = Conexao::getInstance()->prepare($sql);
          $p_sql->execute();
          $result = $p_sql->fetchAll();
          $hosts = new ArrayObject();
          foreach ($result as $row) {
              $hosts -> append( $this->populaHost($row) );
          }
          return $hosts;
        } catch (Exception $e) {
          echo $e;
        }
      }

      private function populaHost($row) {
         $pojo = new Host;
         $pojo->setIdHost($row['idHOST']);
         $pojo->setNome($row['NOME']);
         $pojo->setEmail($row['EMAIL']);
         $pojo->setSenha($row['SENHA']);
         return $pojo;
       }


      // Esse método está decadente
      /*
      public function ExisteUsuario($idemail_atendimento){
        try{
          $sql = "SELECT * FROM email_atendimento WHERE idemail_atendimento = :idemail_atendimento;";
          $p_sql = Conexao::getInstance()->prepare($sql);
          $p_sql->bindValue(":idemail_atendimento", $idemail_atendimento);
          $p_sql->execute();
          return $p_sql->fetchColumn();
        } catch (Exception $e) {
          echo "Ocorreu um erro ao tentar executar esta ação, foi gerado um LOG do mesmo, tente novamente mais tarde.";
        }
      }
      */



}

?>
