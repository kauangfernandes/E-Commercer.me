<?php
    /* DSN: Conexão
        D - Data Base
        S - Server
        N - Nome data Base

            $dsn = 'mysql:host=localhost;dbname=nome_base_dados';
            $usuario = 'root';
            $senha = '';
            $conexao = new PDO($dsn, $usuario, $senha);
    */

    class Conexao{
        public function __construct(
            protected $db = null
        ){
            $dsn = 'mysql:host=localhost;dbname=db_ecommercer;charset=utf8mb4';
            $usuario = 'root';
            $senha = '';

            try {
                $this->db = new PDO($dsn, $usuario, $senha);
            } catch (PDOException $erro) {
                echo "Erro na conexãor: {$erro->getCode()}<br>Mensagem: {$erro->getMessage()}";
            }
        }
    }
?>