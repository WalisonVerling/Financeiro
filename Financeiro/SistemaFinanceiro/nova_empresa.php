<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/EmpresaDAO.php';

    if(isset($_POST['BtnSalvar'])){
        $nome = ltrim(trim($_POST['nome']));
        $telefone = ltrim(trim($_POST['telefone']));
        $endereco = ltrim(trim($_POST['endereco']));

        $objdao = new EmpresaDAO();
        $retorno = $objdao->CadastrarEmpresa($nome, $telefone, $endereco);
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include_once '_head.php' ?>
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
                        <h2>Nova Empresa</h2>
                        <h5>Aqui você poderá cadastrar todas as suas empresas. </h5>
                    </div>
                </div>
                <hr />
                <form action="nova_empresa.php" method="post">
                    <div class="form-group">
                        <label>Nome da Empresa:</label>
                        <input class="form-control" type="text" placeholder="Digite o nome da empresa." name="nome" id="nomedaempresa" value="<?=isset ($nome) ? $nome : '' ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Telefone (WhatsApp):</label>
                        <input class="form-control" type="number" placeholder="Digite o telefone da empresa." name="telefone" id="telempresa" value="<?=isset ($telefone) ? $telefone : '' ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <input class="form-control" type="text" placeholder="Digite o endereço da empresa." name="endereco" id="endempresa" value="<?=isset ($endereco) ? $endereco : '' ?>"/>
                    </div>
                    <button class="btn btn-success" onclick="return ValidarEmpresa()" name="BtnSalvar">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>