<?php

class Extrator 
{
    private $url;
    private $dom;

    public function __construct($url)
    {
        $this->url = $url;
        $this->dom = new DOMDocument();
    }
    public function getUrl()
    {
        return $this->url;
    }
    public function getDOM()
    {
        return $this->dom;
    }
    private function setDOM($dom)
    {
        $this->dom = $dom;
    }

    public function extrairConteudoDePaginaUnica()
    {
        $conteudoPagina = file_get_contents($this->getUrl());
        @$this->getDOM()->loadHTML($conteudoPagina);
    }

    public function extrairConteudoDePaginaComParametro($numeroPagina)
    {
        $urlCompleta = $this->getUrl().$numeroPagina;
        $conteudoPagina = file_get_contents($urlCompleta);
        @$this->getDOM()->loadHTML($conteudoPagina);
    }
}


?>