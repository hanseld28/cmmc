<?php
    require_once ($_SERVER['DOCUMENT_ROOT']."/cmmc/config/constants.php");

    include_once(ROOT_PATH."/cmmc/templates/header.php"); 

    require_once ($_SERVER['DOCUMENT_ROOT']."/cmmc/controller/ControllerVereador.php");



    $controllerVereador = new ControllerVereador();

    $listaDeVereadores = $controllerVereador->recuperarVereadores();
?>


<div data-tabs>
    <div>Vereadores</div>
    <div>Estatísticas</div>
</div>

<div data-panes>
    <div>
        <table class="pure-table">
            <thead>
                <tr>
                    <th>NOME</th>
                    <th>PROJETOS</th>
                </tr>
            </thead>
            
            <tbody>
        
                <?php foreach($listaDeVereadores as $i => $vereador): ?>
                <tr <?php if($i % 2 == 1) echo "class=\"pure-table-odd\"" ?> >
                    
                    <?php 
                        $url = "projetos-vereador.php?id=".$vereador->getId();
                    ?>
                    
                    <td> <?php echo "<a href=\"#\" title=\"NOME DO VEREADOR\">".$vereador->getNome()."</a>" ?> </td>
                    <td> <?php echo "<a href=\"".$url."\"  title=\"Clique para ir abrir a página de projetos.\">VISUALIZAR</a>" ?> </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    </div>

    <div>
        Vereadores | Quantidade de projetos por status...
    
    </div>
</div>

<?php
    include_once(ROOT_PATH."/cmmc/templates/footer.php"); 
?>