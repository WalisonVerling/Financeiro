<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/ContaDAO.php';

$objDAO = new ContaDAO();

    if(isset($_GET['cod']) && is_numeric($_GET['cod'])){
        $idConta = $_GET['cod'];
        $dados = $objDAO->DetalharConta($idConta);

        if(count($dados) == 0){
            header('location: consultar_conta.php');
            exit;
        }
    }else if (isset($_POST['BtnSalvar'])) {
        $idConta = $_POST['cod'];
        $banco = ltrim(trim($_POST['banco']));
        $agencia = $_POST['agencia'];
        $numero = $_POST['numero'];
        $saldo = $_POST['saldo'];

        $retorno = $objDAO->AlterarConta($banco, $agencia, $numero, $saldo, $idConta);

        header('location: consultar_conta.php?retorno=' . $retorno);
        exit;
    } else if (isset($_POST['BtnExcluir'])) {
        $idConta = $_POST['cod'];
        $retorno = $objDAO->ExcluirConta($idConta);

        header('location: consultar_conta.php?retorno=' . $retorno);
        exit;
    } else {
        header('location: consultar_conta.php');
        exit;
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
                        <h2>Alterar Conta</h2>
                        <h5>Aqui você poderá alterar todas as Contas. </h5>
                    </div>
                </div>
                <hr />
                <form action="alterar_conta.php" method="POST">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_conta'] ?>">
                    <div class="form-group">
                        <label>Banco</label>
                        <input class="form-control" type="text" placeholder="Digite o nome do Banco" name="banco" id="banco" value="<?= $dados[0]['banco_conta'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Agência</label>
                        <input class="form-control" type="number" placeholder="Digite a agencia" name="agencia" id="agencia" value="<?= $dados[0]['agencia_conta'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Número da conta</label>
                        <input class="form-control" type="number" placeholder="Digite o número da conta" name="numero" id="numero" value="<?= $dados[0]['numero_conta'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Saldo</label>
                        <input class="form-control" type="number" placeholder="Digite o saldo da conta" name="saldo" id="saldo" value="<?= $dados[0]['saldo_conta'] ?>" />
                    </div>
                    <button type="submit" class="btn btn-success" onclick="return ValidarConta()" name="BtnSalvar">Salvar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir">Excluir</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão!</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a Conta: <b><?= $dados[0]['banco_conta'] ?>?</b>
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