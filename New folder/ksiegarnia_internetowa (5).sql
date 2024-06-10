-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2024 at 04:26 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ksiegarnia_internetowa`
--

-- --------------------------------------------------------

--
-- Table structure for table `klient`
--

CREATE TABLE `klient` (
  `Id_klienta` int NOT NULL,
  `Nazwisko` varchar(255) NOT NULL,
  `Imie` varchar(255) NOT NULL,
  `Telefon` varchar(20) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `role` enum('client','admin') DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `klient`
--

INSERT INTO `klient` (`Id_klienta`, `Nazwisko`, `Imie`, `Telefon`, `Email`, `haslo`, `role`) VALUES
(1, 'Kowalski', 'Jan', '123456789', 'jan.kowalski@example.com', 'password1', 'client'),
(2, 'Nowak', 'Anna', '987654321', 'anna.nowak@example.com', 'password2', 'admin'),
(3, 'dasd', 'dasdas', '3424324', 'anna.3fda@example.com', 'password2', 'client');

-- --------------------------------------------------------

--
-- Table structure for table `koszyk`
--

CREATE TABLE `koszyk` (
  `Id_koszyka` int NOT NULL,
  `Id_klienta` int NOT NULL,
  `Id_ksiazki` int NOT NULL,
  `Ilosc` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ksiazka`
--

CREATE TABLE `ksiazka` (
  `Id_ksiazki` int NOT NULL,
  `tytul` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `ilosc` int NOT NULL,
  `opis` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ksiazka`
--

INSERT INTO `ksiazka` (`Id_ksiazki`, `tytul`, `autor`, `cena`, `ilosc`, `opis`) VALUES
(1, 'Książka 1', 'Autor 1', '29.99', 10, 'Opis dla książki 1'),
(3, 'Książka 3', 'Autor 3', '49.99', 20, 'Opis dla książki 3'),
(4, 'Książka 4', 'Autor 4', '59.99', 25, 'Opis dla książki 4'),
(5, 'Książka 5', 'Autor 5', '69.99', 30, 'Opis dla książki 5'),
(7, 'Książka 7', 'Autor 7', '89.99', 40, 'Opis dla książki 7'),
(8, 'Książka 8', 'Autor 8', '99.99', 45, 'Opis dla książki 8'),
(9, 'Książka 9', 'Autor 9', '109.99', 50, 'Opis dla książki 9'),
(10, 'Książka 10', 'Autor 10', '119.99', 55, 'Opis dla książki 10'),
(11, 'Książka 11', 'Autor 11', '129.99', 60, 'Opis dla książki 11'),
(12, 'Książka 12', 'Autor 12', '139.99', 65, 'Opis dla książki 12'),
(14, 'Książka 14', 'Autor 14', '159.99', 75, 'Opis dla książki 14'),
(15, 'Książka 15', 'Autor 15', '169.99', 80, 'Opis dla książki 15'),
(16, 'Książka 16', 'Autor 16', '179.99', 85, 'Opis dla książki 16'),
(17, 'Książka 17', 'Autor 17', '189.99', 90, 'Opis dla książki 17'),
(18, 'Książka 18', 'Autor 18', '199.99', 95, 'Opis dla książki 18'),
(19, 'Książka 19', 'Autor 19', '209.99', 100, 'Opis dla książki 19'),
(20, 'Książka 20', 'Autor 20', '219.99', 105, 'Opis dla książki 20');

-- --------------------------------------------------------

--
-- Table structure for table `zamowienia`
--

CREATE TABLE `zamowienia` (
  `Id_zamowienia` int NOT NULL,
  `Id_klienta` int NOT NULL,
  `Id_ksiazki` int NOT NULL,
  `Ilosc` int NOT NULL,
  `Adres_dostawy` text NOT NULL,
  `Cena_calkowita` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`Id_klienta`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`Id_koszyka`),
  ADD KEY `Id_klienta` (`Id_klienta`),
  ADD KEY `Id_ksiazki` (`Id_ksiazki`);

--
-- Indexes for table `ksiazka`
--
ALTER TABLE `ksiazka`
  ADD PRIMARY KEY (`Id_ksiazki`);

--
-- Indexes for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`Id_zamowienia`),
  ADD KEY `Id_klienta` (`Id_klienta`),
  ADD KEY `Id_ksiazki` (`Id_ksiazki`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klient`
--
ALTER TABLE `klient`
  MODIFY `Id_klienta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `koszyk`
--
ALTER TABLE `koszyk`
  MODIFY `Id_koszyka` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ksiazka`
--
ALTER TABLE `ksiazka`
  MODIFY `Id_ksiazki` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `Id_zamowienia` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `koszyk`
--
ALTER TABLE `koszyk`
  ADD CONSTRAINT `koszyk_ibfk_1` FOREIGN KEY (`Id_klienta`) REFERENCES `klient` (`Id_klienta`),
  ADD CONSTRAINT `koszyk_ibfk_2` FOREIGN KEY (`Id_ksiazki`) REFERENCES `ksiazka` (`Id_ksiazki`);

--
-- Constraints for table `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`Id_klienta`) REFERENCES `klient` (`Id_klienta`),
  ADD CONSTRAINT `zamowienia_ibfk_2` FOREIGN KEY (`Id_ksiazki`) REFERENCES `ksiazka` (`Id_ksiazki`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
