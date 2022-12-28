<?php

    class UtilDAO{
        // Criando a Validação de Sessão, Usuário Logado
        // 1ª Função: Cria a Sessão do Usuário Logado
        private static function IniciarSessao(){
            if(!isset($_SESSION)){
                session_start();
            }
        }

         // 2ª Função: Função que chama a função estatica IniciarSessao
        public static function CriarSessao($cod, $nome){
        // Comando self chama uma Função Estática
            self::IniciarSessao();
            // Comando que identifica o numero e o nome do usuário que está realizando o acesso ao sistema
            $_SESSION['cod'] = $cod;
            $_SESSION['nome'] = $nome;
        }
        // 3ª Função: Chama a Função que cria a Sessão e identifica o COD do usuário logado
        public static function CodigoLogado(){
            self::IniciarSessao();
            return $_SESSION['cod'];
        }
        // 4ª Função: Chama a Função que cria a Sessão e identifica o NOME do usuário logado    
        public static function NomeLogado(){
            self::IniciarSessao();
            return $_SESSION['nome'];
        }
        // 5ª Função: Esta Função verifica na Sessão o usuário logado, e destroi os dados de acesso, desconectando ele do Sistema
        public static function Deslogar(){
            self::IniciarSessao();
            // Comando unset elimina a Sessão logada
            unset($_SESSION['cod']);
            unset($_SESSION['nome']);
            // Após a Sessão destruida, a programação te direciona de volta para a página de Login
            header('location: index.php');
            exit;
        }
        // 6ª Função: Esta função Verifica se existe valor nas Sessão, caso não, expulsa para página de login
        public static function VerificarLogado(){
            self::IniciarSessao();
            if(!isset($_SESSION['cod']) || $_SESSION['cod'] == ''){
               
                header('location: index.php');
                exit;
            }
        }
    }

    