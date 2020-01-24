<?php

require_once (ROOT_PATH."/cmmc/dao/DAOVereador.php");
require_once (ROOT_PATH."/cmmc/controller/ControllerProjetoDeLeiOrdinaria.php");


class ControllerVereador 
{
    private $daoVereador;

    public function __construct()
    {
        $this->daoVereador = new DAOVereador();
        $this->classificarProjetosPorVereadores();
    }

    private function carregarVereadores()
    {
        $this->daoVereador->carregarVereadores();
    }

    public function recuperarVereadores()
    {
        if(!file_exists(ARQUIVO_VEREADORES))
        {
            $this->carregarVereadores();
        }
        
        return $this->daoVereador->recuperarListaDeVereadoresDoArquivo();
    }

    private function classificarProjetosPorVereadores()
    {
        $controllerProjetoLO = new ControllerProjetoDeLeiOrdinaria();
        $projetos = $controllerProjetoLO->recuperarProjetosDeLeiOrdinaria();
        $vereadores = $this->recuperarVereadores();
        
        $this->daoVereador->classificarProjetosPorVereadores($vereadores, $projetos);
    }

    public function consultarProjetosPeloIdDoVereador($id)
    {
        return $this->daoVereador->consultarProjetosPeloIdDoVereador($id);
    }

    public function classificarProjetosDoVereadorPorStatus()
    {
        return $this->daoVereador->classificarProjetosDoVereadorPorStatus();
    }
}

?>