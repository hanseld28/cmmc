<?php

require_once ROOT_PATH . '/model/ProjetoDeLeiOrdinaria.php';

class Filtrador
{

    public function filtrarConteudoDaPaginaDeProjetosLO(\DOMDocument $dom)
    {       
        $domXPath = new DOMXPath($dom);
        
        $tabelasEncontradas = $domXPath->query("//table[@class=\"tabelaPadrao\"]");
        
        $corpoTabela = $domXPath->query(".//tbody", $tabelasEncontradas->item(0));
        
        $linhasTabela = $domXPath->query(".//tr", $corpoTabela->item(0));   
        
        return $this->filtrarDadosNaTabelaDeProjetosLO($linhasTabela, $domXPath);
    }
    
    
    private function filtrarDadosNaTabelaDeProjetosLO(\DOMNodeList $linhasTabela, \DOMXPath $domXPath)
    {    
        $listaProjetosVazia = true;
        $projetos = new ArrayObject();

        foreach ($linhasTabela as $linha) 
        {
            $elementoEncontrado = $domXPath->query(".//td/font/a", $linha);
            
            if ($elementoEncontrado != null) 
            {   
                if ($elementoEncontrado->item(0) != null && $elementoEncontrado->item(0)->nodeValue != 'Nº') 
                {
                    $numeroLei = trim($elementoEncontrado->item(0)->nodeValue);
                    $autor = trim($elementoEncontrado->item(1)->nodeValue);
                    $assunto = trim($elementoEncontrado->item(2)->nodeValue);
                    $status = trim($elementoEncontrado->item(3)->nodeValue);
                    $anexo = trim($elementoEncontrado->item(0)->getAttribute("href"));
                    
                    $projeto = new ProjetoDeLeiOrdinaria($numeroLei, $autor, $assunto, $status, $anexo);

                    if($listaProjetosVazia) 
                    {
                        $projetos->append($projeto);
                        $listaProjetosVazia = false;
                    }
                    else if ($assunto != $projetos->offsetGet($projetos->count() - 1)->getAssunto()) 
                    {
                        $projetos->append($projeto);
                    }
                }

            }
            
        }
        return $projetos;
    }

    
}

?>