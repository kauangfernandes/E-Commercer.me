<?php
    class Produto extends Conexao{
        public function __construct(
            private int $id_produto = 0,
            private string $nome = "",
            private string $descricao = "",
            private float $preco = 0.00,
            private int $estoque = 0,
            private string $imagem = "",
            private $status = null,
            private $categoria = null,
            private array $fornecedores = array()
        ){
            parent:: __construct();
        }

        public function getIdproduto(){
            return $this->id_produto;
        }

        public function setIdproduto($id_produto){
            $this->id_produto = $id_produto;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }

        public function getPreco(){
            return $this->preco;
        }

        public function setPreco($preco){
            $this->preco = $preco;
        }

        public function getEstoque(){
            return $this->id_produto;
        }

        public function setEstoue($estoque){
            $this->estoque = $estoque;
        }

        public function getImagem(){
            return $this->imagem;
        }

        public function setImagem($imagem){
            $this->imagem = $imagem;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setStatus($status){
            $this->status = $status;
        }

        public function getCategoria(){
            return $this->categoria;
        }

        public function setCategoria($categoria){
            $this->categoria = $categoria;
        }

        public function getFornecedor(){
            return $this->fornecedores;
        }

        public function setFornecedor($fornecedor){
            $this->fornecedores[] = $fornecedor;
        }

        public function query_listar_todos_produtos(){
            $query = "SELECT * FROM tb_produtos p INNER JOIN status_produtos s ON(p.id_status_produto=s.id_status_produto) INNER JOIN tb_categorias c ON(p.id_categoria=c.id_categoria)";
            $stm = $this->db->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public function query_listar_um_produto(){
            $query = "SELECT * FROM tb_produtos p INNER JOIN status_produtos s ON(p.id_status_produto=s.id_status_produto) INNER JOIN tb_categorias c ON(p.id_categoria=c.id_categoria) WHERE p.id_produto = ?";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $this->id_produto);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        }

        public function query_listar_um_produto_fornecedor(){
            $query = "SELECT * FROM tb_produtos p INNER JOIN status_produtos s ON(p.id_status_produto=s.id_status_produto) INNER JOIN tb_categorias c ON(p.id_categoria=c.id_categoria) INNER JOIN tb_produtos_fornecedores pf ON(p.id_produto=pf.id_produto) WHERE p.id_produto = ?";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $this->id_produto);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public function query_listar_todos_produtos_fornecedores(){
            $query = "SELECT * FROM tb_produtos p INNER JOIN status_produtos s ON(p.id_status_produto=s.id_status_produto) INNER JOIN tb_categorias c ON(p.id_categoria=c.id_categoria) INNER JOIN tb_produtos_fornecedores pf ON(p.id_produto=pf.id_produto)";
            $stm = $this->db->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public function query_listar_todos_produtos_ativos(){
            $query = "SELECT * FROM tb_produtos p INNER JOIN status_produtos s on(p.id_status_produto=s.id_status_produto) INNER JOIN tb_categorias c on(p.id_categoria=c.id_categoria) WHERE s.status_produto = 'Ativo' OR s.status_produto = 'ativo'";
            $stm = $this->db->prepare($query);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public function query_inserir_produto(){
            $query = "INSERT INTO tb_produtos(nome, descricao, preco, estoque, imagem, id_status_produto, id_categoria) VALUES(?,?,?,?,?,?,?)";
            
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $this->nome);
            $stm->bindValue(2, $this->descricao);
            $stm->bindValue(3, $this->preco);
            $stm->bindValue(4, $this->estoque);
            $stm->bindValue(5, $this->imagem);
            $stm->bindValue(6, $this->status->getId_status_produto());
            $stm->bindValue(7, $this->categoria->getId_Categoria());
            $stm->execute();

            $id_produto = $this->db->lastInsertId();
            $query = "INSERT INTO tb_produtos_fornecedores (id_produto, id_fornecedor) VALUES(?,?)";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $id_produto);

			foreach($this->fornecedores as $fornecedor){
				$stm->bindValue(2, $fornecedor->getId_fornecedor());
				$stm->execute();
			}
            $this->db = null;
        }

        public function query_editar_produto(){
            $query = "UPDATE tb_produtos SET nome = ?, descricao = ?, preco = ?, estoque = ?, imagem = ?, id_status_produto = ?, id_categoria = ? WHERE id_produto = ?";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $this->nome);
            $stm->bindValue(2, $this->descricao);
            $stm->bindValue(3, $this->preco);
            $stm->bindValue(4, $this->estoque);
            $stm->bindValue(5, $this->imagem);
            $stm->bindValue(6, $this->status->getId_status_produto());
            $stm->bindValue(7, $this->categoria->getId_Categoria());
            $stm->bindValue(8, $this->id_produto);
            $stm->execute();

            $query = "DELETE FROM tb_produtos_fornecedores WHERE id_produto = ?";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $this->id_produto);
            $stm->execute();

            $query = "INSERT INTO tb_produtos_fornecedores (id_produto, id_fornecedor) VALUES(?,?)";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $this->id_produto);
            
			foreach($this->fornecedores as $fornecedor){
				$stm->bindValue(2, $fornecedor->getId_fornecedor());
				$stm->execute();
			}
            $this->db = null;
        }

        public function query_excluir_produto(){
            $query = "DELETE FROM tb_produtos WHERE id_produto = ?";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1, $this->id_produto);
            $stm->execute();
        }
    }
?>