CREATE OR REPLACE VIEW ViewUsuarioLogin AS
SELECT
    Usuario.ID AS IDUsuario,
    Usuario.Nome,
    Usuario.Foto,
    Usuario.Celular,
    Usuario.StatusUsuario,
    Credencial.Email,
    Credencial.Senha,
    Credencial.NivelAcesso
FROM Usuario
    INNER JOIN Credencial ON Usuario.FKCredencial = Credencial.ID;

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
    usu.ID as IDUsuario,
    MAX(CASE WHEN cont.CategoriaContato = 'Email' THEN cont.Contato END) AS Email,
    MAX(CASE WHEN cont.CategoriaContato = 'Facebook' THEN cont.Contato END) AS Facebook,
    MAX(CASE WHEN cont.CategoriaContato = 'Telefone' THEN cont.Contato END) AS Telefone,
    MAX(CASE WHEN cont.CategoriaContato = 'WhatsApp' THEN cont.Contato END) AS Whatsapp,
    MAX(CASE WHEN cont.CategoriaContato = 'Instagram' THEN cont.Contato END) AS Instagram,
    MAX(CASE WHEN cont.CategoriaContato = 'Outros' THEN cont.Contato END) AS OutroContatos
FROM PublicacaoServico pub
    INNER JOIN CategoriaServico AS cat ON pub.FKCategoria = cat.ID
    INNER JOIN Usuario AS usu ON pub.FKUsuario = usu.ID AND usu.StatusUsuario = 'ATIVO'
    LEFT JOIN InformacaoContato AS cont ON usu.ID = cont.FKUsuario
WHERE pub.StatusPublicacao = 'ATIVO'
GROUP BY pub.ID;