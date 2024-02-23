<?php
    class Usuario  extends Conexao{
        public function __construct(
            private int $id_usuario = 0,
            private string $nome = "",
            private string $email = "",
            private string $senha = "",
            private int $id_tipo_usuario = 0,
            private int $id_status_usuario = 0
            //private $ddd,
            //private $numero,
            //private $status_tel,
            //private $usuario
        ){
            parent:: __construct();
            //$this->telefone[] = new Telefone(ddd:$ddd, numero:$numero, status:1, usuario:null);
        }

        public function getTelefone(){
            return $this->telefone;
        }

        public function login(){
            $query = "SELECT id_usuario, nome, email, senha, id_tipo_usuario, id_status_usuario FROM tb_usuarios WHERE email = ?";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1,$this->email);
            $stm->execute();
            $this->db = null;
            return $stm->fetch(PDO::FETCH_OBJ);
        }

        public function criar_conta(){
            $query = "INSERT INTO tb_usuarios(nome, email, senha, id_tipo_usuario, id_status_usuario) VALUES (?,?,?,?,?)";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1,$this->nome);
            $stm->bindValue(2,$this->email);
            $stm->bindValue(3,$this->senha);
            $stm->bindValue(4,$this->id_tipo_usuario);
            $stm->bindValue(5,$this->id_status_usuario);
            $stm->execute();
            $this->db = null;
        }

        public function verificar_email(){
            $query = "SELECT email FROM tb_usuarios WHERE email = ? ";
            $stm = $this->db->prepare($query);
            $stm->bindValue(1,$this->email);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public function password_hash(){
            $password = password_hash($this->senha, PASSWORD_DEFAULT);
            return $password;
        }

        public function password_verify($login_senha){
            $password = password_verify($this->senha, $login_senha);
            return $password;
        }
    }
?>