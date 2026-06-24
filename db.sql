-- 1. CRIAÇÃO DO BANCO DE DADOS
-- Usamos o charset utf8mb4 que é o padrão recomendado para o MySQL 8.0 no Docker
CREATE DATABASE IF NOT EXISTS copa_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE copa_db;

-- 2. LIMPEZA DE TABELAS (Opcional - útil para quando reiniciar o contêiner)
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS campeonato;
DROP TABLE IF EXISTS jogo;
DROP TABLE IF EXISTS selecao;
DROP TABLE IF EXISTS bolao;
SET FOREIGN_KEY_CHECKS = 1;

-- 3. CRIAÇÃO DAS TABELAS COM ENGINE INNODB (Padrão do MySQL do Docker)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    adm BOOLEAN NOT NULL
) ENGINE=InnoDB;

CREATE TABLE campeonato (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE selecao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE jogo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    campeonato INT NOT NULL,
    selecao1 INT NOT NULL,
    selecao2 INT NOT NULL,
    resultado_selecao1 INT,
    resultado_selecao2 INT,
    CONSTRAINT fk_campeonato FOREIGN KEY (campeonato) 
        REFERENCES campeonato(id) ON DELETE CASCADE,
    CONSTRAINT fk_selecao1 FOREIGN KEY (selecao1) 
        REFERENCES selecao(id) ON DELETE RESTRICT,
    CONSTRAINT fk_selecao2 FOREIGN KEY (selecao2) 
        REFERENCES selecao(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE bolao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jogo INT NOT NULL,
    usuario INT NOT NULL, 
    resultado_selecao1 INT NOT NULL,
    resultado_selecao2 INT NOT NULL,
    CONSTRAINT fk_jogo FOREIGN KEY (jogo) 
        REFERENCES jogo(id) ON DELETE CASCADE,
    CONSTRAINT fk_usuario FOREIGN KEY (usuario) 
        REFERENCES selecao(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 4. INSERÇÃO DE DADOS INICIAIS
INSERT INTO usuarios (nome, senha, adm) VALUES 
('Administrador', '12345678', 1),
('João Silva', 'user_2026', 0);
