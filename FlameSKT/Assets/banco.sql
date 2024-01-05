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
    status varchar(10) not null,
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

INSERT INTO produto (titulo, preco, qntVezes, descricao, img, qtdEstoque, freteGratis, status, categoria)
VALUES 
('SKATE SANTA CRUZ 8.0 MONTADO', 398.99, 8, 'Fabricado na maior empresa de tecnologia da América Lat...', './img/produtos/Produto_1.png', FLOOR(RAND() * 100), 's', 'ativo', '0'),
('Kit Com Truck Pgs Iniciante, Roda Iniciante', 129.90, 12, 'A Progress é uma marca que acompanha o progresso do ...', './img/produtos/Produto_2.png', FLOOR(RAND() * 100), 's', 'ativo', '0'),
('Skate Profissional Montado - Black Sheep', 399.99, 10, 'A Black Sheep é uma marca que acompanha o progresso', './img/produtos/Produto_3.png', FLOOR(RAND() * 100), 's', 'ativo', '0'),
('Shape Eastern + Parafuso Base + Lixa Emborrachada', 159.0, 12, 'Sobre a marca: A Wood Light é atualmente reconhecida c...', './img/produtos/Produto_4.png', FLOOR(RAND() * 100), 's', 'ativo', '0'),
('Shape Astronautic Skull + Parafuso De Base + Lixa Emborrachada', 159.0, 8, 'Sobre a marca: A Wood Light é atualmente reconhecida c...', './img/produtos/Produto_5.png', FLOOR(RAND() * 100), 's', 'ativo', '0'),
('Skate Longboard completo Pgs - Psicodelico', 319.0, 12, 'Skate Longboard Completo Pgs tem o tamanho diferencia...', './img/produtos/Produto_6.png', FLOOR(RAND() * 100), 's', 'ativo', '0'),
('TÊNIS DC SHOES NEW FLASH II TX BLACK BROWN WHITE', 190.0, 6, 'O Tênis Dc Shoes New Flash II Tx, é um calçado que com...', './img/produtos/Produto_7.png', FLOOR(RAND() * 100), 's', 'ativo', '0'),
('CAMISETA THRASHER SCHORCHED PRETA', 139.9, 5, 'As camisetas Thrasher Magazine são para os mais insano...', './img/produtos/Produto_8.png', FLOOR(RAND() * 100), 's', 'ativo', '0'),
('Tênis Casual Unissex Original Skate Escolar Costurado Barato - Preto', 130.0, 12, 'PRODUTO ORIGINAL TÊNIS SKATE, ESCOLAR H1...', './img/produtos/tenis_dc_anvil_2_la_preto_natural_3808_1_20190301193417 (1).png', FLOOR(RAND() * 100), 's', 'ativo', '0');