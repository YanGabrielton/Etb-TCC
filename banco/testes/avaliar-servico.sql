SET autocommit = 0;

START TRANSACTION;

BEGIN;

INSERT INTO AvaliacaoServico
    (Nota, Comentario, FkPublicacao, FKUsuario)
VALUES
    (5, null, 1, 2),
    (3.2, 'Gostei mas não me satisfez. Poderia ter mais cuidado no serviço', 1, 3),
    (0.5, 'Não merece nem uma coca-cola, aqui em casa nem bolacha recheada merece', 4, 2),
    (4.2, 'Arrasou!! Amei. Ótimo serviço cunhado! Onde que eu dou 10 estrelas aqui???', 2, 2),
    (2.75, 'Pode melhorar... Não teve cuidado e carinho ao realizar os serviços', 3, 1);

ROLLBACK;