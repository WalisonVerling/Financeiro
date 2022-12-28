<?php
//Self comando que reaproveita comandos da mesma classe
//PDO Classe imbutida propria do PHP para interagir com todos os SGBDs (Softwares de gerenciamento de SQL)

// Configurações do site
define('HOST', '127.0.0.1'); //IP
define('USER', 'root'); //usuario
define('PASS', null); //Senha
define('DB', 'db_financeiro'); //Banco
/**
 * Conexao.class TIPO [Conexão]
 * Descricao: Estabelece conexões com o banco usando SingleTon
 * @copyright (c) year, WMBarros
 */

class Conexao{

    /** @var PDO */
    private static $Connect;

    //Função estática não cria objeto na memoria, funciona de forma direta
    //Quando uma estrutura de função é padrão, não sofre alterações, podemos utilizar a função estatica
    private static function Conectar() {
        // Comando do PHP de Transação (Try): Ele que realiza a verificação do que precisa ser feito, e realiza a tarefa! (CRUD)
        try{
            //Verifica se a conexão não existe
            if (self::$Connect == null):

                $dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
                self::$Connect = new PDO($dsn, USER, PASS, null);
            endif;
        }catch (PDOException $e) { // Caso a tentativa de transação da tarefa (Try) de algum problema ou erro, o Catch vai tratar o erro gerado!
            echo $e->getMessage();
        }
       
        // Seta os atributos para que seja retornado as excessões do banco
        // Comando Self: Reutiliza conteudos, functions statics da proprio Classe.
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       
        return  self::$Connect;
    }

    // Esta funç~~ao, apenas retorna o conteúdo de acesso ao Banco de Dados, da função Conectar!
    public static function retornarConexao(){
        return  self::Conectar();
    }
}