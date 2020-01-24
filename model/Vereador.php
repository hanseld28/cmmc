<?php

require_once (ROOT_PATH."/cmmc/model/ProjetoDeLeiOrdinaria.php");
require_once (ROOT_PATH."/cmmc/model/QuantidadeProjetos.php");

class Vereador
{
    private $id;
    private $nome;
    private $projetosDeLeiOrdinaria;
    private $quantidadeProjetos;

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
    
    private function projetoJaExisteNaLista(ProjetoDeLeiOrdinaria $projetoAVerificar)
    {
        $existe = false;
        
        if(!(empty($this->projetosDeLeiOrdinaria)))
        {
            foreach ($this->projetosDeLeiOrdinaria as $projetoDaLista)
            {
                if($projetoAVerificar->getAssunto() === $projetoDaLista->getAssunto())   
                {
                    $existe = true;
                }
            }
        }
        return $existe;    
    }

    public function addProjetoDeLeiOrdinaria(ProjetoDeLeiOrdinaria $projetoDeLeiOrdinaria)
    {
        if(!($this->projetoJaExisteNaLista($projetoDeLeiOrdinaria)))
        {
            $this->projetosDeLeiOrdinaria->append($projetoDeLeiOrdinaria);
        }
    }
    public function getProjetosDeLeiOrdinaria()
    {
        return $this->projetosDeLeiOrdinaria;
    }

    public function getQuantidadeProjetos()
    {
        if(empty($this->quantidadeProjetos))
        {
            $this->inicializarQuantidadeProjetos();
        }
        return $this->quantidadeProjetos;
    }
    public function inicializarQuantidadeProjetos()
    {
        $this->quantidadeProjetos = new QuantidadeProjetos($this->getProjetosDeLeiOrdinaria());
    }
    
}

?>