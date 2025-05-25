/************************************************
-- Versie: 01
-- Details: Stored procedure voor instructeur model method
************************************************/

-- Noem de database voor de stored procedure
use `be_examtraining`;

-- Verwijder de bestaande stored procedure
DROP PROCEDURE IF EXISTS spCountInstructeurs;

DELIMITER //

CREATE PROCEDURE spCountInstructeurs()
BEGIN

    SELECT COUNT(*) AS TotaalInstructeurs FROM instructeur;

END //
DELIMITER ;

/**********debug code stored procedure***************
CALL spCountInstructeurs();
****************************************************/