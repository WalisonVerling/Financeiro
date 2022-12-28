<?php

    require_once 'Conexao.php';
    require_once 'UtilDAO.php';

    class CategoriaDAO extends Conexao{
        public function CadastrarCategoria($nome){
            if($nome == ''){
                return 0;
            }

            // 1° Passo: Criar uma vaaariavel que recebera o obj de conexao
            $conexao = parent ::retornarConexao();

            // 2° Passo: Criar uma variavel que recebera o texto do com,endo SQL que devera ser executado do BD
            $comando_sql = 'insert into tb_categoria
                            (nome_categoria, id_usuario)
                            values (?,?);';

            // 3° Passo: Criar um obj que sera config. e levado no BD para ser executado
            $sql = new PDOStatement();

            // 4° Passo: Colocar dentro do obj $sql a conexao preparada para executar o comando_sql
            $sql = $conexao->prepare($comando_sql);

            // 5° Passo: Verificar se no comendo_sql eu tenho ? para ser configurado. Se tiver, Configurar os bindValues
            $sql->bindValue(1, $nome);
            $sql->bindValue(2, UtilDAO::CodigoLogado());

            try{

            // 6° Passo: Executar ao BD
            $sql->execute();

            return 1;
            }
            catch(Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
        }

        public function ConsultarCategoria(){
            $conexao = parent::retornarConexao();

            $comando_sql = 'select id_categoria,
                                    nome_categoria
                                from tb_categoria
                                where id_usuario = ?';

            $sql = new PDOStatement();

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, UtilDAO::CodigoLogado());

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();
            
            return $sql->fetchAll();
        }     
        
        public function DetalharCategoria($idCategoria){
            $conexao = parent::retornarConexao();

            $comando_sql = 'select id_categoria, nome_categoria from tb_categoria where id_categoria = ? and id_usuario = ?;';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            
            $sql->bindValue(1, $idCategoria);
            $sql->bindValue(2, UtilDAO::CodigoLogado());

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();
            
            return $sql->fetchAll();
        }        
        
        public function AlterarCategoria($nome, $id_categoria){
            if(trim($nome) == '' || $id_categoria == ''){
                return 0;
            }

            $conexao = parent::retornarConexao();

            $comando_sql= 'update tb_categoria set nome_categoria = ? where id_categoria = ? and id_usuario = ?;';
            
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $nome);
            $sql->bindValue(2, $id_categoria);
            $sql->bindValue(3, UtilDAO::CodigoLogado());

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex) {
                echo $ex->getMessage();
                return -1;
            }
        }

        public function ExcluirCategoria($idCategoria){
            if($idCategoria == ''){
                return 0;
            }

            $conexao = parent::retornarConexao();

            $comando_sql = 'delete from tb_categoria where id_categoria = ? and id_usuario = ?;';
            
            $sql = new PDOStatement();
            
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $idCategoria);
            $sql->bindValue(2, UtilDAO::CodigoLogado());

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                return -4;
            }
        }
    }