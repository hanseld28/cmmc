<?php

require_once ROOT_PATH . '/model/Extrator.php';
require_once ROOT_PATH . '/model/FiltradorDeProjetos.php';

class ControllerProjetoDeLeiOrdinaria 
{
    public static function buscarTodos()
    {
        $projetos = new ArrayObject();

        for($numeroPagina = 0; $numeroPagina < 14; $numeroPagina++)
        {
            $extrator = new Extrator("http://www.cmmc.com.br/projetos/plo.php?pg=");

            $extrator->extrairConteudoDePaginaComParametro($numeroPagina);

            $filtrador = new Filtrador();

            $projetos->append($filtrador->filtrarConteudoDaPaginaDeProjetosLO($extrator->getDOM()));
        }
        return $projetos;
    }
}

?>