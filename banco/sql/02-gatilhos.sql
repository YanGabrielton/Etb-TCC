-- Gatilhos para atualizar a quantidade de favoritos na tabela PublicacaoServico

DROP TRIGGER IF EXISTS AumentaFavorito;

DELIMITER //

CREATE TRIGGER AumentaFavorito
AFTER INSERT ON ServicoFavorito
FOR EACH ROW
BEGIN
    UPDATE PublicacaoServico
    SET QuantidadeFavorito = QuantidadeFavorito + 1
    WHERE ID = NEW.IDServico;
END //

DELIMITER ;

DROP TRIGGER IF EXISTS DiminuiFavorito;

DELIMITER //

CREATE TRIGGER DiminuiFavorito
AFTER DELETE ON ServicoFavorito
FOR EACH ROW
BEGIN
    UPDATE PublicacaoServico
    SET QuantidadeFavorito = QuantidadeFavorito - 1
    WHERE ID = OLD.IDServico;
END //

DELIMITER ;