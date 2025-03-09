CREATE DATABASE IF NOT EXISTS `tcc_database`
CHARACTER SET utf8 -- Codificação de caracteres
COLLATE utf8_general_ci; -- Comparação de strings insensível a maiúsculas e minúsculas

USE `tcc_database`;

CREATE TABLE IF NOT EXISTS `usuario` (
  id_usuario BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  cpf CHAR(11) NOT NULL,
  nome VARCHAR(100) NOT NULL,
  data_nascimento DATE NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  senha CHAR(64) NOT NULL, -- hash(sha256)
  foto VARCHAR(72) NULL,
  celular CHAR(11) NULL,
  tipo ENUM ('CLIENTE', 'PRESTADOR_SERVICO', 'ADMINISTRADOR') NOT NULL,
  situacao ENUM ('ATIVO', 'BLOQUEADO') DEFAULT 'ATIVO',
);

CREATE TABLE IF NOT EXISTS `endereco` (
  id_endereco BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  cidade VARCHAR(100) NOT NULL,
  estado CHAR(2) NOT NULL,
  bairro VARCHAR(100) NOT NULL,
  rua VARCHAR(100) NOT NULL,
  cep CHAR(8) NOT NULL,
  fk_usuario BIGINT NOT NULL,
  FOREIGN KEY (fk_usuario)
    REFERENCES usuario (id_usuario)
    ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `anuncio_servico` (
  id_anuncio_servico BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  titulo VARCHAR(100) NOT NULL,
  valor DECIMAL(7, 2) NOT NULL, -- Valores até 99_999,99
  descricao TEXT NULL,
  categoria VARCHAR(64) NULL,
  data_criacao TIMESTAMP NOT NULL DEFAULT (UTC_TIMESTAMP),
  fk_prestador_servico BIGINT NOT NULL,
  FOREIGN KEY (fk_prestador_servico)
    REFERENCES usuario (id_usuario)
    ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `servico_favorito_usuario` (
  fk_usuario BIGINT NOT NULL,
  fk_anuncio_servico BIGINT NOT NULL,
  FOREIGN KEY (fk_usuario)
    REFERENCES usuario (id_usuario)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (fk_anuncio_servico)
    REFERENCES anuncio_servico (id_anuncio_servico)
    ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `avaliacao_servico` (
  id_avaliacao_servico BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  nota TINYINT UNSIGNED NOT NULL DEFAULT 0, -- Salva apenas números positivos
  comentario TEXT NULL,
  data_hora TIMESTAMP NOT NULL DEFAULT (UTC_TIMESTAMP),
  fk_usuario BIGINT NOT NULL,
  fk_anuncio_servico BIGINT NOT NULL,
  FOREIGN KEY (fk_usuario)
    REFERENCES usuario (id_usuario)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (fk_anuncio_servico)
    REFERENCES anuncio_servico (id_anuncio_servico)
    ON DELETE CASCADE ON UPDATE CASCADE
);