<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';

    if(isset($_POST['BtnSalvar'])){
        $nome = ltrim(trim($_POST['nome']));

        $objdao = new CategoriaDAO();
        $retorno = $objdao->CadastrarCategoria($nome);
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
    include_once '_head.php'
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
                    <?php include_once '_msg.php' ?>
                        <h2>Nova Categoria</h2>
                        <h5>Aqui você poderá cadastrar todas as suas categorias. </h5>
                    </div>
                </div>
                <hr />
                <form action="nova_categoria.php" method="POST">
                    <div class="form-group">
                        <label>Nome da Categoria:</label>
                        <input class="form-control" type="text" placeholder="Digite o nome da categoria. Exemplo: Conta de Luz" name="nome" id="nomecategoria" value="<?= isset($nome) ? $nome : '' ?>"/>
                    </div>
                    <button onclick="return ValidarCategoria()" class="btn btn-success" name="BtnSalvar">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>