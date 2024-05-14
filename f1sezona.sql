-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2024 at 11:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `f1sezona`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetDriverInfo` (IN `teamName` VARCHAR(50))   BEGIN
    SELECT Ime, Prezime
    FROM vozaci
    WHERE Tim = teamName;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `CalculateTotalPoints` (`team_id` INT) RETURNS INT(11)  BEGIN
    DECLARE total_points INT;

    SET total_points = (
        SELECT COALESCE(SUM(ds.Broj_Poena), 0)
        FROM driver_standings ds
        WHERE ds.Broj_vozaca IN (SELECT Prvi_vozac FROM timovi WHERE id = team_id)
           OR ds.Broj_vozaca IN (SELECT Drugi_vozac FROM timovi WHERE id = team_id)
    );

    RETURN total_points;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `driver_standings`
--

CREATE TABLE `driver_standings` (
  `id` int(11) NOT NULL,
  `Broj_vozaca` int(11) NOT NULL,
  `Broj_Poena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver_standings`
--

INSERT INTO `driver_standings` (`id`, `Broj_vozaca`, `Broj_Poena`) VALUES
(1, 1, 100),
(2, 2, 90),
(3, 3, 80),
(4, 4, 70),
(5, 5, 60),
(6, 6, 50),
(7, 7, 40),
(8, 8, 30),
(9, 9, 25),
(10, 10, 20),
(11, 11, 15),
(12, 12, 10),
(13, 13, 5),
(14, 14, 3),
(15, 15, 3),
(16, 16, 1),
(17, 17, 0),
(18, 18, 0),
(19, 19, 0),
(20, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kalendar_trke`
--

CREATE TABLE `kalendar_trke` (
  `ID` int(11) NOT NULL,
  `Trka` int(11) NOT NULL,
  `Datum_odrzavanja` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `teamdriverview`
-- (See below for the actual view)
--
CREATE TABLE `teamdriverview` (
`ID` int(11)
,`NazivTima` varchar(45)
,`ImeVozaca` varchar(45)
,`PrezimeVozaca` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `team_standings`
--

CREATE TABLE `team_standings` (
  `id` int(11) NOT NULL,
  `Tim` int(11) NOT NULL,
  `Broj_poena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_standings`
--

INSERT INTO `team_standings` (`id`, `Tim`, `Broj_poena`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0),
(4, 4, 0),
(5, 5, 0),
(6, 6, 0),
(7, 7, 0),
(8, 8, 0),
(9, 9, 0),
(10, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `timovi`
--

CREATE TABLE `timovi` (
  `id` int(11) NOT NULL,
  `Naziv` varchar(45) NOT NULL,
  `Prvi_vozac` int(11) NOT NULL,
  `Drugi_vozac` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timovi`
--

INSERT INTO `timovi` (`id`, `Naziv`, `Prvi_vozac`, `Drugi_vozac`) VALUES
(1, 'Mercedes', 1, 2),
(2, 'Red Bull Racing', 3, 4),
(3, 'McLaren', 5, 6),
(4, 'Ferrari', 7, 8),
(5, 'Aston Martin', 9, 10),
(6, 'Alpine', 11, 12),
(7, 'AlphaTauri', 13, 14),
(8, 'Alfa Romeo Racing', 15, 16),
(9, 'Haas', 17, 18),
(10, 'Williams', 19, 20);

-- --------------------------------------------------------

--
-- Stand-in structure for view `totalnipoenitima`
-- (See below for the actual view)
--
CREATE TABLE `totalnipoenitima` (
`TeamID` int(11)
,`TeamName` varchar(45)
,`TotalniPoeni` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `totalnipoenivozaca`
-- (See below for the actual view)
--
CREATE TABLE `totalnipoenivozaca` (
`ID` int(11)
,`Ime` varchar(45)
,`Prezime` varchar(45)
,`TotalniPoeni` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `trke`
--

CREATE TABLE `trke` (
  `ID` int(11) NOT NULL,
  `Naziv_trke` varchar(45) NOT NULL,
  `Drzava_trke` varchar(45) NOT NULL,
  `Broj_krugova` int(11) NOT NULL,
  `Duzina` int(11) NOT NULL,
  `Najbrzi_krug` varchar(45) DEFAULT NULL,
  `Sprint_vikend` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vozaci`
--

CREATE TABLE `vozaci` (
  `id` int(11) NOT NULL,
  `Ime` varchar(45) NOT NULL,
  `Prezime` varchar(45) NOT NULL,
  `Trkacki_broj` int(11) NOT NULL,
  `Tim` varchar(45) NOT NULL,
  `Broj_sampionata` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vozaci`
--

INSERT INTO `vozaci` (`id`, `Ime`, `Prezime`, `Trkacki_broj`, `Tim`, `Broj_sampionata`) VALUES
(1, 'Lewis', 'Hamilton', 44, 'Mercedes', 7),
(2, 'Max', 'Verstappen', 33, 'Red Bull Racing', 0),
(3, 'Valtteri', 'Bottas', 77, 'Mercedes', 0),
(4, 'Lando', 'Norris', 4, 'McLaren', 0),
(5, 'Sergio', 'Perez', 11, 'Red Bull Racing', 0),
(6, 'Charles', 'Leclerc', 16, 'Ferrari', 0),
(7, 'Daniel', 'Ricciardo', 3, 'McLaren', 0),
(8, 'Carlos', 'Sainz', 55, 'Ferrari', 0),
(9, 'Sebastian', 'Vettel', 5, 'Aston Martin', 4),
(10, 'Fernando', 'Alonso', 14, 'Alpine', 2),
(11, 'Esteban', 'Ocon', 31, 'Alpine', 0),
(12, 'Pierre', 'Gasly', 10, 'AlphaTauri', 0),
(13, 'Kimi', 'Raikkonen', 7, 'Alfa Romeo Racing', 1),
(14, 'Antonio', 'Giovinazzi', 99, 'Alfa Romeo Racing', 0),
(15, 'Mick', 'Schumacher', 47, 'Haas', 0),
(16, 'Nikita', 'Mazepin', 9, 'Haas', 0),
(17, 'Nicholas', 'Latifi', 6, 'Williams', 0),
(18, 'George', 'Russell', 63, 'Williams', 0),
(19, 'Yuki', 'Tsunoda', 22, 'AlphaTauri', 0),
(20, 'Nikolas', 'Kubica', 88, 'Alfa Romeo Racing', 0);

-- --------------------------------------------------------

--
-- Structure for view `teamdriverview`
--
DROP TABLE IF EXISTS `teamdriverview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `teamdriverview`  AS SELECT `timovi`.`id` AS `ID`, `timovi`.`Naziv` AS `NazivTima`, `vozaci`.`Ime` AS `ImeVozaca`, `vozaci`.`Prezime` AS `PrezimeVozaca` FROM (`timovi` join `vozaci` on(`timovi`.`Prvi_vozac` = `vozaci`.`id`))union select `timovi`.`id` AS `ID`,`timovi`.`Naziv` AS `NazivTima`,`vozaci`.`Ime` AS `ImeVozaca`,`vozaci`.`Prezime` AS `PrezimeVozaca` from (`timovi` join `vozaci` on(`timovi`.`Drugi_vozac` = `vozaci`.`id`))  ;

-- --------------------------------------------------------

--
-- Structure for view `totalnipoenitima`
--
DROP TABLE IF EXISTS `totalnipoenitima`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `totalnipoenitima`  AS SELECT `timovi`.`id` AS `TeamID`, `timovi`.`Naziv` AS `TeamName`, coalesce(sum(`ds`.`Broj_Poena`),0) AS `TotalniPoeni` FROM (`timovi` left join `driver_standings` `ds` on(`timovi`.`Prvi_vozac` = `ds`.`Broj_vozaca` or `timovi`.`Drugi_vozac` = `ds`.`Broj_vozaca`)) GROUP BY `timovi`.`id`, `timovi`.`Naziv` ;

-- --------------------------------------------------------

--
-- Structure for view `totalnipoenivozaca`
--
DROP TABLE IF EXISTS `totalnipoenivozaca`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `totalnipoenivozaca`  AS SELECT `vozaci`.`id` AS `ID`, `vozaci`.`Ime` AS `Ime`, `vozaci`.`Prezime` AS `Prezime`, coalesce(sum(`ds`.`Broj_Poena`),0) AS `TotalniPoeni` FROM (`vozaci` left join `driver_standings` `ds` on(`vozaci`.`id` = `ds`.`Broj_vozaca`)) GROUP BY `vozaci`.`id`, `vozaci`.`Ime`, `vozaci`.`Prezime` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver_standings`
--
ALTER TABLE `driver_standings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Broj_vozaca` (`Broj_vozaca`);

--
-- Indexes for table `kalendar_trke`
--
ALTER TABLE `kalendar_trke`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Trka` (`Trka`);

--
-- Indexes for table `team_standings`
--
ALTER TABLE `team_standings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Tim` (`Tim`);

--
-- Indexes for table `timovi`
--
ALTER TABLE `timovi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Prvi_vozac` (`Prvi_vozac`),
  ADD KEY `Drugi_vozac` (`Drugi_vozac`);

--
-- Indexes for table `trke`
--
ALTER TABLE `trke`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `vozaci`
--
ALTER TABLE `vozaci`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver_standings`
--
ALTER TABLE `driver_standings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `kalendar_trke`
--
ALTER TABLE `kalendar_trke`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_standings`
--
ALTER TABLE `team_standings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `timovi`
--
ALTER TABLE `timovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trke`
--
ALTER TABLE `trke`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vozaci`
--
ALTER TABLE `vozaci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `driver_standings`
--
ALTER TABLE `driver_standings`
  ADD CONSTRAINT `driver_standings_ibfk_1` FOREIGN KEY (`Broj_vozaca`) REFERENCES `vozaci` (`id`);

--
-- Constraints for table `kalendar_trke`
--
ALTER TABLE `kalendar_trke`
  ADD CONSTRAINT `kalendar_trke_ibfk_1` FOREIGN KEY (`Trka`) REFERENCES `trke` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `team_standings`
--
ALTER TABLE `team_standings`
  ADD CONSTRAINT `team_standings_ibfk_1` FOREIGN KEY (`Tim`) REFERENCES `timovi` (`id`);

--
-- Constraints for table `timovi`
--
ALTER TABLE `timovi`
  ADD CONSTRAINT `timovi_ibfk_1` FOREIGN KEY (`Prvi_vozac`) REFERENCES `vozaci` (`id`),
  ADD CONSTRAINT `timovi_ibfk_2` FOREIGN KEY (`Drugi_vozac`) REFERENCES `vozaci` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
