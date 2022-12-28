<?php
    require_once '../DAO/UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once '../DAO/MovimentoDAO.php';

    $objDAO = new MovimentoDAO();

    $total_entrada = $objDAO->TotalEntrada();
    $total_saida = $objDAO->TotalSaida();
    $movs = $objDAO->MostrarUltimosLancamentos();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once 
'_head.php' 
?>
<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <!--Conteudo visto pelo usuário-->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Olá <?= UtilDAO::NomeLogado() ?>, este é seu Sistema de Controle Financeiro.</h2>
                        <h5>Aqui você podera utilizar todos os Módulos disponiveis no MENU a esquerda.</h5>
                        <h5>Veja logo abaixo, o seu relatório geral:</h5>
                    </div>
                </div>
                <hr />
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder bg-color-green">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3>R$ <?= $total_entrada[0]['Total'] != '' ? number_format($total_entrada[0]['Total'], 2, ',', '.') : '0' ?></h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                            TOTAL DE ENTRADA
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder bg-color-red">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3>R$ <?= $total_saida[0]['Total'] != '' ? number_format($total_saida[0]['Total'], 2, ',', '.') : '0' ?></h3>
                        </div>
                        <div class="panel-footer back-footer-red">
                            TOTAL DE SAÍDA
                        </div>
                    </div>
                </div>
                <hr>
                <?php if(count($movs) > 0){ ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Últimos 10 lançamentos de Movimento:
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Tipo</th>
                                                    <th>Categoria</th>
                                                    <th>Empresa</th>
                                                    <th>Conta</th>
                                                    <th>Valor</th>
                                                    <th>Observação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                // O Motivo da Variável TOTAL, é somar todos os valores encontrados pelo ARRAY MOVS
                                                // Desta forma ele sempre ira somar os valores adicionadaos em cada posição do ARRAY
                                                $total = 0;
                                                for($i=0; $i<count($movs); $i++){ 
                                                    if($movs[$i]['tipo_movimento'] == 1){
                                                        $total = $total + $movs[$i]['valor_movimento'];
                                                    }else{
                                                        $total = $total - $movs[$i]['valor_movimento'];
                                                    }
                                            ?>
                                                <tr class="odd gradeX">
                                                    <th><?= $movs[$i]['data_movimento'] ?></th>
                                                    <th><?= $movs[$i]['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?></th>
                                                    <th><?= $movs[$i]['nome_categoria'] ?></th>
                                                    <th><?= $movs[$i]['nome_empresa'] ?></th>
                                                    <th><?= $movs[$i]['banco_conta'] ?> / <?= $movs[$i]['agencia_conta'] ?> - <?= $movs[$i]['numero_conta'] ?></th>
                                                    <th>R$ <?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?></th>
                                                    <th><?= $movs[$i]['obs_movimento'] ?></th>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                        <center>
                                            <label style="color: <?= $total < 0 ? 'red' : 'green' ?>;"><b>TOTAL: </b>R$ <?= number_format($total, 2, ',', '.'); ?></label>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }else{ ?>    
                    <div class="alert alert-info col-md-12">
                        <center>Não existe nenhum Movimento para ser exibido!</center>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>