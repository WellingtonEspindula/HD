<?php

require_once 'EmailCotacao.php';

class Cotacao {

    private $idCotacao;
    private $nome_empresa;
    private $cnpj;
    private $cidade;
    private $volume;
    private $litros;
    private $valor_nota_fiscal_e;
    private $frete;
    private $email;

    public function getEmail() {
        return $this->email;
    }

    public function getIdCotacao()
    {
        return $this->idCotacao;
    }

    public function setIdCotacao($idCotacao)
    {
        $this->idCotacao = $idCotacao;
    }

    public function setEmail(EmailCotacao $email) {
        $this->email = $email;
    }

    public function getNome_empresa() {
        return $this->nome_empresa;
    }

    public function getCnpj() {
        return $this->cnpj;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getVolume() {
        return $this->volume;
    }

    public function getLitros() {
        return $this->litros;
    }

    public function getValor_nota_fiscal_e() {
        return $this->valor_nota_fiscal_e;
    }

    public function getFrete() {
        return $this->frete;
    }

    public function setNome_empresa($nome_empresa) {
        $this->nome_empresa = $nome_empresa;
    }

    public function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setVolume($volume) {
        $this->volume = $volume;
    }

    public function setLitros($litros) {
        $this->litros = $litros;
    }

    public function setValor_nota_fiscal_e($valor_nota_fiscal_e) {
        $this->valor_nota_fiscal_e = $valor_nota_fiscal_e;
    }

    public function setFrete($frete) {
        $this->frete = $frete;
    }


}
