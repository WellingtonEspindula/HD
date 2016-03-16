<?php

include_once 'email.php';

class EmailProtesto extends Email{
    private $lista;
    
    public function __construct($lista) {
        $this->lista = $lista;
    }
    
    public function getLista() {
        return $this->lista;
    }

    public function setLista($lista) {
        $this->lista = $lista;
    }

}

?>
