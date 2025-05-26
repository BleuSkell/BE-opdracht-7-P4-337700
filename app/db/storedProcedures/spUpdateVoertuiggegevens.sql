/************************************************
-- Versie: 01
-- Details: Stored procedure voor instructeur model method
************************************************/

-- Noem de database voor de stored procedure
use `be_examtraining`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spUpdateVoertuiggegevens;

DELIMITER //

CREATE PROCEDURE spUpdateVoertuiggegevens(
    IN voertuiginstructeurId INT
    ,IN instructeurId INT
    ,IN typevoertuigId INT
    ,IN type VARCHAR(50)
    ,IN bouwjaar DATE
    ,IN brandstof VARCHAR(20)
    ,IN kenteken VARCHAR(50)
)
BEGIN

    -- update voertuig
    UPDATE voertuig AS V
    INNER JOIN voertuiginstructeur AS VTINST 
        ON V.Id = VTINST.VoertuigId
    SET V.Type = type
        ,V.Bouwjaar = bouwjaar
        ,V.Brandstof = brandstof
        ,V.Kenteken = kenteken
        ,V.TypeVoertuigId = typevoertuigId
    WHERE VTINST.Id = voertuiginstructeurId;

    -- update instructeur
    UPDATE voertuiginstructeur AS VTINST
    SET InstructeurId = instructeurId
    WHERE VTINST.Id = voertuiginstructeurId;

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spUpdateVoertuiggegevens();
****************************************************/