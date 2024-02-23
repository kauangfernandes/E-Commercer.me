<?php
    class Fornecedor extends Conexao{
        public function __construct(
            private int $id_fornecedor = 0,
            private string $cnpj = "",
            private string $razao_social = "",
            private array $produtos = array(),
            private $status_fornecedor = null
            //private $ddd,
           ///private $numero,
            //private $status_tel,
            //private $usuario
        ){
            parent:: __construct();
            //$this->telefone[] = new Telefone(ddd:$ddd, numero:$numero, status:1, usuario:null);
        }

        public function getId_fornecedor(){
            return $this->id_fornecedor;
        }

        public function setProdutos($produto){
            $this->produtos[] = $produto;
        }

        public function query_verificar_cnpj(){
            $query = "SELECT cnpj FROM tb_fornecedores WHERE cnpj = ? ";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1,$this->cnpj);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public function query_inserir_fornecedor(){
            $query = "INSERT INTO tb_fornecedores(cnpj, razao_social, id_status_usuario) VALUES (?,?,?)";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1,$this->cnpj);
            $stm->bindValue(2,$this->razao_social);
            $stm->bindValue(3,$this->status_fornecedor);
            $stm->execute();
            $this->db = null;
        }

        public function query_excluir_fornecedor(){
            $query = "DELETE FROM tb_fornecedores WHERE id_fornecedor = ?";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1,$this->id_fornecedor);
            $stm->execute();
            $this->db = null;
        }

        public function query_altera_fornecedor(){
            $query = "UPDATE tb_fornecedores SET cnpj = ?, razao_social = ?  WHERE id_fornecedor = ?";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1,$this->cnpj);
            $stm->bindValue(2,$this->razao_social);
            $stm->bindValue(3,$this->id_fornecedor);
            $stm->execute();
            $this->db = null;
        }

        public function query_listar_um_fornecedor(){
            $query = "SELECT * FROM tb_fornecedores f INNER JOIN status_usuarios s ON (f.id_status_usuario=s.id_status_usuario) WHERE id_fornecedor = ?";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1,$this->id_fornecedor);
            $stm->execute();
            $this->db = null;
            return $stm->fetch(PDO::FETCH_OBJ);
        }

        public function query_listar_todos_fornecedores(){
            $query = "SELECT * FROM tb_fornecedores f INNER JOIN status_usuarios s ON (f.id_status_usuario=s.id_status_usuario)";
            $stm = $this->db->prepare($query);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public function query_listar_todos_fornecedores_produtos(){
            $query = "SELECT * FROM tb_fornecedores f INNER JOIN status_usuarios s ON (f.id_status_usuario=s.id_status_usuario) INNER	JOIN tb_produtos_fornecedores pf ON(f.id_fornecedor=pf.id_fornecedor)";
            $stm = $this->db->prepare($query);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public function query_listar_todos_fornecedores_ativos(){
            $query = "SELECT * FROM tb_fornecedores f INNER JOIN status_usuarios s ON (f.id_status_usuario=s.id_status_usuario) WHERE s.status_usuario = 'Ativo' OR s.status_usuario = 'ativo'";
            $stm = $this->db->prepare($query);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

    }
?>