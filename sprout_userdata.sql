-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2021 at 06:55 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sprout_userdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `username_admin` varchar(30) NOT NULL,
  `password_admin` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `developer`
--

CREATE TABLE `developer` (
  `developer_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `developer_name` varchar(256) NOT NULL,
  `developer_email` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `developer`
--

INSERT INTO `developer` (`developer_id`, `id_user`, `developer_name`, `developer_email`) VALUES
(1, 1, 'Adit Bekasi', 'adit@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `dev_request`
--

CREATE TABLE `dev_request` (
  `id_req` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dev_request`
--

INSERT INTO `dev_request` (`id_req`, `id_user`, `name`, `email`, `status`) VALUES
(1, 1, 'Adit Bekasi', 'adit@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `game_id` int(255) NOT NULL,
  `developer_id` int(100) NOT NULL,
  `gameName` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(3000) NOT NULL,
  `image` varchar(256) DEFAULT NULL,
  `is_publish` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`game_id`, `developer_id`, `gameName`, `price`, `description`, `image`, `is_publish`) VALUES
(1, 1, 'Game 1 Adit', 200000, 'Game 1 Adit', 'icon4.png', 1),
(2, 1, 'Game 2 Adit', 400000, 'Game 2 Adit', 'carbon_(2).png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaksi_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `date` varchar(256) NOT NULL,
  `time` varchar(256) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaksi_id`, `game_id`, `id_user`, `email`, `date`, `time`) VALUES
(1, 1, 2, 'hadi@gmail.com', '29 May 2021', '22:19:47'),
(2, 2, 2, 'hadi@gmail.com', '29 May 2021', '22:19:50'),
(3, 2, 2, 'hadi@gmail.com', '29 May 2021', '22:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Adit Bekasi', 'adit@gmail.com', 'default.jpg', '$2y$10$Tb4/allMh/.hfdXMvgxi5ekRmMxFTmhr3QSISBok6Z8h/hpdcM21W', 2, 1, '00:00:00'),
(2, 'hadi', 'hadi@gmail.com', 'default.jpg', '$2y$10$iYGTMD9jXzjbiIYvHA.oAuuY2DofTI9VQRtJao8.hV2MCaUat6dXO', 1, 1, '00:00:00'),
(3, 'raihan', 'raihan@gmail.com', 'default.jpg', '$2y$10$ZlRnGERJ1tO9gSDi3s/O5.CPqBjtipABlACSX.ZCHIaxB002gaw5.', 1, 1, '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `usergame`
--

CREATE TABLE `usergame` (
  `id_transaksi` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `day` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `developer`
--
ALTER TABLE `developer`
  ADD PRIMARY KEY (`developer_id`);

--
-- Indexes for table `dev_request`
--
ALTER TABLE `dev_request`
  ADD PRIMARY KEY (`id_req`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `developer_id` (`developer_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `usergame`
--
ALTER TABLE `usergame`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `developer`
--
ALTER TABLE `developer`
  MODIFY `developer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dev_request`
--
ALTER TABLE `dev_request`
  MODIFY `id_req` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `game`
--
ALTER TABLE `game`
  MODIFY `game_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usergame`
--
ALTER TABLE `usergame`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`developer_id`) REFERENCES `developer` (`developer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
