/************************************************
-- Versie: 01
-- Details: Stored procedure voor instructeur model method
************************************************/

-- Noem de database voor de stored procedure
use `be_examtraining`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spGetVoertuigenByInstructeurId;

DELIMITER //

CREATE PROCEDURE spGetVoertuigenByInstructeurId(
    IN instructeurId INT
)
BEGIN

    SELECT      INST.Id AS InstructeurId
                ,INST.Voornaam AS Voornaam
                ,INST.Tussenvoegsel AS Tussenvoegsel
                ,INST.Achternaam AS Achternaam
                ,INST.DatumInDienst AS DatumInDienst
                ,INST.AantalSterren AS AantalSterren
                ,TPVT.Id as TypeVoertuigId
                ,TPVT.TypeVoertuig AS TypeVoertuig
                ,TPVT.RijbewijsCategorie AS RijbewijsCategorie
                ,VT.Id AS VoertuigId
                ,VT.Type AS Type
                ,VT.Kenteken AS Kenteken
                ,VT.Bouwjaar AS Bouwjaar
                ,VT.Brandstof AS Brandstof

    FROM        voertuiginstructeur

    INNER JOIN  instructeur AS INST 
        ON voertuiginstructeur.InstructeurId = INST.Id
    INNER JOIN  voertuig AS VT 
        ON voertuiginstructeur.VoertuigId = VT.Id
    INNER JOIN  typevoertuig AS TPVT
        ON VT.TypeVoertuigId = TPVT.Id

    WHERE      INST.Id = instructeurId

    GROUP BY  INST.Id
    ORDER BY AantalSterren DESC;

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spGetVoertuigenByInstructeurId();
****************************************************/