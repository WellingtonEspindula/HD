<?php

include_once 'email.php';

class EmailBoletoAtualizado extends Email{
    private $numeroNota;
    private $vencimento;
    
    public function __construct() {
    }

    public function getNumeroNota() {
        return $this->numeroNota;
    }

    public function getVencimento() {
        return $this->vencimento;
    }

    public function setNumeroNota($numeroNota) {
        $this->numeroNota = $numeroNota;
    }

    public function setVencimento($vencimento) {
        $this->vencimento = $vencimento;
    }

    public function __toString() {
        return $this->getIdEmail();
    }

}
?>