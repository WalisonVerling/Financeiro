<?php

// Se existir o ret ou em forma de variavel ou na URL será identificado pelo arquivo _msg_msg.php
if (isset($_GET['retorno'])) {
    $retorno = $_GET['retorno'];
}

if (isset($retorno)) {
    switch ($retorno) {
        case 0:
            echo '<div class="alert alert-warning">
        Preencher o(s) campo(s) obrigatório(s)!
        </div>';
            break;
        case 1:
            echo '<div class="alert alert-success">
        Ação realizada com Sucesso!
        </div>';
            break;
        case -1:
            echo '<div class="alert alert-danger">
        Ocorreu um erro na operação. tente mais tarde!
        </div>';
            break;
        case -2:
            echo '<div class="alert alert-danger">
        Ocorreu um erro na operação. tente mais tarde!
        </div>';
            break;
        case -3:
            echo '<div class="alert alert-danger">
        Os campos Senha e Repetir Senha devem ser iguais!
        </div>';
            break;
        case -4:
            echo '<div class="alert alert-danger">
        O registro não poderá ser excluido, pois está em uso!
        </div>';
            break;
        case -5:
            echo '<div class="alert alert-danger">
        E-mail já Cadastrado, insira outro E-mail!
        </div>';
            break;
        case -6:
            echo '<div class="alert alert-danger">
        Usuário não encontrado!
        </div>';
            break;
        case -7:
            echo '<div class="alert alert-success">
            Cadastro criado com sucesso!
            </div>';
            break;
    }
}
