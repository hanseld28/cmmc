<!DOCTYPE html>
<?php 
    define('ROOT_PATH', dirname(__FILE__));

    include_once ROOT_PATH . '/controller/ControllerProjetoDeLeiOrdinaria.php'; 
        
    $projetos = ControllerProjetoDeLeiOrdinaria::buscarTodos();

    $quantidadeProjetosPorPagina = 12;
    $atual                       = (isset($_GET['pg'])) ? intval($_GET['pg']) : 1;
    $quantidadePaginas           = 14;
    $paginaProjetos              = $projetos->offSetGet($atual - 1);
?>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
	<title>CMMC - Vereadores e Projeto de Lei Ordinária</title>

    <link href="css/style.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <script async src="js/tabbis.js"></script>
    <script async src="js/script.js"></script>
</head>


<body>
    <header>
        <img alt="logo" src="http://www.cmmc.com.br/logo.jpg">   
    </header>
    
    <div data-tabs id="abas">
        <div>Projetos de Lei Ordinária</div>
        <div>Vereadores</div>
    </div>

    <div data-panes>
		<div>
            <table class="pure-table">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>AUTOR</th>
                        <th>ASSUNTO</th>
                        <th>ANOTAÇÃO</th>
                    </tr>
                </thead>
                
                <tbody>
            
                    <?php foreach($paginaProjetos as $i => $projeto): ?>
                    <tr <?php if($i % 2 == 1) echo "class=\"pure-table-odd\"" ?> >
                    
                        <td> <?php echo "<a href=\"".$projeto->getAnexo()."\" title=\"Clique para abrir o anexo.\" target=\"_blank\">".$projeto->getNumeroLei()."</a>" ?> </td>
                        <td> <?php echo "<a href=\"".$projeto->getAnexo()."\" title=\"Clique para abrir o anexo.\" target=\"_blank\">".$projeto->getAutor()."</a>" ?> </td>
                        <td> <?php echo "<a href=\"".$projeto->getAnexo()."\" title=\"Clique para abrir o anexo.\" target=\"_blank\">".$projeto->getAssunto()."</a>" ?> </td>
                        <td> <?php echo "<a href=\"".$projeto->getAnexo()."\" title=\"Clique para abrir o anexo.\" target=\"_blank\">".$projeto->getStatus()."</a>" ?> </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="paginacao">
            <?php  
                for($i = 1; $i < $quantidadePaginas; $i++):
                    if($i ==  $atual):
                        echo "<a href='#'>[".$i."]  ";
                    else:
                        echo "<a href='?pg=".$i."'>".$i."   </a>";
                    endif;
                endfor;
            ?>
            </div>
        </div>
		<div>Vereadores | Quantidade de projetos por status...</div>
	</div>

    
</body>
</html>
