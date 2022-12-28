<?php

    require_once 'Conexao.php';
    require_once 'UtilDAO.php';

class UsuarioDAO extends Conexao{
    public function CarregarMeusDados(){
        $conexao = parent::retornarConexao();

        $comando_sql = 'select nome_usuario, email_usuario from tb_usuario where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());

        //Remove os index (indice) do Array, permanecendo somente com as colunas do BD
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function GravarMeusDados($nome, $email){
        if (trim($nome) == '' || trim($email) == ''){
            return 0;
        }

        // Esta condição, também impossibilita do Usuario alterar o E-mail, para um já cadastrado
        if($this->ValidarEmailDuplicadoAlteracao($email) != 0){
            return -5;
        }

        $conexao = parent::retornarConexao();

        $comando_sql = 'update tb_usuario set nome_usuario = ?, email_usuario = ? where id_usuario = ?;';

        $sql = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ValidarLogin($email, $senha){
        if (trim($email) == '' || trim($senha) == ''){
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_usuario, nome_usuario from tb_usuario where email_usuario = ? and senha_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);
        $sql->bindValue(2, $senha);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        // Guarda nesta variável, o acesso com os dados do Usuário
        $user = $sql->fetchAll();

        // Um retorno Caso ele não encontre nenhum Usuário identificado, no Array a cima, retorna uma Mensagem
        // lembrando que só cai aqui, quando o Usuário não existe
        if(count($user) == 0){
            return -6;
        }

        // Caso encontre os Dadoas do Usuário, esta Variável armazena o seu ID
        $cod = $user[0]['id_usuario'];
        $nome = $user[0]['nome_usuario'];
        // Após a identificação, a Sessão é criada e libera o acesso ao Sistema
        UtilDAO::CriarSessao($cod, $nome);
        header('location: tela_inicial.php');
        exit;
    }

    // Esta função, verifica se não existe um Cadastro ja realizado, com os mesmo DADOS
    public function ValidarEmailDuplicadoCadastro($email){
        if(trim($email) == ''){
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'select count(email_usuario) as contar from tb_usuario where email_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $contar = $sql->fetchAll();
        return $contar[0]['contar'];
    }

    public function ValidarEmailDuplicadoAlteracao($email){
        if(trim($email) == ''){
            return 0;
        }

        $conexao = parent::retornarConexao();
        // Exemplo do diferente no final deste script SQL, verifica se há igualdade nos outros, e não nele mesmo
        $comando_sql = 'select count(email_usuario) as contar from tb_usuario where email_usuario = ? and id_usuario != ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $contar = $sql->fetchAll();
        return $contar[0]['contar'];
    }    

    public function CriarCadastro($nome, $email, $senha, $repsenha){
        if(trim($nome) == '' || trim($email) == '' || trim($senha) == '' || trim($repsenha) == ''){
            return 0;
        }
        if(strlen($senha) < 6){
            return -2;
        }
        if(trim($senha) != trim($repsenha)){
            return -3;
        }

        // Aqui sera chamado, a função de validar ValidarEmailDuplicadoCadastro
        // Dests forma, não será possivel realizar um Cadastro com um E-mail ja existente na tb_usuario
        if($this->ValidarEmailDuplicadoCadastro($email) != 0){
            return -5;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'insert into tb_usuario (nome_usuario, email_usuario, senha_usuario, data_cadastro) values (?, ?, ?, ?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $senha);
        $sql->bindValue(4, date('Y-m-d'));

        // try tenta executar o algoritmo para verificar se funciona, caso não, o catch pega o erro e o trata
        try{
            $sql->execute();
            return -7;
        // catch pega o erro e envia um resultado para o usuario
        }catch(Exception $ex){
            // getMessage, pega o erro e envia para retorno de mensagem
            echo $ex->getMessage();
            return -1;
        }
    }
}

//Se os Campos não forem preenchidos corretamente, retorna 0
//Se os Campos cadastraram corretamente no Banco de Dados, retorna 1
//Se ocorreu algum erro na gravação no Banco de Dados, retornar -1