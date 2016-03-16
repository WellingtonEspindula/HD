<?php

class Host{
    private $idHost;
    private $nome;
    private $email;
    private $senha;
    
    public function getIdHost() {
        return $this->idHost;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setIdHost($idHost) {
        $this->idHost = $idHost;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }



    
}

?>
