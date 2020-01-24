<?php

class QuantidadeProjetos
{   
    private $aprovado;
    private $emTramite;
    private $recusado;
    private $porLei;
    private $retiradoPeloAutor;
    const STATUS = ["Aprovado", "Em trâmite", "Recusado", "Lei", "Retirado pelo autor"];

    public function __construct(ArrayObject $projetos)
    {
        $this->aprovado = 0;
        $this->emTramite = 0;
        $this->recusado = 0;
        $this->porLei = 0;
        $this->retiradoPeloAutor = 0;
        
        $this->calcularQuantidade($projetos);
    }

    private function calcularQuantidade(ArrayObject $projetos) 
    {
        if(!empty($projetos))
        {
            foreach ($projetos as $projeto) 
            {
                $statusProjeto = $projeto->getStatus();
                
                for($i = 0; $i < count(self::STATUS); $i++)
                {            
                    if($this->statusProjetoEIgualAEsteStatus($statusProjeto, self::STATUS[$i]))
                    {
                        $this->verificarStatusECalcularParaPropriedade(self::STATUS[$i]);
                    }
                }
            }
        }
    }

    public function getAprovado()
    {
        return $this->aprovado;
    }
    public function getEmTramite()
    {
        return $this->emTramite;
    }
    public function getRecusado()
    {
        return $this->recusado;
    }
    public function getPorLei()
    {
        return $this->porLei;
    }
    public function getRetiradoPeloAutor()
    {
        return $this->retiradoPeloAutor;
    }
    public function getTotal()
    {
        return ($this->getAprovado() + $this->getEmTramite()
              + $this->getRecusado() + $this->getPorLei()
              + $this->getRetiradoPeloAutor());
    }

    private function incrementarPropriedade(&$propriedade)
    {
        $propriedade++;
    }

    private function statusProjetoEIgualAEsteStatus(string $statusProjeto, string $status)
    {
        $padrao = "/(\b".$status."\b)/";
        $resultado = preg_match($padrao, $statusProjeto);

        return ($resultado === 1);        
    }
    
    private function verificarStatusECalcularParaPropriedade($status)
    {
        switch ($status) {
            case 'Aprovado':
                $this->incrementarPropriedade($this->aprovado);
                break;
            case 'Em trâmite':
                $this->incrementarPropriedade($this->emTramite);
                break;
            case 'Recusado':
                $this->incrementarPropriedade($this->recusado);
                break;
            case 'Lei':
                $this->incrementarPropriedade($this->porLei);
                break;
            case 'Retirado pelo autor':
                $this->incrementarPropriedade($this->retiradoPeloAutor);
                break;
        }
    }
}


?>