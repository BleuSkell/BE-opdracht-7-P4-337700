-- author: BleuSkell
-- https://www.phpmyadmin.net/
-- create script for database be_examtraining

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `be_examtraining`
--
DROP DATABASE IF EXISTS `be_examtraining`;
CREATE DATABASE `be_examtraining` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `be_examtraining`;

-- ---------------------------------------------------------

--
-- Table structure for table `TypeVoertuig`
--
CREATE TABLE typevoertuig (
  Id int NOT NULL AUTO_INCREMENT
  ,TypeVoertuig varchar(50) NOT NULL
  ,RijbewijsCategorie varchar(50) NOT NULL

  ,PRIMARY KEY (Id)
)ENGINE=InnoDB;

--
-- Insert data for table `TypeVoertuig`
--
INSERT INTO typevoertuig (Id, TypeVoertuig, RijbewijsCategorie)
VALUES  (1, 'Personenauto', 'B')
        ,(2, 'Vrachtwagen', 'C')
        ,(3, 'Bus', 'D')
        ,(4, 'Bromfiets', 'AM');

-- --------------------------------------------------------------------------------------------------------------------

--
-- Table structure for table `Voertuig`
--
CREATE TABLE voertuig (
  Id int NOT NULL AUTO_INCREMENT
  ,Kenteken varchar(50) NOT NULL
  ,Type varchar(50) NOT NULL
  ,Bouwjaar date NOT NULL
  ,Brandstof varchar(20) NOT NULL
  ,TypeVoertuigId int NOT NULL

  ,PRIMARY KEY (Id)
  ,CONSTRAINT FK_Voertuig_TypeVoertuig FOREIGN KEY (TypeVoertuigId) REFERENCES typevoertuig (Id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB;

--
-- Insert data for table `Voertuig`
--
INSERT INTO voertuig (Id, Kenteken, Type, Bouwjaar, Brandstof, TypeVoertuigId) 
VALUES  (1, 'AU-67-IO', 'Golf', '2017-06-12', 'Diesel', 1)
        ,(2, 'TR-24-OP', 'DAF', '2019-05-23', 'Diesel', 2)
        ,(3, 'TH-78-KL', 'Mercedes', '2023-01-01', 'Benzine', 1)
        ,(4, '90-KL-TR', 'Fiat 500', '2021-09-12', 'Benzine', 1)
        ,(5, '34-TK-LP', 'Scania', '2015-03-13', 'Diesel', 2)
        ,(6, 'YY-OP-78', 'BMW M5', '2022-05-13', 'Diesel', 1)
        ,(7, 'UU-HH-JK', 'M.A.N', '2017-12-03', 'Diesel', 2)
        ,(8, 'ST-FZ-28', 'Citroën', '2018-01-20', 'Elektrisch', 1)
        ,(9, '123-FR-T', 'Piaggio ZIP', '2021-02-01', 'Benzine', 4)
        ,(10, 'DRS-52-P', 'Vespa', '2022-03-21', 'Benzine', 4)
        ,(11, 'STP-12-U', 'Kymco', '2022-07-02', 'Benzine', 4)
        ,(12, '45-SD-23', 'Renault', '2023-01-01', 'Diesel', 3);

-- --------------------------------------------------------------------------------------------------------------------

--
-- Table structure for table `Instructeur`
--
CREATE TABLE instructeur (
  Id int NOT NULL AUTO_INCREMENT
  ,Voornaam varchar(50) NOT NULL
  ,Tussenvoegsel varchar(10) DEFAULT NULL
  ,Achternaam varchar(50) NOT NULL
  ,Mobiel varchar(20) NOT NULL
  ,DatumInDienst date NOT NULL
  ,AantalSterren varchar(5) NOT NULL

  ,PRIMARY KEY (Id)
)ENGINE=InnoDB;

--
-- Insert data for table `Instructeur`
--
INSERT INTO instructeur (Id, Voornaam, Tussenvoegsel, Achternaam, Mobiel, DatumInDienst, AantalSterren)
VALUES  (1, 'Li', NULL, 'Zhan', '06-28493827', '2015-04-17', '***')
        ,(2, 'Leroy', NULL, 'Boerhaven', '06-39398734', '2018-06-25', '*')
        ,(3, 'Yoeri', 'Van', 'Veen', '06-24383291', '2010-05-12', '***')
        ,(4, 'Bert', 'Van', 'Sali', '06-48293823', '2023-01-10', '****')
        ,(5, 'Mohammed', 'El', 'Yassidi', '06-34291234', '2010-06-14', '****');

-- --------------------------------------------------------------------------------------------------------------------

--
-- Table structure for table `VoertuigInstructeur`
--
CREATE TABLE voertuigInstructeur (
  Id int NOT NULL AUTO_INCREMENT
  ,VoertuigId int NOT NULL
  ,InstructeurId int NOT NULL
  ,DatumToekenning date NOT NULL

  ,PRIMARY KEY (Id)
  ,CONSTRAINT FK_VoertuigInstructeur_Voertuig FOREIGN KEY (VoertuigId) REFERENCES voertuig (Id) ON DELETE CASCADE ON UPDATE CASCADE
  ,CONSTRAINT FK_VoertuigInstructeur_Instructeur FOREIGN KEY (InstructeurId) REFERENCES instructeur (Id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB;

--
-- Insert data for table `VoertuigInstructeur`
--
INSERT INTO voertuigInstructeur (Id, VoertuigId, InstructeurId, DatumToekenning)
VALUES  (1, 1, 5, '2017-06-18')
        ,(2, 3, 1, '2021-09-26')
        ,(3, 9, 1, '2021-09-27')
        ,(4, 4, 4, '2022-08-01')
        ,(5, 5, 1, '2019-08-30')
        ,(6, 10, 5, '2020-02-02');