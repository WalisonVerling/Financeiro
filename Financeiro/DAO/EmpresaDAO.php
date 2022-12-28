<?php

    require_once '../DAO/Conexao.php';
    require_once '../DAO/UtilDAO.php';

    // Extends: Herença de functions de diferentes Classes!
    class EmpresaDAO extends Conexao{
        public function CadastrarEmpresa($nome, $telefone, $endereco){
            if($nome== '' || $telefone == '' || $endereco == ''){
                return 0;
            }

            $conexao = parent::retornarConexao();

            $exeSQL = 'insert into tb_empresa (nome_empresa, telefone_empresa, endereco_empresa, id_usuario) values(?, ?, ?, ?)';

            // PDO: Comando da familia do PHP, que realiza todo gerenciamento de forma completa, no Banco de Dados!
            // PDO possui compatibilidade com TODOS o tipos de Bancos de Dados.
            // Comando PHP mysqli: O problema de usar este comando, é a obrigatoriedade de uso do Banco de Dados MySQL.
            $sql = new PDOStatement();

            $sql = $conexao->prepare($exeSQL);

            // O comando bindValue realiza a verificação e valida as informações reais que estão chegando da Tela para direcionar ao Banco de Dados!
            $sql->bindValue(1, $nome);
            $sql->bindValue(2, $telefone);
            $sql->bindValue(3, $endereco);
            $sql->bindValue(4, UtilDAO::CodigoLogado());

            // Agora, etapa final, é a tentativa de execução no Banco de Dados, via uma Transação.
            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
        }
        public function ConsultarEmpresa(){
            $conexao = parent::retornarConexao();

            $comando_sql = 'select id_empresa, nome_empresa, telefone_empresa, endereco_empresa 
                            from tb_empresa where id_usuario = ?';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, UtilDAO::CodigoLogado());

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();
            
            return $sql->fetchAll();
        }
        public function AlterarEmpresa($nome, $telefone, $endereco, $idEmpresa){
            if($nome== '' || $telefone == '' || $endereco == ''){
                return 0;
            }

            $conexao = parent::retornarConexao();

            $comando_sql= 'update tb_empresa set nome_empresa = ? , telefone_empresa = ?, endereco_empresa = ?
                            where id_empresa = ? and id_usuario = ?;';
            
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $nome);
            $sql->bindValue(2, $telefone);
            $sql->bindValue(3, $endereco);
            $sql->bindValue(4, $idEmpresa);
            $sql->bindValue(5, UtilDAO::CodigoLogado());

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex) {
                echo $ex->getMessage();
                return -1;
            }
        }
        public function ExcluirEmpresa($idEmpresa){
            if($idEmpresa == ''){
                return 1;
            }
            $conexao = parent::retornarConexao();

            $comando_sql = 'delete from tb_empresa where id_empresa = ? and id_usuario = ?;';
            
            $sql = new PDOStatement();
            
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $idEmpresa);
            $sql->bindValue(2, UtilDAO::CodigoLogado());

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                return -4;
            }
        }
        public function DetalharEmpresa($idEmpresa){
                $conexao = parent::retornarConexao();
    
                $comando_sql = 'select id_empresa, nome_empresa, telefone_empresa, endereco_empresa
                                 from tb_empresa where id_empresa = ? and id_usuario = ?;';
    
                $sql = new PDOStatement();
                $sql = $conexao->prepare($comando_sql);
                
                $sql->bindValue(1, $idEmpresa);
                $sql->bindValue(2, UtilDAO::CodigoLogado());
    
                $sql->setFetchMode(PDO::FETCH_ASSOC);
    
                $sql->execute();
                
                return $sql->fetchAll();
            }        
        }