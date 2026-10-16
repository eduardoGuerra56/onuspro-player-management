-- ONUSPRO Player Management
-- Cria o banco, as tabelas e dados de exemplo (fictícios).

CREATE DATABASE IF NOT EXISTS onuspro DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE onuspro;

-- Usuários que podem acessar o painel (gestores da organização)
CREATE TABLE IF NOT EXISTS usuarios (
  id    INT          NOT NULL AUTO_INCREMENT,
  nome  VARCHAR(140) DEFAULT NULL,
  user  VARCHAR(255) NOT NULL,
  senha VARCHAR(255) NOT NULL COMMENT 'Hash gerado com password_hash()',
  PRIMARY KEY (id),
  UNIQUE KEY uk_usuarios_user (user)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Jogadores da line oficial da organização
CREATE TABLE IF NOT EXISTS players (
  cpf        CHAR(11)     NOT NULL,
  nick       VARCHAR(245) NOT NULL,
  nome       VARCHAR(45)  NOT NULL,
  email      VARCHAR(255) NOT NULL,
  nascimento DATE         NOT NULL,
  PRIMARY KEY (cpf)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Usuário de demonstração -> login: teste | senha: teste
INSERT INTO usuarios (nome, user, senha) VALUES
  ('Usuário Teste', 'teste', '$2y$10$xzY.ltn.bJNaJS/era29pOAnt/2IEOCGiQPE/IT7x8jjvfFvKlx0G');

-- Players de exemplo (dados fictícios)
INSERT INTO players (cpf, nick, nome, email, nascimento) VALUES
  ('00000000001', 'Shadow', 'Lucas Andrade', 'shadow@exemplo.com', '2002-03-14'),
  ('00000000002', 'Viper',  'Mariana Costa', 'viper@exemplo.com',  '2001-11-02'),
  ('00000000003', 'Tank',   'Rafael Lima',   'tank@exemplo.com',   '2003-07-21');
