SHOW DATABASES;
use zero21;
SHOW TABLES;

select * from dados_pessoais;

CREATE TABLE dados_pessoais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(255) NOT NULL,
    data_nascimento DATE NOT NULL,
    nome_materno VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    genero VARCHAR(10) NOT NULL,
    telefone_celular VARCHAR(15),
    telefone_fixo VARCHAR(15),
    nome_usuario VARCHAR(50),
    email VARCHAR(255),
    senha VARCHAR(255),
    cep VARCHAR(10),
    rua VARCHAR(255),
    complemento VARCHAR(255),
    bairro VARCHAR(255),
    cidade VARCHAR(255),
    estado VARCHAR(50)
);

CREATE TABLE log (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id INT,
    acao VARCHAR(255) NOT NULL,
    data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id) REFERENCES dados_pessoais(id)
);

CREATE TABLE avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_usuario VARCHAR(255) NOT NULL,
    avaliacao TEXT NOT NULL,
    estrelas INT NOT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    preco DECIMAL(10, 2),
    descricao TEXT,
    imagem VARCHAR(255)
);

CREATE TABLE carrinho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT,
    qtd INT,
    preco DECIMAL(10, 2),
    total DECIMAL(10, 2),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

CREATE TABLE estoque (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT,
    quantidade INT NOT NULL,
    ultima_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

SELECT * FROM carrinho;
SELECT * FROM produtos;

INSERT INTO produtos VALUES(1, "Camisa Bangu I", '149.90', "camisa do time de futebol bangu", 'http://localhost/tes/images/Bangu.jpeg');
INSERT INTO produtos VALUES(2, "Camisa Campo Grande I", '149.90', "camisa do time de futebol Campo Grande", 'http://localhost/tes/images/Campo%20Grande.jpeg');
INSERT INTO produtos VALUES(3, "Camisa Botafogo I", '149.90', "camisa do time de futebol Botafogo I", 'http://localhost/tes/images/Botafogo-1.png');
INSERT INTO produtos VALUES(4, "Camisa Botafogo II", '149.90', "camisa do time de futebol Botafogo II", 'http://localhost/tes/images/Botafogo-2.png');
INSERT INTO produtos VALUES(5, "Camisa Flamengo I", '149.90', "camisa do time de futebol Flamengo I", 'http://localhost/tes/images/Flamengo-1.png');
INSERT INTO produtos VALUES(6, "Camisa Falmengo II", '149.90', "camisa do time de futebol Flamengo II", 'http://localhost/tes/images/Flamengo-2.png');
INSERT INTO produtos VALUES(7, "Camisa Fluminense I", '149.90', "camisa do time de futebol Fluminense I", 'http://localhost/tes/images/Fluminense.png');
INSERT INTO produtos VALUES(8, "Camisa Fluminense II", '149.90', "camisa do time de futebol Fluminense II", 'http://localhost/tes/images/Fluminense-2.png');
INSERT INTO produtos VALUES(9, "Camisa Madureira I", '149.90', "camisa do time de futebol Madureira I", 'http://localhost/tes/images/Madureira.jpeg');
INSERT INTO produtos VALUES(10, "Camisa Nova Iguaçu I", '149.90', "camisa do time de futebol Nova Iguaçu I", 'http://localhost/tes/images/Nova%20Igua%C3%A7u.jpeg');
INSERT INTO produtos VALUES(11, "Camisa Vasco I", '149.90', "camisa do time de futebol Vasco I", 'http://localhost/tes/images/Vasco-1.png');
INSERT INTO produtos VALUES(12, "Camisa Vasco II", '149.90', "camisa do time de futebol Vasco II", 'http://localhost/tes/images/Vasco.png');







DELIMITER //

CREATE TRIGGER after_insert_produto
AFTER INSERT ON produtos
FOR EACH ROW
BEGIN
    INSERT INTO estoque (produto_id, quantidade, ultima_atualizacao) VALUES (NEW.id, 0, NOW());
END //

DELIMITER ;

-- Consultas
SELECT * FROM carrinho;
SELECT * FROM produtos;

-- Inserção de produtos
INSERT INTO produtos (nome, preco, descricao, imagem) VALUES ("Camisa Bangu I", 149.90, "camisa do time de futebol de bangu", 'http://localhost/tes/images/Bangu.jpeg');
INSERT INTO produtos (nome, preco, descricao, imagem) VALUES ("Camisa Bangu II", 149.90, "segunda camisa do time de futebol de bangu", 'http://localhost/tes/images/Bangu2.jpeg');

-- Consultas adicionais
SELECT * FROM estoque;
SELECT * FROM produtos;

UPDATE estoque SET quantidade=100 WHERE id IN (15,16,17,18,19,20,21,22,23,24,25,26);

select * from avaliacoes;

DElIMITER //	
truncate table produtos ;
DELIMITER ;

-- Desabilitar restrições de chave estrangeira
SET FOREIGN_KEY_CHECKS = 0;

-- Truncate a tabela cliente
delete from produtos WHERE id IN (1,2,3,4,5,6,7,8,9,10,11,12);

-- Reabilitar restrições de chave estrangeira
SET FOREIGN_KEY_CHECKS = 1;


ALTER TABLE avaliacoes ADD produto_id INT;

select * from dados_pessoais;

show tables;

