<?php

    if(!defined('ARQUIVO_PROJETO_LO') && !defined('ARQUIVO_VEREADORES') && !defined('DOCUMENT_ROOT'))
    {
        define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
        define('ARQUIVO_PROJETO_LO', ROOT_PATH."/cmmc/content/projetos-de-lei-ordinaria.txt");
        define('ARQUIVO_VEREADORES', ROOT_PATH."/cmmc/content/vereadores.txt");    
    }
        
?>