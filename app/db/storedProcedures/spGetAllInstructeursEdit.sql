/************************************************
-- Versie: 01
-- Details: Stored procedure voor instructeur model method
************************************************/

-- Noem de database voor de stored procedure
use `be_examtraining`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spGetAllInstructeursEdit;

DELIMITER //

CREATE PROCEDURE spGetAllInstructeursEdit()
BEGIN

    SELECT      INST.Id AS InstructeurId
                ,INST.Voornaam AS Voornaam
                ,INST.Tussenvoegsel AS Tussenvoegsel
                ,INST.Achternaam AS Achternaam

    FROM        instructeur AS INST

    GROUP BY  INST.Id
    ORDER BY AantalSterren DESC;

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spGetAllInstructeursEdit();
****************************************************/