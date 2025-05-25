-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Sun 25.Máj 2025, 08:46
-- Verzia serveru: 10.4.32-MariaDB
-- Verzia PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `kancelaria`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `nehnutelnosti`
--

CREATE TABLE `nehnutelnosti` (
  `id` int(11) NOT NULL,
  `nazov` varchar(255) NOT NULL,
  `popis` text DEFAULT NULL,
  `cena` decimal(10,2) NOT NULL,
  `obrazok` varchar(255) DEFAULT NULL,
  `kategoria` varchar(50) NOT NULL,
  `pocet_izieb` int(11) DEFAULT NULL,
  `pocet_kupelni` int(11) DEFAULT NULL,
  `rozloha` decimal(8,2) DEFAULT NULL,
  `poschodie` varchar(50) DEFAULT NULL,
  `parkovanie` varchar(100) DEFAULT NULL,
  `adresa` varchar(255) DEFAULT NULL,
  `mesto` varchar(100) DEFAULT NULL,
  `psc` varchar(20) DEFAULT NULL,
  `datum_pridania` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `nehnutelnosti`
--

INSERT INTO `nehnutelnosti` (`id`, `nazov`, `popis`, `cena`, `obrazok`, `kategoria`, `pocet_izieb`, `pocet_kupelni`, `rozloha`, `poschodie`, `parkovanie`, `adresa`, `mesto`, `psc`, `datum_pridania`) VALUES
(1, '18 New Street Miami, OR 97219', NULL, 2264000.00, 'property-01.jpg', 'Luxury Villa', 8, 8, 545.00, '3', '6 spots', '18 New Street', 'Miami', 'OR 97219', '2025-05-04 03:55:28'),
(2, '54 Mid Street Florida, OR 27001', NULL, 1180000.00, 'property-02.jpg', 'Luxury Villa', 6, 5, 450.00, '3', '8 spots', '54 Mid Street', 'Florida', 'OR 27001', '2025-05-04 03:55:28'),
(3, '26 Old Street Miami, OR 38540', NULL, 1460000.00, 'property-03.jpg', 'Luxury Villa', 5, 4, 225.00, '3', '10 spots', '26 Old Street', 'Miami', 'OR 38540', '2025-05-04 03:55:28'),
(4, '12 New Street Miami, OR 12650', NULL, 584500.00, 'property-04.jpg', 'Apartment', 4, 3, 125.00, '25th', '2 cars', '12 New Street', 'Miami', 'OR 12650', '2025-05-04 03:55:28'),
(5, '34 Beach Street Miami, OR 42680', NULL, 925600.00, 'property-05.jpg', 'Penthouse', 4, 4, 180.00, '38th', '2 cars', '34 Beach Street', 'Miami', 'OR 42680', '2025-05-04 03:55:28'),
(6, '22 New Street Portland, OR 16540', NULL, 450000.00, 'property-06.jpg', 'Modern Condo', 3, 2, 165.00, '26th', '3 cars', '22 New Street', 'Portland', 'OR 16540', '2025-05-04 03:55:28');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `pouzivatelia`
--

CREATE TABLE `pouzivatelia` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','agent') DEFAULT 'agent',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `pouzivatelia`
--

INSERT INTO `pouzivatelia` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2025-04-09 09:11:18');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `qna`
--

CREATE TABLE `qna` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `question` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('new','answered') DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `nehnutelnosti`
--
ALTER TABLE `nehnutelnosti`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `pouzivatelia`
--
ALTER TABLE `pouzivatelia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexy pre tabuľku `qna`
--
ALTER TABLE `qna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `nehnutelnosti`
--
ALTER TABLE `nehnutelnosti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pre tabuľku `pouzivatelia`
--
ALTER TABLE `pouzivatelia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pre tabuľku `qna`
--
ALTER TABLE `qna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
