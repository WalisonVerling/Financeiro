<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/ContaDAO.php';

    $objDAO = new ContaDAO();
    $conta = $objDAO->ConsultarConta();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include_once '_head.php';
    ?>
</head>
<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php'; ?>
                        <h2>Consultar Conta</h2>
                        <h5>Consulte todas as suas contas aqui. </h5>
                    </div>
                </div>
                <hr />
          <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Contas cadastradas. Caso deseje alterar, clique no botão.
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Banco</th>
                                            <th>Agencia</th>
                                            <th>Número da Conta</th>
                                            <th>Saldo</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($conta as $ct){ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $ct['banco_conta']?></td>
                                            <td><?= $ct['agencia_conta']?></td>
                                            <td><?= $ct['numero_conta']?></td>
                                            <td><?= $ct['saldo_conta']?></td>
                                            <td>
                                                <a href="alterar_conta.php?cod=<?= $ct['id_conta']?>" class="btn btn-warning btn-sm">Alterar</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>