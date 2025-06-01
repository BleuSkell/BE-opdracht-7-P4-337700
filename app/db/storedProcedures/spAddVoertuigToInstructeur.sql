/************************************************
-- Versie: 02
-- Details: Stored procedure voor instructeur model method
************************************************/

-- Noem de database voor de stored procedure
use `be_examtraining`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spAddVoertuigToInstructeur;

DELIMITER //

CREATE PROCEDURE spAddVoertuigToInstructeur(
    IN p_VoertuigId INT
    ,IN p_InstructeurId INT
)
BEGIN

    INSERT INTO voertuiginstructeur (
        VoertuigId
        ,InstructeurId
        ,DatumToekenning
    )

    VALUES (
        p_VoertuigId
        ,p_InstructeurId
        ,NOW()
    );

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spAddVoertuigToInstructeur;();
****************************************************/