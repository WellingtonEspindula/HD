<?php

require_once 'email.php';

class EmailCotacao extends Email
{

    private $tranportadora;
    private $cotacoes;


    public function getTranportadora()
    {
        return $this->tranportadora;
    }

    public function setTranportadora($tranportadora)
    {
        $this->tranportadora = $tranportadora;
    }

    public function setCotacoes(ArrayObject $cotacoes)
    {
        $this->cotacoes = $cotacoes;
    }

    public function getCotacoes()
    {
        return $this->cotacoes;
    }

}


?>
