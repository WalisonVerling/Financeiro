<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';

    $objDAO = new CategoriaDAO();

    if(isset($_GET['cod']) && is_numeric($_GET['cod'])){
        $idCategoria = $_GET['cod'];
        $dados = $objDAO->DetalharCategoria($idCategoria);

        if(count($dados) == 0){
            header('location: consultar_categoria.php');
            exit;
        }
    }else if(isset($_POST['BtnSalvar'])){
        $idCategoria = $_POST['cod'];
        $nomecategoria = $_POST['nomecategoria'];

        $retorno = $objDAO->AlterarCategoria($nomecategoria, $idCategoria);

        header('location: consultar_categoria.php?retorno='. $retorno);
        exit;
    }else if(isset($_POST['BtnExcluir'])){
        $idCategoria = $_POST['cod'];
        $retorno = $objDAO->ExcluirCategoria($idCategoria);

        header('location: consultar_categoria.php?retorno='. $retorno);
        exit;
    }else{
        header('location: consultar_categoria.php');
        exit;
    }

    // echo '<pre>';
    // var_dump($dados);
    // echo '</pre>';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php include_once '_head.php'; ?>
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
                        <h2>Alterar Categoria</h2>
                        <h5>Aqui você poderá alterar ou exlcuir suas categorias. </h5>
                    </div>
                </div>
                <hr />
                <form action="alterar_categoria.php" method="POST">
                    <!-- Este input valida, fixa o id_categoria na pagina alteração, mesmo sendo violada na URL, mante a integridade do item a ser alterado ou excluido -->
                    <!-- Despejar o id_categoria no arquivo, para realizar a tarefa de alterar ou excluir! -->
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria'] ?>">
                    <div class="form-group">
                        <label>Nome da Categoria</label>
                        <input class="form-control" placeholder="Digite o nome da categoria. Exemplo: Conta de Luz" name="nomecategoria" id="nomecategoria" value="<?= $dados[0]['nome_categoria'] ?>" />
                    </div>

                    <button type="submit" class="btn btn-success" name="BtnSalvar">Salvar</button>
                    <!-- <button class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir">Excluir</button> -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir">Excluir</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão!</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a Categoria: <b><?= $dados[0]['nome_categoria'] ?>?</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="BtnExcluir" class="btn btn-primary">Sim</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>