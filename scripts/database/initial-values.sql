USE `tcc_database`;

-- Inserindo valores na tabela 'usuario'
INSERT INTO `usuario` (nome, cpf, email, senha, foto, celular, data_nascimento, tipo, situacao) VALUES
  (
    'João Silva',
    '12345678901',
    'joao.silva@example.com',
    '0586c8116e212fd39c228d97c5f699303ca7635fe9483e1ad526056ab2b271a1',
    NULL,
    '61999999999',
    '2000-01-01',
    'CLIENTE'
  ),
  (
    'Maria Oliveira',
    '12345678000',
    'maria.oliveira@example.com',
    '318b054eaaaf2a62a7881bab13e5872790741b19dac9e8695634ae48f0e6acf7',
    NULL,
    '6133333333',
    '2000-01-01',
    'PRESTADOR_SERVICO'
  ),
  (
    'Admin'
    '98765432154',
    'admin@example.com',
    'dc97f93426094116d4eda8c41f1fd255c42246dcb9dff167cc4313a7f22ad987',
    NULL,
    '6100000000',
    '2000-01-01',
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
