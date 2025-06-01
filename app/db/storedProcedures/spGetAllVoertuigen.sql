/************************************************
-- Versie: 02
-- Details: Stored procedure voor instructeur model method
************************************************/

-- Noem de database voor de stored procedure
use `be_examtraining`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spGetAllVoertuigen;

DELIMITER //

CREATE PROCEDURE spGetAllVoertuigen()
BEGIN

    SELECT      VT.Id AS VoertuigId
                ,TPVT.TypeVoertuig
                ,VT.Type
                ,VT.Kenteken
                ,VT.Bouwjaar
                ,VT.Brandstof
                ,TPVT.RijbewijsCategorie

    FROM        voertuig AS VT

    INNER JOIN  typevoertuig AS TPVT
        ON VT.TypeVoertuigId = TPVT.Id

    GROUP BY  VT.Id
    ORDER BY TPVT.RijbewijsCategorie DESC;

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spGetAllVoertuigen;();
****************************************************/