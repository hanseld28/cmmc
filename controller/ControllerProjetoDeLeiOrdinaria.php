<?php

require_once (ROOT_PATH."/cmmc/dao/DAOProjetoDeLeiOrdinaria.php");

class ControllerProjetoDeLeiOrdinaria 
{
    private $daoProjetoDeLeiOrdinaria;

    public function __construct()
    {
        $this->daoProjetoDeLeiOrdinaria = new DAOProjetoDeLeiOrdinaria();
    }

    private function carregarProjetosDeLeiOrdinaria()
    {
        $this->daoProjetoDeLeiOrdinaria->carregarProjetosDeLeiOrdinaria();
    }

    public function recuperarProjetosDeLeiOrdinaria()
    {
        if(!file_exists(ARQUIVO_PROJETO_LO))
        {
            $this->carregarProjetosDeLeiOrdinaria();
        }
        return $this->daoProjetoDeLeiOrdinaria->recuperarListaDeProjetosDoArquivo();
    }

}

?>