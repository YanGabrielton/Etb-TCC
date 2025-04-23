INSERT INTO CategoriaServico (Nome) VALUES
    ('Babá'),
    ('Limpeza'),
    ('Jardinagem'),
    ('Mudança/Frete'),
    ('Manuntenção'),
    ('Reforço Escolar'),
    ('Cuidador de Idoso'),
    ('Cuidado Pet'),
    ('Cozinha'),
    ('Costura'),
    ('Fotógrafo'),
    ('Marido de Aluguel'),
    ('Esteticista');

INSERT INTO TipoContato (Nome) VALUES
    ('Whatsapp'),
    ('Instagram'),
    ('Telefone'),
    ('Facebook'),
    ('Email'),
    ('Outros');


INSERT INTO NivelAcesso (TipoConta) VALUES
    -- Revisa e gerencia publicações, remove conteúdo impróprio, bane usuários, visualiza denúncias
    ('Administrador'),
    -- Cria/gerencia/atualiza suas próprias publicações,
    ('Prestador'),
    -- Procura por serviços, entra em contato com prestadores, avalia serviços
    ('Usuario Comum');
