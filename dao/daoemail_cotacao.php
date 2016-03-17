<?php

require_once(dirname(__FILE__) . "./../bd/conexao.php");
require_once(dirname(__FILE__) . "./../model/EmailCotacao.php");
require_once(dirname(__FILE__) . "./../model/Cotacao.php");
require_once(dirname(__FILE__) . "./daohost.php");

class DaoEmailCotacao
{

    public static $instance;

    private function __construct()
    {
        //
    }

    public static function getInstance()
    {
        if (!isset(self::$instance))
            self::$instance = new DaoEmailCotacao();
        return self::$instance;
    }

    public function Inserir(EmailCotacao $emailCotacao)
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

            $sql2 = "INSERT INTO EMAIL_COTACAO ("
                . "EMAIL_idEMAIL, "
                . "TRANSPOT"
                . ")"
                . " VALUES ( "
                . ":lastid, "
                . ":transportadora"
                . ");";

            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":destinatario", $emailCotacao->getDestinatario());
            $p_sql->bindValue(":host", $emailCotacao->getHost()->getIdHost());
            $bool = $p_sql->execute();
            $id = Conexao::getInstance()->lastInsertId();

            $p_sql2 = Conexao::getInstance()->prepare($sql2);
            $p_sql2->bindValue(":lastid", $id);
            $p_sql2->bindValue(":transportadora", $emailCotacao->getTranportadora());
            $p_sql2->execute();
            return $id;
        } catch (Exception $e) {
            print $e;
        }
    }

    public function getEmailCotacaoById($id)
    {
        $sql = "SELECT EMAIL_idEMAIL, TRANSPOT, DESTINATÁRIO, HORARIO, HOST_idHOST FROM email_cotacao "
            . "JOIN email ON email.idEMAIL = email_cotacao.EMAIL_idEMAIL "
            . "WHERE EMAIL_idEMAIL = :id";

        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $id);
        $p_sql->execute();
        return $this->populaEmailCotacao($p_sql->fetch(PDO::FETCH_ASSOC));
    }

    private function populaEmailCotacao($row)
    {
        $pojo = new EmailCotacao();
        $pojo->setIdEmail($row['EMAIL_idEMAIL']);
        $pojo->setTranportadora($row['TRANSPOT']);
        $pojo->setDestinatario($row['DESTINATÁRIO']);
        $pojo->setHorario($row['HORARIO']);

        $daohost = DaoHost::getInstance();

        $pojo->setHost($daohost->SelecionaID($row['HOST_idHOST']));

        return $pojo;
    }

    public function getEmailCotacaoCotacoes($id)
    {
        $emailCotacao = $this->getEmailCotacaoById($id);
        $emailCotacao->setCotacoes($this->selectCotacoesByEmail($id));
        return $emailCotacao;
    }

    private function selectCotacoesByEmail($id)
    {
        try {
            $sql = "SELECT idCOTACAO, NOME_EMP, CNPJ, CIDADE, VOL, LITROS, VALOR_NFE, FRETE FROM cotacao "
                . "JOIN email_cotacao ON email_cotacao.EMAIL_idEMAIL = cotacao.EMAIL_COTACAO_EMAIL_idEMAIL "
                . "WHERE EMAIL_idEMAIL = :idEmail;";

            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":idEmail", $id);
            $p_sql->execute();
            $result = $p_sql->fetchAll();
            $cotacoes = new ArrayObject();
            foreach ($result as $row) {
                $cotacoes->append($this->populaCotacao($row));
            }
            return $cotacoes;
        } catch (Exception $e) {
            echo $e;
        }
    }

    private function populaCotacao($row)
    {
        $pojo = new Cotacao();
        $pojo->setIdCotacao($row['idCOTACAO']);
        $pojo->setNome_empresa($row['NOME_EMP']);
        $pojo->setCnpj($row['CNPJ']);
        $pojo->setCidade($row['CIDADE']);
        $pojo->setVolume($row['VOL']);
        $pojo->setLitros($row['LITROS']);
        $pojo->setValor_nota_fiscal_e($row['VALOR_NFE']);
        $pojo->setFrete($row['FRETE']);

        return $pojo;
    }

    public function emailNaoEnviado($id)
    {
        $sql = "UPDATE email SET SITUACAO = 'N' WHERE email.idEMAIL = :id;";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $id);
        return $p_sql->execute();
    }

    public
    function getTextoEmailCotacao($id)
    {
        $daoEmailCotacao = $this::getInstance();
        $emailCotacao = $daoEmailCotacao->getEmailCotacaoCotacoes($id);

        $cabecalho_message = "<!DOCTYPE HTML>
                <html>
                    <head>
                        <meta charset='utf-8'>
                    </head>
                    <body>
                        <p>Bom dia,</p>
                        <br>
                        <p>Precisa de cotação, pela <strong>" . $emailCotacao->getTranportadora() . "</strong>, para:</p>";


        $rodape_message = "<br>
                        <p>Att,
                        <br><br><br>
                        <strong>
                        HD HIDROQUIMICA
                        <br><br>
                        Marques e Agliardi Ltda.<br>
                        CNPJ: 06.263.956/0001-62<br>
                        BR 101 Km 98 nº 2010<br>
                        Osório/RS<br>
                        (51) 3663-6363
                        </strong>
                        </p>
                    </body>
                </html>";

        $message = $cabecalho_message;
        foreach ($emailCotacao->getCotacoes() as $cotacao) {
            $item_message = "<table>
                            <tr>
                                <td>Empresa:</td>
                                <td> " . $cotacao->getNome_empresa() . "</td>
                            </tr>
                            <tr>
                                <td>CNPJ:</td>
                                <td> " . $cotacao->getCnpj() . "</td>
                            </tr>
                            <tr>
                                <td>Cidade-sede:</td>
                                <td> " . $cotacao->getCidade() . "</td>
                            </tr>
                            <tr>
                                <td>Volume:</td>
                                <td> " . $cotacao->getVolume() . "</td>
                            </tr>
                            <tr>
                                <td>Litros:</td>
                                <td> " . $cotacao->getLitros() . " litros</td>
                            </tr>
                            <tr>
                                <td>Valor da NF-e:</td>
                                <td> R$ " . $cotacao->getValor_nota_fiscal_e() . "</td>
                            </tr>
                            <tr>
                                <td>Frete:</td>
                                <td> " . $cotacao->getFrete() . "</td>
                            </tr>
                        </table>
                        <br>";

            $message .= $item_message;
        }

        $message .= $rodape_message;

        return $message;
    }


}
