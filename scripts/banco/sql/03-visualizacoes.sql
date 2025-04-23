CREATE OR REPLACE VIEW ViewUsuarioLogin AS
SELECT
    Usuario.ID AS IDUsuario,
    Usuario.Nome,
    Usuario.Foto,
    Usuario.Celular,
    Usuario.StatusUsuario,
    Credencial.Email,
    Credencial.Senha,
    NivelAcesso.TipoConta
FROM Usuario
    INNER JOIN Credencial ON Usuario.FKCredencial = Credencial.ID
    INNER JOIN NivelAcesso ON Credencial.FKNivelAcesso = NivelAcesso.ID;

CREATE OR REPLACE VIEW ViewPublicacao AS
SELECT
    pub.ID AS IDPublicacao,
    pub.Titulo,
    pub.Sobre,
    pub.Valor,
    pub.QuantidadeFavorito,
    pub.DataCriacao AS PublicadoEm,
    cat.Nome AS Categoria,
    usu.Nome AS NomeUsuario,
    usu.Foto AS FotoUsuario,
    MAX(CASE WHEN tp.Nome = 'Email' THEN cont.Contato END) AS Email,
    MAX(CASE WHEN tp.Nome = 'Facebook' THEN cont.Contato END) AS Facebook,
    MAX(CASE WHEN tp.Nome = 'Telefone' THEN cont.Contato END) AS Telefone,
    MAX(CASE WHEN tp.Nome = 'WhatsApp' THEN cont.Contato END) AS Whatsapp,
    MAX(CASE WHEN tp.Nome = 'Instagram' THEN cont.Contato END) AS Instagram,
    MAX(CASE WHEN tp.Nome = 'Outros' THEN cont.Contato END) AS OutroContatos
FROM PublicacaoServico pub
    INNER JOIN CategoriaServico AS cat ON pub.FKCategoria = cat.ID
    INNER JOIN Usuario AS usu ON pub.FKUsuario = usu.ID
    LEFT JOIN InformacaoContato AS cont ON usu.ID = cont.FKUsuario
    LEFT JOIN TipoContato AS tp ON cont.FKTipoContato = tp.ID
GROUP BY pub.ID, cat.nome;