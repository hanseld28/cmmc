<?php

require_once (ROOT_PATH."/cmmc/model/ProjetoDeLeiOrdinaria.php");

class Vereador
{
    private $id;
    private $nome;
    private $projetosDeLeiOrdinaria;

    public function __construct($nome){
        $this->nome = $nome;
        $this->projetosDeLeiOrdinaria = new ArrayObject();
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {   
        $this->id = $id;
    }
    public function getNome() 
    {
        return $this->nome;
    }
    public function addProjetoDeLeiOrdinaria(ProjetoDeLeiOrdinaria $projetoDeLeiOrdinaria)
    {
        $this->projetosDeLeiOrdinaria->append($projetoDeLeiOrdinaria);
    }
    public function getProjetosDeLeiOrdinaria()
    {
        return $this->projetosDeLeiOrdinaria;
    }

    
}

?>