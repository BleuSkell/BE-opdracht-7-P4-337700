/************************************************
-- Versie: 05
-- Details: Stored procedure voor instructeur model method
************************************************/

-- Noem de database voor de stored procedure
use `be_examtraining`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spGetVoertuiggegevensById;

DELIMITER //

CREATE PROCEDURE spGetVoertuiggegevensById(
    IN voertuiginstructeurId INT
)
BEGIN

    SELECT      VTINST.Id AS VoertuigInstructeurId
                ,INST.Id AS InstructeurId
                ,INST.Voornaam
                ,INST.Tussenvoegsel
                ,INST.Achternaam
                ,TPVT.Id AS TypeVoertuigId
                ,TPVT.TypeVoertuig
                ,VT.Id AS VoertuigId
                ,VT.Type
                ,VT.Bouwjaar
                ,VT.Brandstof
                ,VT.Kenteken

    FROM        voertuiginstructeur AS VTINST
    
    INNER JOIN  instructeur AS INST 
        ON VTINST.InstructeurId = INST.Id
    INNER JOIN  voertuig AS VT
        ON VTINST.VoertuigId = VT.Id
    INNER JOIN  typevoertuig AS TPVT
        ON VT.TypeVoertuigId = TPVT.Id

    WHERE       VTINST.Id = voertuiginstructeurId;

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spGetVoertuiggegevensById();
****************************************************/