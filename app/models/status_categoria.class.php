<?php
    class StatusCategoria extends Conexao{
        public function __construct(
            private int $id_status_categoria = 0,
            private string $descritivo = ""
        ){
            parent:: __construct();
        }

        public function getId_status_categoria(){
            return $this->id_status_categoria;
        }

        public function setId_status($id_status){
            $this->id_status = $id_status;
        }

        public function getDescritivo_status_categoria(){
            return $this->descritivo;
        }

        public function query_inserir_status(){
            $query = "INSERT INTO status (status) VALUES (?)";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $this->descritivo);
            $stm->execute();
        }

        public function query_listar_single_status(){
            $query = "SELECT * FROM status_categorias WHERE id_status = ?";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $this->id_status);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public function query_listar_todos_status_categoria(){
            $query = "SELECT * FROM status_categorias ORDER BY id_status_categoria";
            $stm = $this->db->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
    }
?>