CREATE DATABASE IF NOT EXISTS JOB4YOU
CHARACTER SET utf8
COLLATE utf8_general_ci;

USE JOB4YOU;

CREATE TABLE endereco (
  _id               INT AUTO_INCREMENT PRIMARY KEY,
  cep               CHAR(8) NOT NULL,
  estado            CHAR(2) NOT NULL,
  cidade            TEXT NOT NULL,
  bairro            TEXT NOT NULL,
  rua               TEXT NOT NULL
) ENGINE=InnoDB;

CREATE TABLE conta_usuario (
  _id               INT AUTO_INCREMENT PRIMARY KEY,
  nome              VARCHAR(40) NOT NULL CHECK (length(nome) > 0),
  email             VARCHAR(100) NOT NULL CHECK (length(email) > 0),
  senha             CHAR(64) NOT NULL CHECK (length(senha) > 0),
  foto              TEXT NULL CHECK (foto IS NULL OR foto REGEXP '\\.(jpg|jpeg|png|webp|bmp)$'),
  celular           CHAR(11) NULL,
  data_criacao      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status            ENUM('ATIVO', 'EM_ANÁLISE', 'BLOQUEADO') DEFAULT 'EM_ANÁLISE',
  chave_endereco    INT NULL,
  FOREIGN KEY (chave_endereco) REFERENCES endereco(_id)
) ENGINE=InnoDB;


CREATE TABLE cliente (
  _id               INT AUTO_INCREMENT PRIMARY KEY,
  chave_usuario     INT NOT NULL,
  cpf               CHAR(11) NOT NULL UNIQUE CHECK (length(cpf) > 0),
  data_nascimento   DATE NOT NULL,
  FOREIGN KEY (chave_usuario) REFERENCES conta_usuario(_id)
) ENGINE=InnoDB;

CREATE TABLE prestador (
  _id               INT AUTO_INCREMENT PRIMARY KEY,
  chave_usuario     INT NOT NULL,
  cnpj              CHAR(14) NOT NULL UNIQUE CHECK (length(cnpj) > 0),
  curriculo         TEXT NOT NULL CHECK (length(curriculo) > 0 AND curriculo REGEXP '\\.(pdf|jpg|jpeg|png|webp|bmp)$'),
  FOREIGN KEY (chave_usuario) REFERENCES conta_usuario(_id)
) ENGINE=InnoDB;

CREATE TABLE categoria_servico (
  _id               SMALLINT AUTO_INCREMENT PRIMARY KEY,
  titulo            TEXT NOT NULL CHECK (length(titulo) > 0),
  nome_icone        TEXT NOT NULL CHECK (length(nome_icone) > 0)
) ENGINE=InnoDB;

CREATE TABLE anuncio_servico (
  _id               INT AUTO_INCREMENT PRIMARY KEY,
  titulo            VARCHAR(50) NOT NULL CHECK (length(titulo) > 0),
  descricao         TEXT NULL,
  preco             DECIMAL(7,2) NOT NULL,
  categoria         SMALLINT NOT NULL,
  data_criacao      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao  TIMESTAMP NULL,
  FOREIGN KEY (categoria) REFERENCES categoria_servico(_id)
) ENGINE=InnoDB;

CREATE TABLE servico_funcionario (
  _id               INT AUTO_INCREMENT PRIMARY KEY,
  inicio_em         TIMESTAMP NOT NULL,
  fim_em            TIMESTAMP NOT NULL,
  duracao           TIMESTAMP GENERATED ALWAYS AS (TIMEDIFF(fim_em, inicio_em)) VIRTUAL,
  chave_cliente     INT NOT NULL,
  chave_funcionario INT NOT NULL,
  chave_endereco    INT NOT NULL,
  data_criacao      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao  TIMESTAMP NULL,
  status            ENUM('ACCEPTED', 'REJECTED', 'PENDING', 'WELL_DONE!') DEFAULT 'PENDING',
  FOREIGN KEY (chave_cliente) REFERENCES cliente(_id),
  FOREIGN KEY (chave_funcionario) REFERENCES prestador(_id),
  FOREIGN KEY (chave_endereco) REFERENCES endereco(_id)
) ENGINE=InnoDB;

CREATE TABLE servico_favorito_usuario (
  chave_servico     INT NOT NULL,
  chave_cliente     INT NOT NULL,
  FOREIGN KEY (chave_servico) REFERENCES anuncio_servico(_id),
  FOREIGN KEY (chave_cliente) REFERENCES cliente(_id)
) ENGINE=InnoDB;

CREATE TABLE avaliacao_cliente (
  _id               INT AUTO_INCREMENT PRIMARY KEY,
  nota_avaliacao    SMALLINT NULL DEFAULT 0 CHECK(nota_avaliacao BETWEEN 0 AND 10),
  comentario        TEXT NULL,
  data_criacao      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao  TIMESTAMP NULL,
  chave_funcionario INT NOT NULL,
  chave_cliente     INT NOT NULL,
  FOREIGN KEY (chave_funcionario) REFERENCES prestador(_id),
  FOREIGN KEY (chave_cliente) REFERENCES cliente(_id)
) ENGINE=InnoDB;

CREATE TABLE avaliacao_servico (
  _id               INT AUTO_INCREMENT PRIMARY KEY,
  nota_avaliacao    SMALLINT NULL DEFAULT 0 CHECK(nota_avaliacao BETWEEN 0 AND 10),
  comentario        TEXT NULL,
  data_criacao      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_atualizacao  TIMESTAMP NULL,
  chave_servico     INT NOT NULL,
  chave_funcionario INT NOT NULL,
  FOREIGN KEY (chave_servico) REFERENCES servico_funcionario(_id),
  FOREIGN KEY (chave_funcionario) REFERENCES prestador(_id)
) ENGINE=InnoDB;