/************************************************
-- Versie: 02
-- Details: Stored procedure voor instructeur model method
************************************************/

-- Noem de database voor de stored procedure
use `be_examtraining`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spGetVoertuigenById;

DELIMITER //

CREATE PROCEDURE spGetVoertuigenById(
    IN voertuigId INT
)
BEGIN

    SELECT      VT.Id AS VoertuigId
                ,VT.TypevoertuigId AS TypeVoertuigId
                ,TPVT.TypeVoertuig
                ,VT.Type
                ,VT.Kenteken
                ,VT.Bouwjaar
                ,VT.Brandstof
                ,TPVT.RijbewijsCategorie

    FROM        voertuig AS VT

    INNER JOIN  typevoertuig AS TPVT
        ON VT.TypeVoertuigId = TPVT.Id

    WHERE       VT.Id = voertuigId;

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spGetVoertuigenById;();
****************************************************/