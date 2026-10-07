-- ===============================================================
--  Banco de dados da aplicação vulnerável — Sprint 2 (XSS)
--  IFB — Segurança em Aplicações 2026/1
--
--  COMO USAR:
--  1. Abra o phpMyAdmin (http://localhost/phpmyadmin no XAMPP)
--  2. Vá em "Importar" e selecione este arquivo
--     (ou cole o conteúdo na aba "SQL" e execute)
-- ===============================================================

CREATE DATABASE IF NOT EXISTS app_xss CHARACTER SET utf8mb4;
USE app_xss;

-- Tabela de usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id    INT PRIMARY KEY AUTO_INCREMENT,
    nome  VARCHAR(100),
    email VARCHAR(100),
    role  VARCHAR(20) DEFAULT 'user'
);

-- Tabela de comentários (usada no Stored XSS)
CREATE TABLE IF NOT EXISTS comentarios (
    id           INT PRIMARY KEY AUTO_INCREMENT,
    autor        VARCHAR(100) DEFAULT 'Anônimo',
    texto        TEXT,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Dados de exemplo
INSERT INTO usuarios (nome, email, role) VALUES
    ('Maria Silva', 'maria@email.com', 'user'),
    ('João Santos', 'joao@email.com',  'user'),
    ('Admin',       'admin@email.com', 'admin');

INSERT INTO comentarios (autor, texto) VALUES
    ('Maria Silva', 'Adorei o produto, recomendo!'),
    ('João Santos', 'Entrega rápida, nota 10.');
