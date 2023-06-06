-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2023 at 09:30 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `hist_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `weight_kg` double NOT NULL,
  `rov_id` int(11) NOT NULL,
  `date_visited` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`hist_id`, `pet_id`, `weight_kg`, `rov_id`, `date_visited`) VALUES
(1, 1, 5.2, 3, '2023-05-28'),
(2, 2, 1.5, 2, '2023-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `pet_info`
--

CREATE TABLE `pet_info` (
  `pet_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `pet_name` varchar(50) NOT NULL,
  `owner_name` varchar(60) NOT NULL,
  `img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet_info`
--

INSERT INTO `pet_info` (`pet_id`, `s_id`, `pet_name`, `owner_name`, `img`) VALUES
(1, 2, 'Browny', 'Kurt', '6471f6df8c862.jpg'),
(2, 3, 'Kurt', 'Brandy', '647200b443aa4.jpg'),
(3, 1, 'qwerwerqwer', 'xcvbxcvbxcvb', '64721c17e3eee.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reason_of_visit`
--

CREATE TABLE `reason_of_visit` (
  `rov_id` int(11) NOT NULL,
  `reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reason_of_visit`
--

INSERT INTO `reason_of_visit` (`rov_id`, `reason`) VALUES
(1, 'Emergency'),
(2, 'Check-up'),
(3, 'Vaccine');

-- --------------------------------------------------------

--
-- Table structure for table `species`
--

CREATE TABLE `species` (
  `s_id` int(11) NOT NULL,
  `species_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `species`
--

INSERT INTO `species` (`s_id`, `species_name`) VALUES
(1, 'Cat'),
(2, 'Dog'),
(3, 'Bird');

-- --------------------------------------------------------

--
-- Table structure for table `vaccine`
--

CREATE TABLE `vaccine` (
  `vac_id` int(11) NOT NULL,
  `vaccine_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccine`
--

INSERT INTO `vaccine` (`vac_id`, `vaccine_name`) VALUES
(1, 'Rabies'),
(2, 'Combination Vaccine'),
(3, 'Feline Leukemia (FeLV)'),
(4, 'Polyomavirus vaccine'),
(5, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines_administered`
--

CREATE TABLE `vaccines_administered` (
  `vad_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `vaccine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccines_administered`
--

INSERT INTO `vaccines_administered` (`vad_id`, `pet_id`, `vaccine_id`) VALUES
(1, 1, 4),
(2, 2, 2),
(3, 3, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`hist_id`);

--
-- Indexes for table `pet_info`
--
ALTER TABLE `pet_info`
  ADD PRIMARY KEY (`pet_id`);

--
-- Indexes for table `reason_of_visit`
--
ALTER TABLE `reason_of_visit`
  ADD PRIMARY KEY (`rov_id`);

--
-- Indexes for table `species`
--
ALTER TABLE `species`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `vaccine`
--
ALTER TABLE `vaccine`
  ADD PRIMARY KEY (`vac_id`);

--
-- Indexes for table `vaccines_administered`
--
ALTER TABLE `vaccines_administered`
  ADD PRIMARY KEY (`vad_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `hist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pet_info`
--
ALTER TABLE `pet_info`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reason_of_visit`
--
ALTER TABLE `reason_of_visit`
  MODIFY `rov_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `species`
--
ALTER TABLE `species`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vaccine`
--
ALTER TABLE `vaccine`
  MODIFY `vac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vaccines_administered`
--
ALTER TABLE `vaccines_administered`
  MODIFY `vad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
