<?php

class Protesto{
    private $idProtesto;
    private $danfe;
    private $vencimento;
    private $val_org;
    private $dias_dec;
    private $juros;
    private $custas;
    private $custos_fix;
    private $porcentagem_aplicada;
    private $total_final;
    private $atualizado_ate;
    
    public function __construct($idProtesto, $danfe, $vencimento, $val_org, $dias_dec, $juros, $custas, $custos_fix, $porcentagem_aplicada, $total_final, $atualizado_ate) {
        $this->idProtesto = $idProtesto;
        $this->danfe = $danfe;
        $this->vencimento = $vencimento;
        $this->val_org = $val_org;
        $this->dias_dec = $dias_dec;
        $this->juros = $juros;
        $this->custas = $custas;
        $this->custos_fix = $custos_fix;
        $this->porcentagem_aplicada = $porcentagem_aplicada;
        $this->total_final = $total_final;
        $this->atualizado_ate = $atualizado_ate;
    }
    
    public function getIdProtesto() {
        return $this->idProtesto;
    }

    public function getDanfe() {
        return $this->danfe;
    }

    public function getVencimento() {
        return $this->vencimento;
    }

    public function getVal_org() {
        return $this->val_org;
    }

    public function getDias_dec() {
        return $this->dias_dec;
    }

    public function getJuros() {
        return $this->juros;
    }

    public function getCustas() {
        return $this->custas;
    }

    public function getCustos_fix() {
        return $this->custos_fix;
    }

    public function getPorcentagem_aplicada() {
        return $this->porcentagem_aplicada;
    }

    public function getTotal_final() {
        return $this->total_final;
    }

    public function getAtualizado_ate() {
        return $this->atualizado_ate;
    }

    public function setIdProtesto($idProtesto) {
        $this->idProtesto = $idProtesto;
    }

    public function setDanfe($danfe) {
        $this->danfe = $danfe;
    }

    public function setVencimento($vencimento) {
        $this->vencimento = $vencimento;
    }

    public function setVal_org($val_org) {
        $this->val_org = $val_org;
    }

    public function setDias_dec($dias_dec) {
        $this->dias_dec = $dias_dec;
    }

    public function setJuros($juros) {
        $this->juros = $juros;
    }

    public function setCustas($custas) {
        $this->custas = $custas;
    }

    public function setCustos_fix($custos_fix) {
        $this->custos_fix = $custos_fix;
    }

    public function setPorcentagem_aplicada($porcentagem_aplicada) {
        $this->porcentagem_aplicada = $porcentagem_aplicada;
    }

    public function setTotal_final($total_final) {
        $this->total_final = $total_final;
    }

    public function setAtualizado_ate($atualizado_ate) {
        $this->atualizado_ate = $atualizado_ate;
    }
}

?>