<?php

class ProjetoDeLeiOrdinaria
{
    private $id;
    private $numeroLei;
    private $autor;
    private $assunto;
    private $status; 
    private $anexo;

    public function __construct($numeroLei, $autor, $assunto, $status, $anexo)
    {
        $this->numeroLei = $numeroLei;
        $this->autor     = $autor;
        $this->assunto   = $assunto;
        $this->status    = $status;
        $this->anexo     = $anexo;
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {   
        $this->id = $id;
    }
    public function getNumeroLei()
    {
        return $this->numeroLei;
    }
    public function getAutor()
    {
        return $this->autor;
    }
    public function getAssunto()
    {
        return $this->assunto;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getAnexo()
    {
        return $this->anexo;
    }
        
}

?>