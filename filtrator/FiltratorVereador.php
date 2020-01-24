<?php

require_once (ROOT_PATH."/cmmc/model/Vereador.php");

class FiltratorVereador
{

    public function filtrarConteudoDaPaginaDeVereadores(\DOMDocument $dom)
    {       
        $domXPath = new DOMXPath($dom);
        $elementosEncontrados = $domXPath->query("//p[@class=\"style74\"]");
        
        return $this->criarListaDeVereadores($elementosEncontrados);
    }
    
    private function criarListaDeVereadores(\DOMNodeList $elementosEncontrados)
    {   
        $vereadores = new ArrayObject();

        foreach($elementosEncontrados as $elemento){
            $nome = trim($elemento->textContent);
            $vereadores->append(new Vereador($nome));
        }   
        return $vereadores;
    }
}