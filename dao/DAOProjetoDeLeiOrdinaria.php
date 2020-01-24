<?php

require_once (ROOT_PATH."/cmmc/model/Extrator.php");
require_once (ROOT_PATH."/cmmc/filtrator/FiltratorProjeto.php");

class DAOProjetoDeLeiOrdinaria 
{
    private $listaDeProjetosDeLeiOrdinaria;

    public function __construct()
    {
        $this->listaDeProjetosDeLeiOrdinaria = new ArrayObject(); 
    }

    public function carregarProjetosDeLeiOrdinaria()
    {
        try 
        {
            $this->carregarPaginasDeProjetosEAdicionarNaLista();
            $this->percorrerListaEAdicionarIdACadaProjeto();
            $this->salvarListaDeProjetosEmArquivo();
            $this->salvarListaDeProjetosEmMemoria();
        } 
        catch (\Exception $ex) 
        {
            echo($ex->getMessage());
        }
    }

    private function percorrerPaginaEAdicionarUmProjetoDeCadaVez(ArrayObject $paginaProjetos)
    {
        foreach ($paginaProjetos as $projeto) {
            $this->listaDeProjetosDeLeiOrdinaria->append($projeto);
        }
    }

    private function carregarPaginasDeProjetosEAdicionarNaLista()
    {
        for($numeroPagina = 0; $numeroPagina < 14; $numeroPagina++)
        {
            $extrator = new Extrator("http://www.cmmc.com.br/projetos/plo.php?pg=");
            $extrator->extrairConteudoDePaginaComParametro($numeroPagina);

            $filtrador = new FiltratorProjeto();
            $paginaProjetos = $filtrador->filtrarConteudoDaPaginaDeProjetosLO($extrator->getDOM());

            $this->percorrerPaginaEAdicionarUmProjetoDeCadaVez($paginaProjetos);
        }
    }

    private function percorrerListaEAdicionarIdACadaProjeto()
    {
        $listaAuxiliar = new ArrayObject();

        foreach ($this->listaDeProjetosDeLeiOrdinaria as $id => $projeto) 
        {
            $projeto->setId(++$id);
            $listaAuxiliar->append($projeto);
        }
        $this->listaDeProjetosDeLeiOrdinaria = $listaAuxiliar;
    }

    private function salvarListaDeProjetosEmArquivo()
    {
        file_put_contents(ARQUIVO_PROJETO_LO, serialize($this->listaDeProjetosDeLeiOrdinaria));
    }

    private function salvarListaDeProjetosEmMemoria()
    {
        $this->listaDeProjetosDeLeiOrdinaria = unserialize(file_get_contents(ARQUIVO_PROJETO_LO));
    }
    public function recuperarListaDeProjetosDoArquivo()
    {
        return unserialize(file_get_contents(ARQUIVO_PROJETO_LO));
    }

}