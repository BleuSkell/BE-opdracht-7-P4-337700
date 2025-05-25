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

    public function getAllTypeVoertuig()
    {
        try {
            $sql = "CALL spGetAllTypeVoertuig()";

            $this->db->query($sql);

            return $this->db->resultSet();
        } catch (Exception $e) {
            /**
             * Log de error in de functie logger()
             */
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());  
        }
    }

    public function getAllInstructeursEdit()
    {
        try {
            $sql = "CALL spGetAllInstructeursEdit()";

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

            return $this->db->resultSet();
        } catch (Exception $e) {
            /**
             * Log de error in de functie logger()
             */
            logger(__LINE__, __METHOD__, __FILE__, $e->getMessage());
        }
    }
}