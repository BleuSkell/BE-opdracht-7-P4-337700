<?php

class InstructeurModel
{
    private $db;

    public function __construct()
    {
        /**
         * Maak een nieuw database object die verbinding maakt met de 
         * MySQL server
         */
        $this->db = new Database();
    }

    public function getAllInstructeurs()
    {
        try {
            $sql = "CALL spGetAllInstructeurs()";

            $this->db->query($sql);

            return $this->db->resultSet();
        } catch (Exception $e) {
            /**
             * Log de error in de functie logger()
             */
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());  
        }
    }

    public function getInstructeurById($instructeurId)
    {
        try {
            $sql = "SELECT * FROM instructeur WHERE Id = :instructeurId";

            $this->db->query($sql);
            $this->db->bind(':instructeurId', $instructeurId, PDO::PARAM_INT);

            $result = $this->db->resultSet();

            $this->db->closeCursor();

            return $result;
        } catch (Exception $e) {
            /**
             * Log de error in de functie logger()
             */
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
        }
    }

    public function getVoertuigenByInstructeurId($instructeurId)
    {
        try {
            $sql = "CALL spGetVoertuigenByInstructeurId($instructeurId)";

            $this->db->query($sql);

            return $this->db->resultSet();
        } catch (Exception $e) {
            /**
             * Log de error in de functie logger()
             */
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
        }
    }

    public function getVoertuiggegevensById($voertuiginstructeurId)
    {
        try {
            $sql = "CALL spGetVoertuiggegevensById($voertuiginstructeurId)";

            $this->db->query($sql);

            $result = $this->db->resultSet();

            $this->db->closeCursor();

            return $result;
        } catch (Exception $e) {
            /**
             * Log de error in de functie logger()
             */
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
        }
    }

    public function getAllTypeVoertuigen()
    {
        try {
            $sql = "SELECT * FROM typevoertuig";

            $this->db->query($sql);

            $result = $this->db->resultSet();

            $this->db->closeCursor();

            return $result;
        } catch (Exception $e) {
            /**
             * Log de error in de functie logger()
             */
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
        }
    }

    public function getAllVoertuigen()
    {
        try {
            $sql = "CALL spGetAllVoertuigen()";

            $this->db->query($sql);

            $result = $this->db->resultSet();

            $this->db->closeCursor();

            return $result;
        } catch (Exception $e) {
            /**
             * Log de error in de functie logger()
             */
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
        }
    }

    public function getVoertuigById($voertuigId)
    {
        try {
            $sql = "CALL spGetVoertuigenById(:voertuigId)";
            
            $this->db->query($sql);
            $this->db->bind(':voertuigId', $voertuigId, PDO::PARAM_INT);
            
            $result = $this->db->resultSet();
            $this->db->closeCursor();
            
            return $result;
        } catch (Exception $e) {
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
            return false;
        }
    }

    public function addVoertuigToInstructeur($voertuigId, $instructeurId)
    {
        try {
            $sql = "CALL spAddVoertuigToInstructeur(:voertuigId, :instructeurId)";
            
            $this->db->query($sql);
            $this->db->bind(':voertuigId', $voertuigId, PDO::PARAM_INT);
            $this->db->bind(':instructeurId', $instructeurId, PDO::PARAM_INT);
            
            return $this->db->execute();
        } catch (Exception $e) {
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
            return false;
        }
    }

    public function getAllInstructeursSimple()
    {
        try {
            $sql = "SELECT Id, Voornaam, Tussenvoegsel, Achternaam FROM instructeur";

            $this->db->query($sql);

            $result = $this->db->resultSet();

            $this->db->closeCursor();

            return $result;
        } catch (Exception $e) {
            /**
             * Log de error in de functie logger()
             */
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
            return false;
        }
    }

    public function updateVoertuiggegevens($data)
    {
        try{
            $sql = "CALL spUpdateVoertuiggegevens(
                        :voertuiginstructeurId
                        ,:instructeurId
                        ,:typevoertuigId
                        ,:type
                        ,:bouwjaar
                        ,:brandstof
                        ,:kenteken
            )";

            $this->db->query($sql);
            $this->db->bind(':voertuiginstructeurId', $data['voertuiginstructeurId'], PDO::PARAM_INT);
            $this->db->bind(':instructeurId', $data['instructeur'], PDO::PARAM_INT);
            $this->db->bind(':typevoertuigId', $data['typevoertuig'], PDO::PARAM_INT);
            $this->db->bind(':type', $data['type'], PDO::PARAM_STR);
            $this->db->bind(':bouwjaar', $data['bouwjaar'], PDO::PARAM_STR);
            $this->db->bind(':brandstof', $data['brandstof'], PDO::PARAM_STR);
            $this->db->bind(':kenteken', $data['kenteken'], PDO::PARAM_STR);
            
            return $this->db->execute();
        } catch (Exception $e) {
            /**
             * Log de error in de functie logger()
             */
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
            return false;
        }
    }

    public function updateVoertuig($data)
    {
        try {
            // Debug the incoming data
            error_log("Updating vehicle with data: " . print_r($data, true));
            
            $sql = "UPDATE voertuig 
                    SET TypeVoertuigId = :typevoertuigId, 
                        Type = :type, 
                        Bouwjaar = :bouwjaar, 
                        Brandstof = :brandstof, 
                        Kenteken = :kenteken 
                    WHERE Id = :voertuigId";

            $this->db->query($sql);
            $this->db->bind(':voertuigId', $data['voertuigId'], PDO::PARAM_INT);
            $this->db->bind(':typevoertuigId', $data['typeVoertuigId'], PDO::PARAM_INT);
            $this->db->bind(':type', $data['type'], PDO::PARAM_STR);
            $this->db->bind(':bouwjaar', $data['bouwjaar'], PDO::PARAM_STR);
            $this->db->bind(':brandstof', $data['brandstof'], PDO::PARAM_STR);
            $this->db->bind(':kenteken', $data['kenteken'], PDO::PARAM_STR);

            // Debug the SQL and parameters
            error_log("SQL: " . $sql);
            error_log("Parameters: voertuigId=" . $data['voertuigId'] . 
                    ", typeVoertuigId=" . $data['typeVoertuigId']);

            return $this->db->execute();
        } catch (Exception $e) {
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
            return false;
        }
    }

    public function verifyTypeVoertuigExists($typeVoertuigId)
    {
        try {
            $sql = "SELECT COUNT(*) as count FROM typevoertuig WHERE Id = :typeVoertuigId";
            
            $this->db->query($sql);
            $this->db->bind(':typeVoertuigId', $typeVoertuigId, PDO::PARAM_INT);
            
            $result = $this->db->single();
            return ($result->count > 0);
        } catch (Exception $e) {
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
            return false;
        }
    }
}