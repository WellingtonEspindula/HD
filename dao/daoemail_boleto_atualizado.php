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

    public function SelectionaBoletoAtualizado($id)
    {
        try {
            $sql = "SELECT idEmail, DESTINATÁRIO as destinatario, horario, HOST_idHOST as `host`, situacao, num_nota, vencimento "
                . "FROM email_boleto_atl "
                . " JOIN email ON email_boleto_atl.EMAIL_idEMAIL = email.idEMAIL "
                . "WHERE idEMAIL = :id;";

            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":id", $id);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_CLASS, 'EmailBoletoAtualizado');
        } catch (Exception $ex) {
            return false;
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

    public function getTextoEmailBoletoAtualizado($id)
    {
        $daoBoletoAtualizado = $this::getInstance();
        $emailBoletoAtualizado = $daoBoletoAtualizado->SelectionaBoletoAtualizado($id);

        $html = "<p>Bom dia</p>
                        <br>
                        <p>Segue em anexo a 2ª via atualizada do boleto conforme solicitado.</p>
                        <table>
                            <tr>
                                <td><strong>Nº doc:</strong></td>
                                <td> " . $emailBoletoAtualizado->getNumeroNota() . "</td>
                            </tr>
                            <tr>
                                <td><strong>Vencimento:</strong></td>
                                <td> " . date_format(date_create($emailBoletoAtualizado->getVencimento()), "d/m/Y") . "</td>
                            </tr>
                        </table>
                        <br>
                        <p>
                        OBS.:<br>
                        FOI VERIFICADO A OCORRÊNCIA DE FALHAS NO ENVIO DOS BOLETOS POR PARTE DE NOSSOS PRESTADORES DE SERVIÇO, BANCO DO ESTADO DO RIO GRANDE DO SUL (BANRISUL) E AGÊNCIA DOS CORREIOS. POR ESSE MOTIVO ESTAMOS REENVIANDO AOS NOSSOS CLIENTES SEUS BOLETOS.<br>
                        CASO JÁ TENHA RECEBIDO SEU BOLETO, DESCONSIDERE ESSE E-MAIL.<br>
                        <br>
                        <strong>
                        *POR GENTILEZA CONFIRMAR RECEBIMENTO DE E-MAIL.
                        </strong>
                        </p>
                        <br>
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
                        </p>";

        return $html;
    }

    public function emailNaoEnviado($id)
    {
        $sql = "UPDATE email SET SITUACAO = 'N' WHERE email.idEMAIL = :id;";
        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $id);
        return $p_sql->execute();
    }

}
