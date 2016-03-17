<?php

class Email {
    private $idEmail;
    private $destinatario;
    private $horario;
    private $host;
    private $situacao;
    private $type;


    public function __construct() {
    }


    public function getSituacao()
    {
        return $this->situacao;
    }

    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }

    public function getIdEmail() {
        return $this->idEmail;
    }

    public function getDestinatario() {
        return $this->destinatario;
    }

    public function getHorario() {
        return $this->horario;
    }

    public function getHost() {
        return $this->host;
    }

    public function setIdEmail($idEmail) {
        $this->idEmail = $idEmail;
    }

    public function setDestinatario($destinatario) {
        $this->destinatario = $destinatario;
    }

    public function setHorario($horario) {
        $this->horario = $horario;
    }

    public function setHost(Host $host) {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }



}
