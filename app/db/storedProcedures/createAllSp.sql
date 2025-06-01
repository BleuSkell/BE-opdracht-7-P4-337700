/************************************************
-- Versie: 05
-- Details: Stored Procedures voor instructeur model method
-- Datum: 2025-06-01
************************************************/

USE `be_examtraining`;

-- ========== spAddVoertuigToInstructeur ==========
DROP PROCEDURE IF EXISTS spAddVoertuigToInstructeur;
DELIMITER //
CREATE PROCEDURE spAddVoertuigToInstructeur(
    IN p_VoertuigId INT,
    IN p_InstructeurId INT
)
BEGIN
    INSERT INTO voertuiginstructeur (
        VoertuigId,
        InstructeurId,
        DatumToekenning
    )
    VALUES (
        p_VoertuigId,
        p_InstructeurId,
        NOW()
    );
END //
DELIMITER ;

-- ========== spGetAllInstructeurs ==========
DROP PROCEDURE IF EXISTS spGetAllInstructeurs;
DELIMITER //
CREATE PROCEDURE spGetAllInstructeurs()
BEGIN
    SELECT INST.Id AS InstructeurId,
           INST.Voornaam,
           INST.Tussenvoegsel,
           INST.Achternaam,
           INST.Mobiel,
           INST.DatumInDienst,
           INST.AantalSterren,
           (SELECT COUNT(*) FROM instructeur) AS AantalInstructeurs
    FROM instructeur AS INST
    GROUP BY INST.Id
    ORDER BY AantalSterren DESC;
END //
DELIMITER ;

-- ========== spGetAllVoertuigen ==========
DROP PROCEDURE IF EXISTS spGetAllVoertuigen;
DELIMITER //
CREATE PROCEDURE spGetAllVoertuigen()
BEGIN
    SELECT VT.Id AS VoertuigId,
           TPVT.TypeVoertuig,
           VT.Type,
           VT.Kenteken,
           VT.Bouwjaar,
           VT.Brandstof,
           TPVT.RijbewijsCategorie
    FROM voertuig AS VT
    INNER JOIN typevoertuig AS TPVT ON VT.TypeVoertuigId = TPVT.Id
    GROUP BY VT.Id
    ORDER BY TPVT.RijbewijsCategorie DESC;
END //
DELIMITER ;

-- ========== spGetVoertuigenById ==========
DROP PROCEDURE IF EXISTS spGetVoertuigenById;
DELIMITER //
CREATE PROCEDURE spGetVoertuigenById(
    IN voertuigId INT
)
BEGIN
    SELECT VT.Id AS VoertuigId,
           VT.TypevoertuigId AS TypeVoertuigId,
           TPVT.TypeVoertuig,
           VT.Type,
           VT.Kenteken,
           VT.Bouwjaar,
           VT.Brandstof,
           TPVT.RijbewijsCategorie
    FROM voertuig AS VT
    INNER JOIN typevoertuig AS TPVT ON VT.TypeVoertuigId = TPVT.Id
    WHERE VT.Id = voertuigId;
END //
DELIMITER ;

-- ========== spGetVoertuigenByInstructeurId ==========
DROP PROCEDURE IF EXISTS spGetVoertuigenByInstructeurId;
DELIMITER //
CREATE PROCEDURE spGetVoertuigenByInstructeurId(
    IN instructeurId INT
)
BEGIN
    SELECT VTINST.Id AS VoertuigInstructeurId,
           VTINST.VoertuigId AS VoertuigInstructeurVoertuigId,
           VTINST.InstructeurId AS VoertuigInstructeurInstructeurId,
           INST.Id AS InstructeurId,
           INST.Voornaam,
           INST.Tussenvoegsel,
           INST.Achternaam,
           INST.DatumInDienst,
           INST.AantalSterren,
           TPVT.Id AS TypeVoertuigId,
           TPVT.TypeVoertuig,
           TPVT.RijbewijsCategorie,
           VT.Id AS VoertuigId,
           VT.Type,
           VT.Kenteken,
           VT.Bouwjaar,
           VT.Brandstof
    FROM voertuiginstructeur AS VTINST
    INNER JOIN instructeur AS INST ON VTINST.InstructeurId = INST.Id
    INNER JOIN voertuig AS VT ON VTINST.VoertuigId = VT.Id
    INNER JOIN typevoertuig AS TPVT ON VT.TypeVoertuigId = TPVT.Id
    WHERE INST.Id = instructeurId
    GROUP BY VTINST.Id
    ORDER BY TPVT.RijbewijsCategorie DESC;
END //
DELIMITER ;

-- ========== spGetVoertuiggegevensById ==========
DROP PROCEDURE IF EXISTS spGetVoertuiggegevensById;
DELIMITER //
CREATE PROCEDURE spGetVoertuiggegevensById(
    IN voertuiginstructeurId INT
)
BEGIN
    SELECT VTINST.Id AS VoertuigInstructeurId,
           INST.Id AS InstructeurId,
           INST.Voornaam,
           INST.Tussenvoegsel,
           INST.Achternaam,
           TPVT.Id AS TypeVoertuigId,
           TPVT.TypeVoertuig,
           VT.Id AS VoertuigId,
           VT.Type,
           VT.Bouwjaar,
           VT.Brandstof,
           VT.Kenteken
    FROM voertuiginstructeur AS VTINST
    INNER JOIN instructeur AS INST ON VTINST.InstructeurId = INST.Id
    INNER JOIN voertuig AS VT ON VTINST.VoertuigId = VT.Id
    INNER JOIN typevoertuig AS TPVT ON VT.TypeVoertuigId = TPVT.Id
    WHERE VTINST.Id = voertuiginstructeurId;
END //
DELIMITER ;

-- ========== spUpdateVoertuiggegevens ==========
DROP PROCEDURE IF EXISTS spUpdateVoertuiggegevens;
DELIMITER //
CREATE PROCEDURE spUpdateVoertuiggegevens(
    IN voertuiginstructeurId INT,
    IN instructeurId INT,
    IN typevoertuigId INT,
    IN type VARCHAR(50),
    IN bouwjaar DATE,
    IN brandstof VARCHAR(20),
    IN kenteken VARCHAR(50)
)
BEGIN
    UPDATE voertuig AS V
    INNER JOIN voertuiginstructeur AS VTINST ON V.Id = VTINST.VoertuigId
    SET V.Type = type,
        V.Bouwjaar = bouwjaar,
        V.Brandstof = brandstof,
        V.Kenteken = kenteken,
        V.TypeVoertuigId = typevoertuigId
    WHERE VTINST.Id = voertuiginstructeurId;

    UPDATE voertuiginstructeur
    SET InstructeurId = instructeurId
    WHERE Id = voertuiginstructeurId;
END //
DELIMITER ;
