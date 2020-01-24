<?php

require_once (ROOT_PATH."/cmmc/model/Extrator.php");
require_once (ROOT_PATH."/cmmc/model/ClassificadorVereadorProjeto.php");
require_once (ROOT_PATH."/cmmc/filtrator/FiltratorVereador.php");

class DAOVereador 
{
    private $listaDeVereadores;

    public function __construct()
    {
        $this->listaDeVereadores = new ArrayObject(); 
    }

    public function carregarVereadores()
    {
        try 
        {            
            $this->buscarListaDeVereadores();
            $this->salvarListaDeVereadoresEmArquivo();
            $this->salvarListaDeVereadoresEmMemoria();
        } 
        catch (\Exception $ex) 
        {
            echo($ex->getMessage());
        }
    }

    private function buscarListaDeVereadores()
    {
        $extrator = new Extrator("http://www.cmmc.com.br/vereadores/index.php");
        $extrator->extrairConteudoDePaginaUnica();

        $filtrador = new FiltratorVereador();
        
        $listaDeVereadores = $filtrador->filtrarConteudoDaPaginaDeVereadores($extrator->getDOM());
        
        $this->percorrerListaEAdicionarIdACadaVereador($listaDeVereadores);
    }

    private function percorrerListaEAdicionarIdACadaVereador(ArrayObject $listaDeVereadores)
    {
        foreach ($listaDeVereadores as $id => $vereador) 
        {
            $vereador->setId(++$id);
            $this->listaDeVereadores->append($vereador);
        } 
    }

    private function salvarListaDeVereadoresEmArquivo()
    {
        file_put_contents(ARQUIVO_VEREADORES, serialize($this->listaDeVereadores));
    }

    private function salvarListaDeVereadoresEmMemoria()
    {
        $this->listaDeVereadores = unserialize(file_get_contents(ARQUIVO_VEREADORES));
    }
    public function recuperarListaDeVereadoresDoArquivo()
    {
        return unserialize(file_get_contents(ARQUIVO_VEREADORES));
    }

    public function classificarProjetosPorVereadores(ArrayObject $vereadores, ArrayObject $projetos)
    {
        $classificadorVereadorProjeto = new ClassificadorVereadorProjeto($vereadores, $projetos);
        
        $this->listaDeVereadores = $classificadorVereadorProjeto->classificarProjetosPorVereadores();
        $this->salvarListaDeVereadoresEmArquivo();
    }

    public function consultarProjetosPeloIdDoVereador($id)
    {
        foreach ($this->listaDeVereadores as $vereador) 
        {
            if($vereador->getId() == $id)
            {
                return $vereador;
            }
        }
    }
    
    public function classificarProjetosDoVereadorPorStatus()
    {
        $listaProjetosDoVereadorPorStatus = new ArrayObject();

        foreach ($this->listaDeVereadores as $vereador)
        {
            $vereador->inicializarQuantidadeProjetos();
            $listaProjetosDoVereadorPorStatus->append($vereador);
        }

        return $listaProjetosDoVereadorPorStatus;
    }

    

}