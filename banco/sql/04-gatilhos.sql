DROP TRIGGER IF EXISTS AumentaFavorito;

DELIMITER //
    CREATE TRIGGER AumentaFavorito
    AFTER INSERT ON ServicoFavorito
    FOR EACH ROW
    BEGIN
        UPDATE PublicacaoServico
        SET QuantidadeFavorito = QuantidadeFavorito + 1
        WHERE PublicacaoServico.ID = NEW.IDServico;
    END //
DELIMITER;

DROP TRIGGER IF EXISTS DiminuiFavorito;

DELIMITER //
    CREATE TRIGGER DiminuiFavorito
    AFTER DELETE ON ServicoFavorito
    FOR EACH ROW
    BEGIN
        UPDATE PublicacaoServico
        SET QuantidadeFavorito = QuantidadeFavorito - 1
        WHERE PublicacaoServico.ID = OLD.IDServico AND QuantidadeFavorito >= 0;
    END //
DELIMITER;

