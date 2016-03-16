<?php

require_once 'EmailBoletoAtualizado.php';

class AnexoEmailBoletoAtualizado {

    private $id;
    private $arquivo;
    private $emailBoletoAtualizado;

    public function getId() {
        return $this->id;
    }

    public function getArquivo() {
        return $this->arquivo;
    }

    public function getEmailBoletoAtualizado() {
        return $this->emailBoletoAtualizado;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setArquivo($arquivo) {
        $this->arquivo = $arquivo;
    }

    public function setEmailBoletoAtualizado(EmailBoletoAtualizado $emailBoletoAtualizado) {
        $this->emailBoletoAtualizado = $emailBoletoAtualizado;
    }

}
?>
