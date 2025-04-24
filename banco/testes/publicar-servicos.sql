SET autocommit = 0;

START TRANSACTION;

BEGIN;

INSERT INTO PublicacaoServico
    (Titulo, Sobre, Valor, FKCategoria, FKUsuario, StatusPublicacao)
VALUES
    ('Vigilante de pestinhas', 'Cuido de catarrentos maiores de 10 anos.', 120.00, 1, 2, 'ATIVO'),
    ('Cuidador de idoso experiente', 'Cuido de qualquer idoso, até da sua sogra.', 240.60, 7, 1, 'EM_ANALISE'),
    ('Fotográfo para casamentos', 'Tiro as fotos do momento mais especial da sua vida.', 3230.53, 11, 3, 'BLOQUEADO'),
    ('Manicure e Pedicure especialista em francesinha', 'Faço pé e mão do jeito mais profissional, com o nariz', 530.54, 13, 4, 'ATIVO');

ROLLBACK;