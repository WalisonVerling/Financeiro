<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/UsuarioDAO.php';

$objDAO = new UsuarioDAO();

if (isset($_POST['BtnSalvar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $retorno = $objDAO->GravarMeusDados($nome, $email);
}

    $dados = $objDAO->CarregarMeusDados();
    /* echo '<pre>';
    print_r($dados);
    echo '</pre>'; */
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once '_head.php';
?>
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
                        <?php include_once '_msg.php'?>
                        <h2>Meus Dados</h2>
                        <h5>Nesta página você poderá alterar seus dados. </h5>
                    </div>
                </div>
                <hr />
                <form method="POST" action="meus_dados.php">
                    <div class="form-group">
                        <label>Nome:</label>
                        <input type="text" class="form-control" placeholder="Digite seu Nome" name="nome" id="nome" value="<?= $dados[0]['nome_usuario'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="email" class="form-control" placeholder="Digite seu E-mail" name="email" id="email" value="<?= $dados[0]['email_usuario'] ?>"/>
                    </div>
                    <button type="submit" onclick="return ValidarMeusDados()" class="btn btn-success" name="BtnSalvar">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>