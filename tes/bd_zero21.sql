drop database bd_teste;

CREATE DATABASE bd_teste;

USE bd_teste;


CREATE TABLE cliente(id_cliente INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    telefone VARCHAR(20) NOT NULL,
    endereco VARCHAR(255) NOT NULL);
    
INSERT INTO cliente VALUES (1, "Carlos Magno", "103.653.478-50", "(21) 97458-5124", "Rua A 231");
INSERT INTO cliente VALUES (2, "Fagner Oli", "147.956.874-30", "(21) 98547-3214", "Rua B 258");
INSERT INTO cliente VALUES (3, "Maria Eduarda", "478.124.753-15", "(21) 97896-1478", "Rua C 365");
INSERT INTO cliente VALUES (4, "João Silva", "369.852.147-25", "(21) 98745-6321", "Rua D 741");
INSERT INTO cliente VALUES (5, "Ana Costa", "852.147.369-98", "(21) 96587-3214", "Rua E 852");
INSERT INTO cliente VALUES (6, "Pedro Santos", "654.321.987-74", "(21) 97412-3658", "Rua F 963");
INSERT INTO cliente VALUES (7, "Juliana Oliveira", "258.963.741-85", "(21) 98547-6321", "Rua G 147");
INSERT INTO cliente VALUES (8, "Lucas Pereira", "147.258.369-74", "(21) 97852-1478", "Rua H 258");
INSERT INTO cliente VALUES (9, "Fernanda Souza", "369.741.852-36", "(21) 96587-9632", "Rua I 369");
INSERT INTO cliente VALUES (10, "Rodrigo Ferreira", "987.654.321-85", "(21) 96587-2587", "Rua J 741");
INSERT INTO cliente VALUES (11, "Cristina Lima", "741.369.852-14", "(21) 98547-3698", "Rua K 852");
INSERT INTO cliente VALUES (12, "José Oliveira", "852.369.741-63", "(21) 98745-1478", "Rua L 963");
INSERT INTO cliente VALUES (13, "Camila Costa", "369.852.147-98", "(21) 97412-6321", "Rua M 147");
INSERT INTO cliente VALUES (14, "Rafaela Silva", "987.654.321-25", "(21) 97852-3214", "Rua N 258");
INSERT INTO cliente VALUES (15, "Anderson Santos", "741.852.963-74", "(21) 96587-3658", "Rua O 369");
INSERT INTO cliente VALUES (16, "Amanda Ferreira", "147.369.852-85", "(21) 98547-1478", "Rua P 741");
INSERT INTO cliente VALUES (17, "Mariana Lima", "654.321.987-36", "(21) 98745-9632", "Rua Q 852");
INSERT INTO cliente VALUES (18, "Bruno Oliveira", "963.741.852-14", "(21) 96587-2587", "Rua R 963");
INSERT INTO cliente VALUES (19, "Patrícia Costa", "258.369.741-63", "(21) 97412-3698", "Rua S 147");
INSERT INTO cliente VALUES (20, "Roberto Silva", "852.222.369-98", "(21) 97852-6321", "Rua T 258");
INSERT INTO cliente VALUES (21, "Vanessa Santos", "369.333.147-25", "(21) 96587-3214", "Rua U 369");

truncate table cliente;

SELECT * FROM cliente;

CREATE TABLE log (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    acao VARCHAR(255) NOT NULL,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
);

INSERT INTO log (id_cliente, acao) VALUES (1, 'Inserção de cliente Carlos Magno');
INSERT INTO log (id_cliente, acao) VALUES (2, 'Inserção de cliente Fagner Oli');
INSERT INTO log (id_cliente, acao) VALUES (3, 'Inserção de cliente Maria Eduarda');
INSERT INTO log (id_cliente, acao) VALUES (4, 'Inserção de cliente João Silva');
INSERT INTO log (id_cliente, acao) VALUES (5, 'Inserção de cliente Ana Costa');
INSERT INTO log (id_cliente, acao) VALUES (6, 'Inserção de cliente Pedro Santos');
INSERT INTO log (id_cliente, acao) VALUES (7, 'Inserção de cliente Juliana Oliveira');
INSERT INTO log (id_cliente, acao) VALUES (8, 'Inserção de cliente Lucas Pereira');
INSERT INTO log (id_cliente, acao) VALUES (9, 'Inserção de cliente Fernanda Souza');
INSERT INTO log (id_cliente, acao) VALUES (10, 'Inserção de cliente Rodrigo Ferreira');


CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    imagem VARCHAR(255),
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL
);


CREATE TABLE estoque (
    id_produto INT,
    quantidade INT NOT NULL,
    FOREIGN KEY (id_produto) REFERENCES produtos(id)
);

CREATE TABLE carrinho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_produto INT,
    quantidade INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_produto) REFERENCES produtos(id)
);

-- Tabela para armazenar os detalhes do pedido
CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    produtos TEXT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    endereco_entrega TEXT NOT NULL,
    metodo_pagamento VARCHAR(50) NOT NULL,
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
);

INSERT INTO produtos (nome, imagem, descricao, preco) VALUES ('Intel Core I5 4570', 'I5-4570.jpg','Processador Intel Core I5 4570', 239.90);
INSERT INTO produtos (nome, imagem, descricao, preco) VALUES ('PC Gamer White', 'pc_branco.jpg','PC Gamer White Edition', 1229.90);
INSERT INTO produtos (nome, imagem, descricao, preco) VALUES ('PC Gamer Aquário', 'pc_aquario.jpg','PC Gamer Aquário', 2349.90);

INSERT INTO estoque VALUES (1, 20);
INSERT INTO estoque VALUES (2, 20);
INSERT INTO estoque VALUES (3, 20);

SELECT * FROM estoque;
SELECT * FROM carrinho;

truncate table log;


-- Desabilitar restrições de chave estrangeira
SET FOREIGN_KEY_CHECKS = 0;

-- Truncate a tabela cliente
TRUNCATE TABLE produtos;

-- Reabilitar restrições de chave estrangeira
SET FOREIGN_KEY_CHECKS = 1;

ALTER TABLE produtos ADD COLUMN imagem VARCHAR(255) AFTER nome;

DESC produtos;