<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/CategoriaDAO.php';
require_once '../DAO/EmpresaDAO.php';
require_once '../DAO/ContaDAO.php';

    $obj_cat = new CategoriaDAO();
    $obj_emp = new EmpresaDAO();
    $obj_con = new ContaDAO();

    if(isset($_POST['btnSalvar'])){
        $tipo = $_POST['tipo'];
        $data = $_POST['data'];
        $valor = ltrim(trim($_POST['valor']));
        $categoria = $_POST['categoria'];
        $empresa = $_POST['empresa'];
        $conta = $_POST['conta'];
        $obs = $_POST['obs']; 

        $objdao = new MovimentoDAO();

        $retorno = $objdao->RealizarMovimento($tipo,$data,$valor,$categoria,$empresa,$conta,$obs);
    }

    $categorias = $obj_cat->ConsultarCategoria();
    $empresas = $obj_emp->ConsultarEmpresa();
    $contas = $obj_con->ConsultarConta();
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
                        <h2>Realizar Movimento</h2>
                        <h5>Aqui você poderá realizar seus movimentos de entrada ou saída. </h5>
                    </div>
                </div>
                <hr />
                <form action="realizar_movimento.php" method="POST">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tipo de Movimento:</label>
                        <select class="form-control" name="tipo" id="movimento">
                            <option value="">Selecione</option>
                            <option value="1" <?=isset($tipo) == 1 ? 'selected': ''?>>Entrada</option>
                            <option value="2" <?=isset($tipo) == 2 ? 'selected': ''?>>Sáida</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Data</label>
                        <input type="date" class="form-control" name="data" value="<?=isset($data) ? $data : '' ?>" id="data" />
                    </div>
                    <div class="form-group">
                        <label>Valor</label>
                        <input class="form-control" type="text" placeholder="Digite o valor do movimento" name="valor" id="valor" value="<?=isset($valor) ? $valor : '' ?>" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control" name="categoria" id="categoria">
                            <option value="">Selecione</option>
                            <?php foreach($categorias as $itens) {?>
                                <option value="<?= $itens['id_categoria']?>">
                                <?= $itens['nome_categoria']?>
                                </option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Empresa</label>
                        <select class="form-control" name="empresa" id="empresa">
                            <option value="">Selecione</option>
                            <?php foreach($empresas as $itens) {?>
                                <option value="<?= $itens['id_empresa']?>">
                                <?= $itens['nome_empresa']?>
                                </option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Conta</label>
                        <select class="form-control" name="conta" id="conta">
                            <option value="">Selecione</option>
                            <?php foreach($contas as $itens) {?>
                                <option value="<?= $itens['id_conta']?>">
                                <?= 'Banco: ' . $itens['banco_conta'] . ' , Agência ' . $itens['agencia_conta'] . ' / ' . 'Numero: ' . $itens['numero_conta'] . ' - Saldo: ' . $itens['saldo_conta']?>
                                </option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Observação (Opcional)</label>
                        <textarea class="form-control" rows="3" name="obs" value="<?=isset($obs) ? $obs : '' ?>" id=""></textarea>
                    </div>
                    <button type="submit" class="btn btn-success" name="btnSalvar" onclick="return ValidarMovimento()">Finalizar Lançamento</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>