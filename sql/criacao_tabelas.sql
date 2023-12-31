CREATE TABLE IF NOT EXISTS user_control (
    id_user_control INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE KEY,
    senha VARCHAR(60) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS cliente (
    id_cliente INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE KEY,
    senha VARCHAR(60) NOT NULL,
    razao_social VARCHAR(255) NOT NULL,
    cnpj VARCHAR(14) NOT NULL UNIQUE KEY,
    nome VARCHAR(255) NOT NULL,
    token VARCHAR(32) NOT NULL,
    verificado BOOLEAN NOT NULL DEFAULT FALSE,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS pedido (
	id_pedido INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    data DATE NOT NULL,
    numero INT NOT NULL UNIQUE KEY,
    total DECIMAL(10,2),
    status ENUM("PENDENTE", "AGUARDANDO", "CANCELADO", "APROVADO", "FINALIZADO"),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS equipamento (
    id_equipamento INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    tipo ENUM("COLETOR","RESERVATORIO","MODULO"),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS teste (
    id_teste INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    valor DECIMAL(10,2),
    descricao VARCHAR(255),
    nome VARCHAR(255),
    tipo_equipamento ENUM("COLETOR","RESERVATORIO","MODULO"),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS equipamento_teste(
    id_equipamento INT(11) NOT NULL,
    id_teste INT(11) NOT NULL,
    status ENUM("EM_ANDAMENTO", "FINALIZADO"),
    PRIMARY KEY (id_equipamento, id_teste),
    FOREIGN KEY (id_equipamento) REFERENCES equipamento(id_equipamento),
    FOREIGN KEY (id_teste) REFERENCES teste(id_teste),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

ALTER TABLE pedido
ADD COLUMN id_cliente INT(11) NOT NULL,
ADD FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente);

ALTER TABLE equipamento
ADD COLUMN id_pedido INT(11) NOT NULL,
ADD FOREIGN KEY (id_pedido) REFERENCES pedido(id_pedido);

CREATE TABLE IF NOT EXISTS numeracao_pedido (
	id INT NOT null primary key,
    numero INT NOT NULL DEFAULT 1000
);

INSERT into numeracao_pedido (id, numero) values (1,1000);

DELIMITER //
CREATE FUNCTION proximo_numero() RETURNS INT
BEGIN
	DECLARE valor INT;
    UPDATE numeracao_pedido SET numero = numero + 1 WHERE id = 1;
    SELECT numero INTO valor FROM numeracao_pedido WHERE id = 1;
    RETURN valor;
END;
//
DELIMITER ;

CREATE TABLE IF NOT EXISTS mailer(
id INT NOT NULL PRIMARY KEY,
senha VARCHAR(128) NOT NULL
);

INSERT INTO mailer (id, senha) VALUES (1,'senha_nao_definida');