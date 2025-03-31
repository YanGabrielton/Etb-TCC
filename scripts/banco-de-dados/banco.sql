DROP SCHEMA IF EXISTS JOB4YOU;

CREATE SCHEMA JOB4YOU
CHARACTER SET utf8
COLLATE utf8_general_ci;

USE JOB4YOU;

DROP TABLE IF EXISTS endereco;
CREATE TABLE endereco (
  id                INT AUTO_INCREMENT,
  cep               CHAR(8) NOT NULL CHECK (cep REGEXP '\\[0-9]{8}'),
  estado            CHAR(2) NOT NULL CHECK (estado REGEXP '\\[a-zA-Z]{2}'),
  cidade            VARCHAR(255) NOT NULL CHECK (length(cidade) > 1),
  bairro            VARCHAR(255) NOT NULL CHECK (length(bairro) > 1),
  rua               VARCHAR(255) NOT NULL CHECK (length(rua) > 1),
  PRIMARY KEY       (id)
);

DROP TABLE IF EXISTS conta_usuario;
CREATE TABLE conta_usuario (
  id                INT AUTO_INCREMENT,
  nome              VARCHAR(40) NOT NULL CHECK (length(nome) > 1),
  email             VARCHAR(100) NOT NULL CHECK (length(email) > 1),
  senha             CHAR(64) NOT NULL CHECK (length(senha) = 64),
  foto              TEXT NULL CHECK (foto IS NULL OR foto REGEXP '\\.(jpg|jpeg|png|webp|bmp)$'),
  celular           CHAR(11) NULL CHECK (celular REGEXP '\\[0-9]{11}'),
  data_criacao      TIMESTAMP DEFAULT (UTC_TIMESTAMP),
  status_conta      ENUM('ATIVO', 'EM_ANÁLISE', 'BLOQUEADO') DEFAULT 'EM_ANÁLISE',
  fk_endereco       INT NULL,
  PRIMARY KEY       (id),
  FOREIGN KEY       (fk_endereco) REFERENCES endereco(id) ON DELETE SET NULL ON UPDATE CASCADE
);

DROP TABLE IF EXISTS cliente;
CREATE TABLE cliente (
  id_conta_usuario  INT NOT NULL,
  cpf               CHAR(11) NOT NULL UNIQUE CHECK (cpf REGEXP '\\[0-9]{11}'),
  data_nascimento   DATE NOT NULL,
  PRIMARY KEY       (id_conta_usuario),
  FOREIGN KEY       (id_conta_usuario) REFERENCES conta_usuario(id) ON DELETE CASCADE ON UPDATE CASCADE
);

DROP TABLE IF EXISTS prestador;
CREATE TABLE prestador (
  id_conta_usuario  INT NOT NULL,
  cnpj              CHAR(14) NOT NULL UNIQUE CHECK (length(cnpj) = 14),
  curriculo         TEXT NOT NULL CHECK (curriculo REGEXP '\\.(pdf|jpg|jpeg|png|webp|bmp)$'),
  PRIMARY KEY       (id_conta_usuario),
  FOREIGN KEY       (id_conta_usuario) REFERENCES conta_usuario(id) ON DELETE CASCADE ON UPDATE CASCADE
);

DROP TABLE IF EXISTS categoria_servico;
CREATE TABLE categoria_servico (
  id                SMALLINT AUTO_INCREMENT,
  titulo            VARCHAR(25) NOT NULL CHECK (length(titulo) > 1),
  icone             VARCHAR(30) NOT NULL CHECK (length(icone) > 1),
  PRIMARY KEY       (id)
);

DROP TABLE IF EXISTS anuncio_servico;
CREATE TABLE anuncio_servico (
  id                INT AUTO_INCREMENT,
  titulo            VARCHAR(50) NOT NULL CHECK (length(titulo) > 1),
  sobre             VARCHAR(255) NULL,
  valor             DECIMAL(7,2) NOT NULL,
  categoria         SMALLINT NOT NULL,
  fk_prestador      INT NOT NULL,
  data_criacao      TIMESTAMP DEFAULT (UTC_TIMESTAMP),
  data_atualizacao  TIMESTAMP NULL,
  PRIMARY KEY       (id),
  FOREIGN KEY       (fk_prestador) REFERENCES prestador(id_conta_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY       (categoria) REFERENCES categoria_servico(id) ON DELETE CASCADE ON UPDATE CASCADE
);

DROP TABLE IF EXISTS servico;
CREATE TABLE servico (
  id                INT AUTO_INCREMENT,
  fk_cliente        INT NOT NULL,
  fk_prestador      INT NOT NULL,
  data_criacao      TIMESTAMP DEFAULT (UTC_TIMESTAMP),
  data_atualizacao  TIMESTAMP NULL,
  status_servico    ENUM('ACEITO', 'REJEITADO', 'PENDENTE', 'FINALIZADO') DEFAULT 'PENDENTE',
  PRIMARY KEY       (id),
  FOREIGN KEY       (fk_cliente) REFERENCES cliente(id_conta_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY       (fk_prestador) REFERENCES prestador(id_conta_usuario) ON DELETE CASCADE ON UPDATE CASCADE
);

DROP TABLE IF EXISTS servico_favorito_usuario;
CREATE TABLE servico_favorito_usuario (
  id_servico        INT NOT NULL,
  id_cliente        INT NOT NULL,
  PRIMARY KEY       (id_servico, id_cliente),
  FOREIGN KEY       (id_servico) REFERENCES anuncio_servico(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY       (id_cliente) REFERENCES cliente(id_conta_usuario) ON DELETE CASCADE ON UPDATE CASCADE
);

DROP TABLE IF EXISTS avaliacao;
CREATE TABLE avaliacao (
  id                INT AUTO_INCREMENT,
  nota_avaliacao    TINYINT NULL DEFAULT 0 CHECK(nota_avaliacao BETWEEN 0 AND 10),
  comentario        TEXT NULL,
  data_criacao      TIMESTAMP DEFAULT (UTC_TIMESTAMP),
  data_atualizacao  TIMESTAMP NULL,
  PRIMARY KEY       (id)
);

DROP TABLE IF EXISTS avaliacao_cliente;
CREATE TABLE avaliacao_cliente (
  id_avaliacao      INT NOT NULL,
  fk_prestador      INT NOT NULL,
  fk_cliente        INT NOT NULL,
  PRIMARY KEY       (id_avaliacao),
  FOREIGN KEY       (id_avaliacao) REFERENCES avaliacao(id),
  FOREIGN KEY       (fk_prestador) REFERENCES prestador(id_conta_usuario),
  FOREIGN KEY       (fk_cliente) REFERENCES cliente(id_conta_usuario)
);

DROP TABLE IF EXISTS avaliacao_servico;
CREATE TABLE avaliacao_servico (
  id_avaliacao      INT NOT NULL,
  fk_servico        INT NOT NULL,
  fk_prestador      INT NOT NULL,
  PRIMARY KEY       (id_avaliacao),
  FOREIGN KEY       (id_avaliacao) REFERENCES avaliacao(id),
  FOREIGN KEY       (fk_servico) REFERENCES servico(id),
  FOREIGN KEY       (fk_prestador) REFERENCES prestador(id_conta_usuario)
);