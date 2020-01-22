<?php

class ProjetoDeLeiOrdinaria
{
    private $numeroLei;
    private $autor; 
    private $assunto;
    private $status; 
    private $anexo;

    public function __construct($numeroLei, $autor, $assunto, $status, $anexo)
    {
        $this->numeroLei = $numeroLei;
        $this->autor = $autor;
        $this->assunto = $assunto;
        $this->status = $status;
        $this->anexo = $anexo;
    }

    public function getNumeroLei()
    {
        return $this->numeroLei;
    }
    public function getAutor()
    {
        return $this->autor;
    }
    public function getAssunto()
    {
        return $this->assunto;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getAnexo()
    {
        return $this->anexo;
    }
    
    
}

/*
$prj1 = new ProjetoDeLeiOrdinaria("23/12", "antonio", "temasdas", "Aprovado", "www.sada.csaas/asdsa/dswssd.pdf");
$prj2 = new ProjetoDeLeiOrdinaria("23/12", "antonio", "temasdas", "Aprovado", "www.sada.csaas/asdsa/dswssd.pdf");
$prj3 = new ProjetoDeLeiOrdinaria("23/12", "antonio", "temasdas", "Aprovado", "www.sada.csaas/asdsa/dswssd.pdf");

$projetos = [];
$projetosPagina = [];
$projetosPagina2 = [];
$projetosPagina3 = [];

$projetosPagina[] = $prj1; 
$projetosPagina[] = $prj2;
$projetosPagina[] = $prj3;
$projetosPagina[] = $prj1; 
$projetosPagina[] = $prj2;
$projetosPagina[] = $prj3;


$projetosPagina2[] = $prj1; 
$projetosPagina2[] = $prj2;
$projetosPagina2[] = $prj3;
$projetosPagina2[] = $prj1; 
$projetosPagina2[] = $prj2;
$projetosPagina2[] = $prj3;


$projetosPagina3[] = $prj1; 
$projetosPagina3[] = $prj2;
$projetosPagina3[] = $prj3;
$projetosPagina3[] = $prj1; 
$projetosPagina3[] = $prj2;
$projetosPagina3[] = $prj3;

$projetos[] = $projetosPagina;
$projetos[] = $projetosPagina2;
$projetos[] = $projetosPagina3;

echo var_dump($projetos);
*/
?>