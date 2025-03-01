USE `tcc_database`;

-- Inserindo valores na tabela 'usuario'
INSERT INTO `usuario` (nome, cpf, cnpj, email, senha, foto, celular, tipo) VALUES
('João Silva', '12345678901', NULL, 'joao.silva@example.com', 'hash_senha_joao', NULL, '61999999999', 'CLIENTE'),
('Maria Oliveira', NULL, '12345678000199', 'maria.oliveira@example.com', 'hash_senha_maria', NULL, '6133333333', 'PRESTADOR_SERVICO'),
('Admin', '98765432154', NULL, 'adminone@example.com', 'hash_senha_admin', NULL, '62988888888', 'ADMINISTRADOR');

-- Inserindo valores na tabela 'endereco'
INSERT INTO `endereco` (cidade, estado, bairro, rua, cep, fk_usuario) VALUES
('Brasília', 'DF', 'Asa Norte', 'Rua 1', '70000000', 1),
('São Paulo', 'SP', 'Centro', 'Rua 2', '01000000', 2);

-- Inserindo valores na tabela 'anuncio_servico'
INSERT INTO `anuncio_servico` (titulo, descricao, valor, categoria, data_criacao, fk_prestador_servico) VALUES
('Serviço de Babá', 'Babá experiente para cuidar de crianças', 150.00, 'Babá', UTC_TIMESTAMP(), 2),
('Serviço de Cozinheiro', 'Cozinheiro profissional para eventos', 200.00, 'Cozinheiro', UTC_TIMESTAMP(), 2);

-- Inserindo valores na tabela 'servico_favorito_usuario'
INSERT INTO `servico_favorito_usuario` (fk_usuario, fk_anuncio_servico) VALUES
(1, 1),
(1, 2);

-- Inserindo valores na tabela 'avaliacao_servico'
INSERT INTO `avaliacao_servico` (nota, comentario, data_hora, fk_usuario, fk_anuncio_servico) VALUES
(5, 'Excelente serviço!', UTC_TIMESTAMP(), 1, 1),
(4, 'Muito bom, recomendo.', UTC_TIMESTAMP(), 1, 2);
