<?php

class ClassificadorVereadorProjeto
{
    private $vereadores;
    private $projetos;

    public function __construct(ArrayObject $vereadores, ArrayObject $projetos)
    {
        $this->vereadores = $vereadores;
        $this->projetos = $projetos;
    }

    public function classificarProjetosPorVereadores()
    {
        $listaDeVereadoresClassificada = new ArrayObject();

        foreach ($this->vereadores as $vereador) 
        {    
            foreach ($this->projetos as $projeto) 
            {
                $stringAutor = $projeto->getAutor();
                if($this->temMaisDeUmAutor($stringAutor))
                {
                    foreach($this->transformarStringAutorEmArray($stringAutor) as $nomeAutor)
                    {
                        $this->atribuirProjetoSeAutorForCorrespondente($vereador, $nomeAutor, $projeto);
                    }
                }
                else
                {
                    $this->atribuirProjetoSeAutorForCorrespondente($vereador, $stringAutor, $projeto);
                }
            }
            $listaDeVereadoresClassificada->append($vereador);
        }       
        return $listaDeVereadoresClassificada; 
    }
    
    public function temMaisDeUmAutor($stringAutor)
    {
        $resultado = preg_match("/(\bE\b|\b,\b)/", $stringAutor);
        
        return ($resultado === true | $resultado === 1 | !is_null($resultado) | !empty($resultado)); 
    }

    public function transformarStringAutorEmArray($stringAutor)
    {
        $autores = preg_split("/(\b E \b|\b , \b)/", $stringAutor);
        return $autores;
    }
    
    public function atribuirProjetoSeAutorForCorrespondente(&$vereador, $nomeAutor, $projeto)
    {
        if($vereador->getNome() == $nomeAutor)  
        {
            $vereador->addProjetoDeLeiOrdinaria($projeto);
        }
    }
}

?>