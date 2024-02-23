<?php
    class Telefone extends Conexao{
        public function __construct(
            private int $id_telefone = 0,
            private int $ddd = 0,
            private string $numero = "",
            private $usuario = null
        ){

        }

        public function getId_telefone(){
            return $this->id_telefone;
        }
    }
?>
