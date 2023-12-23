CREATE SCHEMA IF NOT EXISTS flameskt;
USE flameskt;

CREATE TABLE produto(
    idProduto int(11) primary key auto_increment not null,
    titulo varchar(100) not null,
    preco decimal(10,2) not null,
    qntVezes int(2),
    descricao varchar(1000) not null,
    img varchar(250) not null,
    qtdEstoque int(11),
    freteGratis varchar(1) not null,
    categoria varchar(50) not null 
);

CREATE TABLE usuario(
    idUsuario int(11) primary key auto_increment not null,
    email varchar(100) not null, 
    senha varchar(50) not null,
    nome varchar(100) not null, 
    dataNasc date not null,
    sexo char not null,
    telefone varchar(20) not null
);

CREATE TABLE categoria(
    idCategoria int(11) primary key auto_increment not null,
    categoria varchar(50) not null
);

CREATE TABLE pedido (
  idPedido int(11) AUTO_INCREMENT PRIMARY KEY,
  idUsuario int(11) NOT NULL,
  idProduto int(11) NOT NULL,
  qtdProduto int(11) NOT NULL,
  FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario),
  FOREIGN KEY (idProduto) REFERENCES produto(idProduto)
);

ALTER TABLE produto DROP COLUMN categoria;

ALTER TABLE produto ADD categoria int not null;

ALTER TABLE produto ADD CONSTRAINT fk_categoria FOREIGN KEY (categoria) REFERENCES categoria(idCategoria);  