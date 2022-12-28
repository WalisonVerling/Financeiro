//VALIDAÇÃO DOS MEUS DADOS !!

function ValidarMeusDados() {
    var nome = document.getElementById("nome").value;
    var email = $("#email").val();

    if (nome.trim() == '') {
        alert("Preencher o campo Nome.");
        $("#nome").focus();
        return false;
    }

    if (email.trim() == '') {
        alert("Preencher o campo Email.");
        $("#email").focus();
        return false;
    }
}

//VALIDAÇÃO DA CATEGORIA !!

function ValidarCategoria() {

    if ($("#nomecategoria").val().trim() == '') {
        alert("Preencher o campo Nome da Categoria.");
        $("#nomecategoria").focus();
        return false;
    }
}

//VALIDAÇÃO DA EMPRESA !!

function ValidarEmpresa() {

    if ($("#nomedaempresa").val().trim() == '') {
        alert("Preencher o campo Nome da Empresa.");
        $("#nomedaempresa").focus();
        return false;
    }

    if ($("#telempresa").val().trim() == '') {
        alert("Preencher o campo Telefone da Empresa.");
        $("#telempresa").focus();
        return false;
    }

    if ($("#endempresa").val().trim() == '') {
        alert("Preencher o campo Endereço da Empresa.");
        $("#endempresa").focus();
        return false;
    }
}

//VALIDAÇÃO DA CONTA !!

function ValidarConta() {

    if ($("#banco").val().trim() == '') {
        alert("Preencher o campo Nome do Banco.");
        $("#banco").focus();
        return false;
    }

    if ($("#agencia").val().trim() == '') {
        alert("Preencher o campo Agencia do Banco.");
        $("#agencia").focus();
        return false;
    }

    if ($("#numero").val().trim() == '') {
        alert("Preencher o campo Numero da Conta.");
        $("#numero").focus();
        return false;
    }

    if ($("#saldo").val().trim() == '') {
        alert("Preencher o campo Saldo.");
        $("#saldo").focus();
        return false;
    }
}

//VALIDAÇÃO DO MOVIMENTO !!

function ValidarMovimento() {

    if ($("#movimento").val() == '') {
        alert("Selecione o Tipo de Movimento.");
        $("#movimento").focus();
        return false;
    }

    if ($("#data").val().trim() == '') {
        alert("Preencher o campo Data.");
        $("#data").focus();
        return false;
    }

    if ($("#valor").val().trim() == '') {
        alert("Preencher o campo Valor.");
        $("#valor").focus();
        return false;
    }

    if ($("#data").val().trim() == '') {
        alert("Preencher o campo Data.");
        $("#data").focus();
        return false;
    }

    if ($("#categoria").val() == '') {
        alert("Selecione o Tipo de Categoria.");
        $("#categoria").focus();
        return false;
    }

    if ($("#empresa").val() == '') {
        alert("Selecione o Tipo de Empresa.");
        $("#empresa").focus();
        return false;
    }

    if ($("#conta").val() == '') {
        alert("Selecione o Tipo de Conta.");
        $("#conta").focus();
        return false;
    }
}

//VALIDAÇÃO DA CONSULTA DO PERIODO DO MOVIMENTO!!

function ValidarConsultaPeriodo() {
    if ($("#data_inicial").val().trim() == '') {
        alert("Preencher o campo Data Inicial.");
        $("#data_inicial").focus();
        return false;
    }

    if ($("#data_final").val().trim() == '') {
        alert("Preencher o campo Data Final.");
        $("#data_final").focus();
        return false;
    }
}

//VALIDAÇÃO DO LOGIN

function ValidarLogin() {

    if ($("#email").val().trim() == '') {
        alert("Preencher o campo Email.")
        $("#email").focus();
        return false;
    }

    if ($("#senha").val().trim() == '') {
        alert("Preencher o campo Senha.")
        $("#senha").focus();
        return false;
    }
}

function ValidarCadastro() {

    if ($("#nome").val().trim() == '') {
        alert("Preencher o campo Nome.");
        $("#nome").focus();
        return false;
    }

    if ($("#email").val().trim() == '') {
        alert("Preencher o campo Email.");
        $("#email").focus();
        return false;
    }

    if ($("#senha").val().trim() == '') {
        alert("Preencher o campo Senha.");
        $("#senha").focus();
        return false;
    }

    if($("#senha").val().trim().length < 6) {
        alert("A Senha deverá ter mais que 6 caracteres.");
        $("#senha").focus();
        return false;
    } 

    
    // if($("#senha").val().trim().length < 6){
    //     alert("A senha deverá conter no Mínimo, 6 Caracteres!");
    //     $("#senha").focus();
    //     return false;
    // }

    if ($("#repsenha").val().trim() == '') {
        alert("Preencher o campo Repetir Senha.");
        $("#repsenha").focus();
        return false;
    }

    if ($("#senha").val().trim() != $("#repsenha").val().trim()) {
        alert("As Senhas devem ser iguais.");
        $("#repsenha").focus();
        return false;
    }
}