<?php

class Lista{
    private $idLista;
    
    public function __construct($idLista) {
        $this->idLista = $idLista;
    }
    
    public function getIdLista() {
        return $this->idLista;
    }

    public function setIdLista($idLista) {
        $this->idLista = $idLista;
    }

}


?>