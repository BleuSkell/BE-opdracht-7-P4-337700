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
        }
    }
}