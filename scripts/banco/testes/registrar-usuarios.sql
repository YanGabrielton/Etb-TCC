-- Registrar usuários com valores válidos
SET autocommit = 0;

START TRANSACTION;

BEGIN;

INSERT INTO Credencial (Email, Senha, FKNivelAcesso)
VALUES
    ('joaosilva@gmail.com', '$2a$17$QQckWeBD0rWaJbvix4cGVOm5A9nvHPuSGKCvq6sx4dlFysI9OKiPu', 2),
    ('mariaoliveira@gmail.com', '$2a$12$pa5y8kFevZlmsdi.qPcyB.HZx/ba4.a/w8E4AeKKPR/.NpKvrZef6', 1),
    ('carlosantos@gmail.com', '$2a$12$Qc2cSMQnajGfuCOvdZQRCeUQAMwBtq5mfW1SswZvHK62MvqvsGOHS', 2),
    ('anacosta@gmail.com', '$2a$12$qmZSJaI5yargoFxsQIJKEO7ebJBxj6PGu4jPiwn5.nDQpuDrG52gq', 3);

INSERT INTO Endereco (CEP, Estado, Cidade, Bairro, Rua)
VALUES  
    ('12345678', 'SP', 'São Paulo', 'Vila Maria', 'Rua João Silva'),
    ('23456789', 'SP', 'São Paulo', 'Vila Maria', 'Rua Maria Oliveira'),
    ('34567890', 'SP', 'São Paulo', 'Vila Maria', 'Rua Carlos Santos'),
    ('45678901', 'SP', 'São Paulo', 'Vila Maria', 'Rua Ana Costa');

INSERT INTO Usuario
  (Nome, CPF, Foto, Celular, FKCredencial, FKEndereco, StatusUsuario)
VALUES
    ('João Silva', '12345678901', 'foto1.jpg', '11987654321', 1, 1, 'ATIVO'),
    ('Maria Oliveira', '23456789012', 'foto2.jpg', '21987654321', 2, 2, 'BLOQUEADO'),
    ('Carlos Santos', '34567890123', NULL, NULL, 3, 3, 'EM_ANÁLISE'),
    ('Ana Costa', '45678901234', NULL, NULL, 4, 4, 'ATIVO');

INSERT INTO InformacaoContato (Contato, FKUsuario, FKTipoContato)
VALUES
    ('11987654321', 1, 1), -- Whatsapp
    ('mariaoliveira@gmail.com', 2, 5), -- Email
    ('@carlosantos', 3, 2), -- Instagram
    ('facebook.com/anacosta', 4, 4), -- Facebook
    ('51987654321', 4, 3), -- Telefone
    ('outrocontato1', 3, 6), -- Outros
    ('71987654321', 3, 1), -- Whatsapp
    ('@usuario8', 2, 2), -- Instagram
    ('91987654321', 1, 3), -- Telefone
    ('email10@gmail.com', 1, 5); -- Email

ROLLBACK;