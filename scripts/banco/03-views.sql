CREATE VIEW ViewUsuarios AS
SELECT
    Usuario.ID AS IDUsuario,
    Usuario.Nome AS Nome,
    Usuario.Foto AS Foto,
    Usuario.Celular AS Celular,
    Usuario.StatusUsuario AS StatusUsuario,
    Credencial.Email AS Email,
    Credencial.Senha AS Senha,
    NivelAcesso.TipoConta AS TipoConta
FROM Usuario
    INNER JOIN Credencial ON Usuario.FKCredencial = Credencial.ID
    INNER JOIN NivelAcesso ON Credencial.FKNivelAcesso = NivelAcesso.ID;

CREATE VIEW ViewPublicacao AS
SELECT
    pub.ID AS IDPublicacao,
    pub.Titulo AS Titulo,
    pub.Sobre AS Sobre,
    pub.Valor AS Valor,
    pub.QuantidadeFavorito AS QuantidadeFavorito,
    cat.Nome AS Categoria,
    usu.Nome AS NomeUsuario,
    usu.Foto AS FotoUsuario,
    MAX(CASE WHEN tp.Nome = 'Portifólio' THEN cont.Contato END) AS Portifolio,
    MAX(CASE WHEN tp.Nome = 'Telefone' THEN cont.Contato END) AS Telefone,
    MAX(CASE WHEN tp.Nome = 'WhatsApp' THEN cont.Contato END) AS Whatsapp,
    MAX(CASE WHEN tp.Nome = 'Instagram' THEN cont.Contato END) AS Instagram
FROM PublicacaoServico pub
    INNER JOIN CategoriaServico AS cat ON pub.FKCategoria = cat.ID
    INNER JOIN Usuario AS usu ON pub.FKUsuario = usu.ID
    LEFT JOIN InformacaoContato AS cont ON usu.ID = cont.FKUsuario
    LEFT JOIN TipoContato AS tp ON cont.FKTipoContato = tp.ID
GROUP BY pub.ID, pub.ID, cat.Nome;