<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';

    $objDAO = new CategoriaDAO();
    $categoria = $objDAO->ConsultarCategoria();

     /* echo '<pre>';
    print_r($categoria);
    echo '</pre>'; */ 

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
                        <h2>Consultar Categoria</h2>
                        <h5>Consulte todas as suas categorias aqui. </h5>
                    </div>
                </div>
                <hr />
          <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Categorias cadastradas. Caso deseje alterar, clique no botão.
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nome da Categoria</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php for($i=0; $i < count($categoria); $i++){ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $categoria[$i]['nome_categoria']?>
                                            </td>
                                            <td>
                                                <a href="alterar_categoria.php?cod=<?= $categoria[$i]['id_categoria'] ?>" class="btn btn-warning btn-sm">Alterar</a>
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