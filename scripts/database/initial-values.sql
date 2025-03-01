USE `tcc_database`;

-- Inserindo valores na tabela 'usuario'
INSERT INTO `usuario` (nome, cpf, cnpj, email, senha, foto, celular, tipo, situacao) VALUES
  (
    'João Silva',
    '12345678901',
    NULL,
    'joao.silva@example.com',
    '2c26b46b68ffc68ff99b453c1d30413413422f1640d5e8a2d8e6a4d7f8a4e7e3',
    NULL,
    '61999999999',
    'CLIENTE'
  ),
  (
    'Maria Oliveira',
    NULL,
    '12345678000199',
    'maria.oliveira@example.com',
    '3a7bd3e2360a3d5b2f8a4d7f8a4e7e3d8e6a4d7f8a4e7e3d8e6a4d7f8a4e7e3d',
    NULL,
    '6133333333',
    'PRESTADOR_SERVICO'
  ),
  (
    'Admin'
    '98765432154',
    NULL,
    'admin@example.com',
    '5e884898da28047151d0e56f8dc6292773603d0d6aabbddc8a3d7f8a4e7e3d8e',
    NULL,
    '6100000000',
    'ADMINISTRADOR'
  );

-- Inserindo valores na tabela 'endereco'
INSERT INTO `endereco` (cidade, estado, bairro, rua, cep, fk_usuario) VALUES
('Brasília', 'DF', 'Asa Norte', 'Rua 1', '70000000', 1),
('São Paulo', 'SP', 'Centro', 'Rua 2', '01000000', 2);

-- Inserindo valores na tabela 'anuncio_servico'
INSERT INTO `anuncio_servico` (titulo, descricao, valor, categoria, fk_prestador_servico) VALUES
('Serviço de Babá', 'Babá experiente para cuidar de crianças.', 200.00, 'Babá', 2),
('Serviço de Passear com o cachorro', 'O melhor passeio para o seu doguinho!', 150.00, 'Passeador de Cães', 2);

-- Inserindo valores na tabela 'servico_favorito_usuario'
INSERT INTO `servico_favorito_usuario` (fk_usuario, fk_anuncio_servico) VALUES
(1, 1),
(1, 2);

-- Inserindo valores na tabela 'avaliacao_servico'
INSERT INTO `avaliacao_servico` (nota, comentario, fk_usuario, fk_anuncio_servico) VALUES
(5, 'Excelente serviço!', 1, 1),
(4, 'Muito bom, recomendo.', 1, 2);
