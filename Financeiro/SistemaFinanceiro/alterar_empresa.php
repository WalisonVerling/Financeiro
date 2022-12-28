<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/EmpresaDAO.php';

$objDAO = new EmpresaDAO();

    if(isset($_GET['cod']) && is_numeric($_GET['cod'])){
        $idEmpresa = $_GET['cod'];
        $dados = $objDAO->DetalharEmpresa($idEmpresa);

        if(count($dados) == 0){
            header('location: consultar_empresa.php');
            exit;
        }
    }else if(isset($_POST['BtnSalvar'])){
        $idEmpresa = $_POST['cod'];
        $nomeEmpresa = $_POST['nomeempresa'];
        $telEmpresa = $_POST['telempresa'];
        $endEmpresa = $_POST['endempresa'];

        $retorno = $objDAO->AlterarEmpresa($nomeEmpresa, $telEmpresa, $endEmpresa, $idEmpresa);

        header('location: consultar_empresa.php?retorno='. $retorno);
        exit;
    }else if(isset($_POST['BtnExcluir'])){
        $idEmpresa = $_POST['cod'];
        $retorno = $objDAO->ExcluirEmpresa($idEmpresa);

        header('location: consultar_empresa.php?retorno='. $retorno);
        exit;
    }else{
        header('location: consultar_empresa.php');
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
                        <?php include_once '_msg.php'; ?>
                        <h2>Alterar Empresa</h2>
                        <h5>Aqui você poderá alterar todas as suas empresas. </h5>
                    </div>
                </div>
                <hr />
                <form method="POST" action="alterar_empresa.php">
                <input type="hidden" name="cod" value="<?= $dados[0]['id_empresa'] ?>">
                <div class="form-group">
                    <label>Nome da Empresa:</label>
                    <input class="form-control" type="text" name="nomeempresa" id="nomedaempresa" placeholder="Digite o nome da empresa. " value="<?= $dados[0]['nome_empresa'] ?>" />
                </div>
                <div class="form-group">
                    <label>Telefone:</label>
                    <input class="form-control" type="number" name="telempresa" id="telempresa" placeholder="Digite o telefone da empresa. " value="<?= $dados[0]['telefone_empresa'] ?>" />
                </div>
                <div class="form-group">
                    <label>Endereço:</label>
                    <input class="form-control" type="text" name="endempresa" id="endempresa" placeholder="Digite o endereço da empresa." value="<?= $dados[0]['endereco_empresa'] ?>" />
                </div>
                <button name="BtnSalvar" class="btn btn-success" onclick="return ValidarEmpresa()">Salvar</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalExcluir">Excluir</button>
                <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão!</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a Empresa: <b><?= $dados[0]['nome_empresa'] ?>?</b>
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