<?php
    require_once ($_SERVER['DOCUMENT_ROOT']."/cmmc/config/constants.php");
    require_once (ROOT_PATH."/cmmc/controller/ControllerVereador.php");
    
    include_once(ROOT_PATH."/cmmc/templates/header.php");

    $idVereador = isset($_GET['id']) ? intval($_GET['id']) : null;  
?>

    <div data-tabs>    
        <a href="vereadores.php">Voltar</a> 
    </div>
    <div data-panes>
        <div>
            <?php    
                if(!empty($idVereador)):
                    $controllerVereador = new ControllerVereador();
                    $vereador = $controllerVereador->consultarProjetosPeloIdDoVereador($idVereador);        

                    if(!empty($vereador)):
                        $projetosDoVereador = $vereador->getProjetosDeLeiOrdinaria();
            ?>            
                            <div class="pure-g">
                                <div class="pure-u-24-24" style="margin-top: -5px; ">
                                    <h2>Projetos de Lei Ordinária propostos ou com participação do vereador</h2>
                                </div>
                                <div class="pure-u-3-5" style="margin-top: 15px; padding: 10px 15px 15px 0px;">
                                    <h4>NOME: <?php echo $vereador->getNome(); ?></h4>
                                </div>
                            </div>

                            <?php if($projetosDoVereador->count() > 0): ?>

                                <table class="pure-table">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>AUTOR(ES)</th>
                                            <th>ASSUNTO</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php foreach($projetosDoVereador as $i => $projeto): ?>
                                        <tr <?php if($i % 2 == 1) echo "class=\"pure-table-odd\"" ?> >
                                        
                                            <td> <?php echo "<a href=\"".$projeto->getAnexo()."\" title=\"Clique para abrir o anexo.\" target=\"_blank\">".$projeto->getNumeroLei()."</a>" ?> </td>
                                            <td> <?php echo "<a href=\"".$projeto->getAnexo()."\" title=\"Clique para abrir o anexo.\" target=\"_blank\">".$projeto->getAutor()."</a>" ?> </td>
                                            <td> <?php echo "<a href=\"".$projeto->getAnexo()."\" title=\"Clique para abrir o anexo.\" target=\"_blank\">".$projeto->getAssunto()."</a>" ?> </td>
                                            <td> <?php echo "<a href=\"".$projeto->getAnexo()."\" title=\"Clique para abrir o anexo.\" target=\"_blank\">".$projeto->getStatus()."</a>" ?> </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
            <?php           
                        else: echo("<p>Este vereador ainda não prôpos nenhum projeto...</p>"); endif;

                    else: echo("<p>Vereador não encontrado...</p>"); endif;

                else: echo("<p>Vereador não encontrado...</p>"); endif; 
            ?>
         </div>    
        </div>



<?php
    include_once(ROOT_PATH."/cmmc/templates/footer.php"); 
?>

