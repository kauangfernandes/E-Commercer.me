DROP DATABASE IF EXISTS db_ecommercer;
CREATE DATABASE IF NOT EXISTS db_ecommercer;
USER db_ecommercer;

DROP TABLE IF EXISTS status_categorias;
CREATE TABLE status_categorias(
	id_status_categoria INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	status_categoria VARCHAR(10) UNIQUE NOT NULL
);

INSERT INTO status_categorias (status_categoria) VALUES 
("Ativo"),
("Inativo");

DROP TABLE IF EXISTS tb_categorias;
CREATE TABLE tb_categorias(
	id_categoria INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descritivo VARCHAR(80) UNIQUE NOT NULL,
	
	id_status_categoria INT NOT NULL,
	FOREIGN KEY(id_status_categoria) REFERENCES status_categorias (id_status_categoria)
);

INSERT INTO tb_categorias (descritivo, id_status_categoria) VALUES 
("Bronze",1),
("Ferro",1),
("Ouro",1),
("Diamante",1),
("Ruby",2)

DROP TABLE IF EXISTS status_produtos;
CREATE TABLE status_produtos(
	id_status_produto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	status_produto VARCHAR(10) UNIQUE NOT NULL
);

INSERT INTO status_produtos (status_produto) VALUES 
("Ativo"),
("Inativo")

DROP TABLE IF EXISTS tb_produtos;
CREATE TABLE tb_produtos(
	id_produto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	descricao TEXT NOT NULL,
	preco DECIMAL(8,2) NOT NULL,
	estoque INT NOT NULL,
	imagem VARCHAR(100) NOT NULL,
	
	id_status_produto INT NOT NULL,
	FOREIGN KEY(id_status_produto) REFERENCES status_produtos (id_status_produto),
	
	id_categoria INT NOT NULL,
	FOREIGN KEY(id_categoria) REFERENCES tb_categorias (id_categoria)
);


DROP TABLE IF EXISTS status_usuarios;
CREATE TABLE status_usuarios(
	id_status_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	status_usuario VARCHAR(10) UNIQUE NOT NULL
);

INSERT INTO status_usuarios (status_usuario) VALUES 
("Ativo"),
("Inativo");

DROP TABLE IF EXISTS tb_fornecedores;
CREATE TABLE tb_fornecedores(
	id_fornecedor INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	cnpj VARCHAR(20) UNIQUE NOT NULL,
	razao_social VARCHAR(100),
	
	id_status_usuario INT NOT NULL,
	FOREIGN KEY(id_status_usuario) REFERENCES status_usuarios(id_status_usuario)
);

DROP TABLE IF EXISTS status_telefones;
CREATE TABLE status_telefones(
	id_status_telefone INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	status_telefone VARCHAR(10) UNIQUE NOT NULL
);

DROP TABLE IF EXISTS tb_telefones_fornecedores;
CREATE TABLE tb_telefones_fornecedores(
	id_telefone INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	dd INT(2) NOT NULL,
	telefone VARCHAR(10) NOT NULL,
	
	id_status_telefone INT NOT NULL,
	FOREIGN KEY(id_status_telefone) REFERENCES status_telefones (id_status_telefone),
	
	id_fornecedor INT NOT NULL,
	FOREIGN KEY(id_fornecedor) REFERENCES tb_fornecedores (id_fornecedor)
);

DROP TABLE IF EXISTS tb_produtos_fornecedores;
CREATE TABLE tb_produtos_fornecedores(
	id_produto_fornecedor INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	
	id_produto INT NOT NULL,
	FOREIGN KEY(id_produto) REFERENCES tb_produtos(id_produto),
	
	id_fornecedor INT NOT NULL,
	FOREIGN KEY(id_fornecedor) REFERENCES tb_fornecedores(id_fornecedor)
);

DROP TABLE IF EXISTS tb_tipos_usuarios;
CREATE TABLE tb_tipos_usuarios(
	id_tipo_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	tipo_usuario VARCHAR(20) NOT NULL
);

INSERT INTO tb_tipos_usuarios (tipo_usuario) VALUES 
("Administrador"),
("Usuario"),
("Cliente");

DROP TABLE IF EXISTS tb_usuarios;
CREATE TABLE tb_usuarios(
	id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	email VARCHAR(100) UNIQUE NOT NULL,
	senha VARCHAR(100) NOT NULL,
	
	id_tipo_usuario INT NOT NULL,
	FOREIGN KEY(id_tipo_usuario) REFERENCES tb_tipos_usuarios(id_tipo_usuario),
	
	id_status_usuario INT NOT NULL,
	FOREIGN KEY(id_status_usuario) REFERENCES status_usuarios(id_status_usuario)
);

INSERT INTO tb_usuarios (nome, email, senha, id_tipo_usuario, id_status_usuario) VALUES 
("Administrador", "admin@ecommercer.com.br", "$2y$10$djtr.z1wBlEBtMpEip3u1ulPa7S3JeQPG6rh5qbsKYX9eAPFHtrQW", 1, 1);

DROP TABLE IF EXISTS tb_telefones_usuarios;
CREATE TABLE tb_telefones_usuarios(
	id_telefone INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	dd INT(2) NOT NULL,
	telefone VARCHAR(10) NOT NULL,
	
	id_status_telefone INT NOT NULL,
	FOREIGN KEY(id_status_telefone) REFERENCES status_telefones (id_status_telefone),
	
	id_usuario INT NOT NULL,
	FOREIGN KEY(id_usuario) REFERENCES tb_usuarios (id_usuario)
);