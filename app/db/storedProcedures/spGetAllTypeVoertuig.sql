/************************************************
-- Versie: 05
-- Details: Stored procedure voor instructeur model method
************************************************/

-- Noem de database voor de stored procedure
use `be_examtraining`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spGetAllTypeVoertuig;

DELIMITER //

CREATE PROCEDURE spGetAllTypeVoertuig()
BEGIN

    SELECT      TPVT.Id AS TypeVoertuigId
                ,TPVT.TypeVoertuig AS TypeVoertuig

    FROM        typevoertuig AS TPVT;

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spGetAllTypeVoertuig();
****************************************************/