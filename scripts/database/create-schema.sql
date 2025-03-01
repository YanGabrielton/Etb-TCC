CREATE DATABASE IF NOT EXISTS `tcc_database`
CHARACTER SET utf8 -- Codificação de caracteres
COLLATE utf8_general_ci; -- Comparação de strings insensível a maiúsculas e minúsculas

USE `tcc_database`;

CREATE TABLE IF NOT EXISTS `usuario` (
  id BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  nome VARCHAR(100) NOT NULL,
  cpf CHAR(11) NULL, -- Passível de criptografia
  cnpj CHAR(14) NULL, -- Passível de criptografia
  email VARCHAR(100) UNIQUE NOT NULL,
  senha CHAR(64) NOT NULL, -- ex: hash(sha256)
  foto VARCHAR(64) NULL, -- Renomear nome do arquivo para um hash, ao armazenar o caminho do arquivo
  celular VARCHAR(12) NULL, -- ex: 6133333333 ou 61999999999
  tipo ENUM ('CLIENTE', 'PRESTADOR_SERVICO', 'ADMINISTRADOR') NOT NULL,
  situacao ENUM ('ATIVO', 'BLOQUEADO') DEFAULT 'ATIVO',
    CHECK (cpf IS NOT NULL OR cnpj IS NOT NULL) -- CPF ou CNPJ devem ser preenchidos
);

CREATE TABLE IF NOT EXISTS `endereco` (
  id BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  cidade VARCHAR(100) NOT NULL,
  estado CHAR(2) NOT NULL, -- ex: DF ou SP ou GO... 
  bairro VARCHAR(100) NOT NULL,
  rua VARCHAR(100) NOT NULL,
  cep CHAR(8) NOT NULL, -- ex: 80800800
  fk_usuario BIGINT NOT NULL,
    FOREIGN KEY (fk_usuario) REFERENCES usuario (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `anuncio_servico` (
  id BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  titulo VARCHAR(100) NOT NULL,
  descricao TEXT NULL,
  valor DECIMAL(7, 2) NOT NULL, -- Valores até 99_999,99
  categoria VARCHAR(64) NULL, -- ex: Babá, Cozinheiro, Diarista, Estética...
  data_criacao TIMESTAMP NOT NULL DEFAULT (UTC_TIMESTAMP), -- Data e hora sem marcação de fuso
  fk_prestador_servico BIGINT NOT NULL,
    FOREIGN KEY (fk_prestador_servico) REFERENCES usuario (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `servico_favorito_usuario` (
  fk_usuario BIGINT NOT NULL,
  fk_anuncio_servico BIGINT NOT NULL,
    FOREIGN KEY (fk_usuario) REFERENCES usuario (id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (fk_anuncio_servico) REFERENCES anuncio_servico (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS `avaliacao_servico` (
  id BIGINT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  nota TINYINT UNSIGNED NOT NULL DEFAULT 0, -- Salva apenas números positivos
  comentario TEXT NULL,
  data_hora TIMESTAMP NOT NULL DEFAULT (UTC_TIMESTAMP),
  fk_usuario BIGINT NOT NULL,
  fk_anuncio_servico BIGINT NOT NULL,
    FOREIGN KEY (fk_usuario) REFERENCES usuario (id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (fk_anuncio_servico) REFERENCES anuncio_servico (id) ON DELETE CASCADE ON UPDATE CASCADE
);