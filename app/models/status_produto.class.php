<?php
    class StatusProduto extends Conexao{
        public function __construct(
            private int $id_status_produto = 0,
            private string $descritivo = ""
        ){
            parent:: __construct();
        }

        public function getId_status_produto(){
            return $this->id_status_produto;
        }

        public function setId_status_produto($id_status_produto){
            $this->id_status_produto = $id_status_produto;
        }

        public function getDescritivo_status_produto(){
            return $this->descritivo;
        }

        public function query_listar_um_status_produto(){
            $query = "SELECT * FROM status_produtos WHERE id_status_produto = ?";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $this->id_status_produto);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        }

        public function query_listar_todos_status_produto(){
            $query = "SELECT * FROM status_produtos";
            $stm = $this->db->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
    }
?>