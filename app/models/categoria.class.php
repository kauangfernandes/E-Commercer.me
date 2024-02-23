<?php
    class Categoria extends Conexao{
        public function __construct(
            private int $id_categoria = 0,
            private string $descritivo = "",
            private $status = null
        ){
            parent::__construct();
        }

        public function getId_Categoria(){
            return $this->id_categoria;
        }


        public function setId_Categoria($id_categoria){
            $this->id_categoria = $id_categoria;
        }

        public function getDescritivo(){
            return $this->descritivo;
        }

        public function setDescritivo($descritivo){
            $this->descritivo = $descritivo;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setStatus($status){
            $this->status = $status;
        }

        public function query_listar_todas_categorias(){
            $query = "SELECT * FROM tb_categorias AS c INNER JOIN status_categorias AS s ON (c.id_status_categoria=s.id_status_categoria)";
            $stm = $this->db->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public function query_listar_uma_categoria(){
            $query = "SELECT * FROM tb_categorias WHERE id_categoria = ?";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $this->id_categoria);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        }

        public function query_listar_categorias_ativas(){
            $query = "SELECT * FROM tb_categorias AS c INNER JOIN status_categorias AS s ON (c.id_status_categoria=s.id_status_categoria) WHERE s.status_categoria = 'Ativo'";
            $stm = $this->db->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public function inserir_categoria(){
            $query = "INSERT INTO tb_categorias (descritivo, id_status_categoria) VALUES(?,?)";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $this->descritivo);
			$stm->bindValue(2, $this->status->getId_status_categoria());
            $stm->execute();
        }

        public function excluir_categoria(){
            $query = "DELETE FROM tb_categorias WHERE id_categoria = ?";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $this->id_categoria);
            $stm->execute();
        }

        public function alterar_status_categoria(){
            $query = "UPDATE categorias SET STATUS = ? WHERE id_categoria = ?";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $this->status);
			$stm->bindValue(2, $this->id_categoria);
            $stm->execute();
        }
    }
