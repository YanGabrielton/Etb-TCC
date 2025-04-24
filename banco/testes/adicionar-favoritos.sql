SET autocommit = 0;

START TRANSACTION;

BEGIN;

INSERT INTO ServicoFavorito (IDUsuario, IDServico) VALUES
    (1, 1),
    (1, 3),
    (3, 2),
    (4, 3),
    (2, 4),
    (4, 2);

ROLLBACK;