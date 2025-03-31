-- Inserindo registros na tabela endereco
INSERT INTO endereco (cep, estado, cidade, bairro, rua) VALUES
('12345678', 'SP', 'São Paulo', 'Centro', 'Rua A'),
('87654321', 'RJ', 'Rio de Janeiro', 'Copacabana', 'Rua B'),
('11223344', 'MG', 'Belo Horizonte', 'Savassi', 'Rua C'),
('44332211', 'RS', 'Porto Alegre', 'Moinhos', 'Rua D'),
('55667788', 'BA', 'Salvador', 'Barra', 'Rua E');

-- Inserindo registros na tabela conta_usuario
INSERT INTO conta_usuario (nome, email, senha, foto, celular, fk_endereco) VALUES
('João Silva', 'joao@email.com', SHA2('senha123', 256), NULL, '11999999999', 1),
('Maria Oliveira', 'maria@email.com', SHA2('senha123', 256), NULL, '21988888888', 2),
('Carlos Souza', 'carlos@email.com', SHA2('senha123', 256), NULL, '31977777777', 3),
('Ana Costa', 'ana@email.com', SHA2('senha123', 256), NULL, '41966666666', 4),
('Pedro Lima', 'pedro@email.com', SHA2('senha123', 256), NULL, '51955555555', 5);

-- Inserindo registros na tabela cliente
INSERT INTO cliente (id_conta_usuario, cpf, data_nascimento) VALUES
(1, '12345678901', '1990-01-01'),
(2, '23456789012', '1985-02-02'),
(3, '34567890123', '1992-03-03'),
(4, '45678901234', '1988-04-04'),
(5, '56789012345', '1995-05-05');

-- Inserindo registros na tabela prestador
INSERT INTO prestador (id_conta_usuario, cnpj, curriculo) VALUES
(1, '12345678000101', 'curriculo1.pdf'),
(2, '23456789000102', 'curriculo2.pdf'),
(3, '34567890000103', 'curriculo3.pdf'),
(4, '45678900000104', 'curriculo4.pdf'),
(5, '56789000000105', 'curriculo5.pdf');

-- Inserindo registros na tabela categoria_servico
INSERT INTO categoria_servico (titulo, icone) VALUES
('Eletricista', 'eletricista.png'),
('Encanador', 'encanador.png'),
('Pintor', 'pintor.png'),
('Jardineiro', 'jardineiro.png'),
('Marceneiro', 'marceneiro.png');

-- Inserindo registros na tabela anuncio_servico
INSERT INTO anuncio_servico (titulo, sobre, valor, categoria, fk_prestador) VALUES
('Troca de Fiação', 'Troca completa de fiação elétrica', 500.00, 1, 1),
('Conserto de Canos', 'Reparo em encanamentos', 300.00, 2, 2),
('Pintura de Parede', 'Pintura de interiores', 200.00, 3, 3),
('Manutenção de Jardim', 'Corte e poda de plantas', 150.00, 4, 4),
('Montagem de Móveis', 'Montagem de móveis planejados', 250.00, 5, 5);

-- Inserindo registros na tabela servico
INSERT INTO servico (fk_cliente, fk_prestador, status_servico) VALUES
(1, 2, 'PENDENTE'),
(2, 3, 'ACEITO'),
(3, 4, 'FINALIZADO'),
(4, 5, 'REJEITADO'),
(5, 1, 'PENDENTE');

-- Inserindo registros na tabela avaliacao
INSERT INTO avaliacao (nota_avaliacao, comentario) VALUES
(8, 'Ótimo serviço!'),
(9, 'Muito bom, recomendo.'),
(7, 'Satisfeito com o trabalho.'),
(10, 'Excelente!'),
(6, 'Pode melhorar.');

-- Inserindo registros na tabela avaliacao_cliente
INSERT INTO avaliacao_cliente (id_avaliacao, fk_prestador, fk_cliente) VALUES
(1, 2, 1),
(2, 3, 2),
(3, 4, 3),
(4, 5, 4),
(5, 1, 5);

-- Inserindo registros na tabela avaliacao_servico
INSERT INTO avaliacao_servico (id_avaliacao, fk_servico, fk_prestador) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 4),
(4, 4, 5),
(5, 5, 1);