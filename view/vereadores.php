<?php
    require_once ($_SERVER['DOCUMENT_ROOT']."/cmmc/config/constants.php");

    include_once(ROOT_PATH."/cmmc/templates/header.php"); 

    require_once ($_SERVER['DOCUMENT_ROOT']."/cmmc/controller/ControllerVereador.php");



    $controllerVereador = new ControllerVereador();

    $listaDeVereadores = $controllerVereador->recuperarVereadores();
    $listaDeProjetosDoVereadorPorStatus = $controllerVereador->classificarProjetosDoVereadorPorStatus();
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
        <div class="pure-g">
            <div class="pure-u-24-24" style="margin-top: -5px; padding: 10px 15px 15px 0px;">
                <h2>Quantidade de projetos de cada vereador por status</h2>
            </div>
        </div>

        
         <table class="pure-table">
            <thead>
                <tr>
                    <th>NOME DO VEREADOR</th>
                    <th>APROVADO</th>
                    <th>EM TRÂMITE</th>
                    <th>RECUSADO</th>
                    <th>POR LEI</th>
                    <th>RETIRADO PELO AUTOR</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            
            <tbody>
        
                <?php foreach($listaDeProjetosDoVereadorPorStatus as $i => $vereador): ?>
                <tr <?php if($i % 2 == 1) echo "class=\"pure-table-odd\"" ?> >
                    
                    <td title="NOME DO VEREADOR"> <?php echo $vereador->getNome()              ?>   </td>
                    <td title="APROVADOS"> <?php echo $vereador->getQuantidadeProjetos()->getAprovado()          ?>   </td>
                    <td title="EM TRÂMITE"> <?php echo $vereador->getQuantidadeProjetos()->getEmTramite()         ?>   </td>
                    <td title="RECUSADOS"> <?php echo $vereador->getQuantidadeProjetos()->getRecusado()          ?>   </td>
                    <td title="POR LEIS"> <?php echo $vereador->getQuantidadeProjetos()->getPorLei()            ?>   </td>
                    <td title="RETIRADO PELO AUTOR"> <?php echo $vereador->getQuantidadeProjetos()->getRetiradoPeloAutor() ?>   </td>
                    <td title="QUANTIDADE TOTAL"> <?php echo $vereador->getQuantidadeProjetos()->getTotal()             ?>   </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>

<?php
    include_once(ROOT_PATH."/cmmc/templates/footer.php"); 
?>