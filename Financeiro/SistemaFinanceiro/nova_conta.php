<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/ContaDAO.php';

    if(isset($_POST['BtnSalvar'])){
        $banco = ltrim(trim($_POST['banco']));
        $numero = ltrim(trim($_POST['numero']));
        $agencia = ltrim(trim($_POST['agencia']));
        $saldo = ltrim(trim($_POST['saldo']));

        $objdao = new ContaDAO();

        $retorno = $objdao->CadastrarConta($banco,$agencia,$numero,$saldo);

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
                        <h2>Nova Conta</h2>
                        <h5>Aqui você poderá cadastrar todas as suas contas. </h5>
                    </div>
                </div>
                <hr />
                <form action="nova_conta.php" method="post">
                <div class="form-group">
                    <label>Nome do Banco:</label>
                    <input class="form-control" type="text" placeholder="Digite o nome do banco" name="banco" id="banco" value="<?= isset($banco) ? $banco : '' ?>"/>
                </div>
                <div class="form-group">
                    <label>Agencia:</label>
                    <input class="form-control" type="number" placeholder="Digite a Agência" name="agencia" id="agencia" value="<?= isset($agencia) ? $agencia : '' ?>"/>
                </div>
                <div class="form-group">
                    <label>Número da Conta:</label>
                    <input class="form-control" type="number" placeholder="Digite o número da conta" name="numero" id="numero" value="<?= isset($numero) ? $numero : '' ?>"/>
                </div>
                <div class="form-group">
                    <label>Saldo:</label>
                    <input class="form-control" type="number" placeholder="Digite o saldo da conta" name="saldo" id="saldo" value="<?= isset($saldo) ? $saldo : '' ?>"/>
                </div>
                <button class="btn btn-success" name="BtnSalvar" onclick="return ValidarConta()">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>