-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2020 at 02:17 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_oop_login_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `email` varchar(70) NOT NULL,
  `contact_number` varchar(70) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(256) NOT NULL,
  `access_level` varchar(16) NOT NULL,
  `access_code` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0=pending, 1=confirmed',
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='admin and customer users';

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `firstname`, `lastname`, `email`, `contact_number`, `address`, `password`, `access_level`, `access_code`, `status`, `created`, `modified`) VALUES
(1, 'Mike', 'Dalisay', 'mike@example.com', '0999999999', 'Blk. 24 A, Lot 6, Ph. 3, Peace Village', '$2y$10$Lefu1jWJMfCYeeSmotUVS.fqMXBO5DptQfCT1Psc9S0mJ8tP0ddIq', 'Admin', '', 1, '0000-00-00 00:00:00', '2020-02-09 13:13:59'),
(2, 'Lauro', 'Abogne', 'lauro@eacomm.com', '08888888', 'Pasig City', '$2y$10$Lefu1jWJMfCYeeSmotUVS.fqMXBO5DptQfCT1Psc9S0mJ8tP0ddIq', 'Customer', '', 1, '0000-00-00 00:00:00', '2020-02-09 13:13:59'),
(4, 'Darwin', 'Dalisay', 'darwin@example.com', '9331868359', 'Blk 24 A Lot 6 Ph 3\r\nPeace Village, San Luis', '$2y$10$tLq9lTKDUt7EyTFhxL0QHuen/BgO9YQzFYTUyH50kJXLJ.ISO3HAO', 'Customer', 'ILXFBdMAbHVrJswNDnm231cziO8FZomn', 1, '2014-10-29 17:31:09', '2016-06-13 06:18:25'),
(7, 'Marisol Jane', 'Dalisay', 'mariz@gmail.com', '09998765432', 'Blk. 24 A, Lot 6, Ph. 3, Peace Village', '$2y$10$Lefu1jWJMfCYeeSmotUVS.fqMXBO5DptQfCT1Psc9S0mJ8tP0ddIq', 'Customer', '', 1, '2015-02-25 09:35:52', '2020-02-09 13:13:59'),
(9, 'Marykris', 'De Leon', 'marykrisdarell.deleon@gmail.com', '09194444444', 'Project 4, QC', '$2y$10$Lefu1jWJMfCYeeSmotUVS.fqMXBO5DptQfCT1Psc9S0mJ8tP0ddIq', 'Customer', '', 1, '2015-02-27 14:28:46', '2020-02-09 13:13:59'),
(10, 'Merlin', 'Duckerberg', 'merlin@gmail.com', '09991112333', 'Project 2, Quezon City', '$2y$10$Lefu1jWJMfCYeeSmotUVS.fqMXBO5DptQfCT1Psc9S0mJ8tP0ddIq', 'Admin', '', 1, '2015-03-18 06:45:28', '2020-02-09 13:13:59'),
(14, 'Charlon', 'Ignacio', 'charlon@gmail.com', '09876543345', 'Tandang Sora, QC', '$2y$10$Lefu1jWJMfCYeeSmotUVS.fqMXBO5DptQfCT1Psc9S0mJ8tP0ddIq', 'Customer', '', 1, '2015-03-24 08:06:57', '2020-02-09 13:13:59'),
(15, 'Kobe Bro', 'Bryant', 'kobe@gmail.com', '09898787674', 'Los Angeles, California', '$2y$10$Lefu1jWJMfCYeeSmotUVS.fqMXBO5DptQfCT1Psc9S0mJ8tP0ddIq', 'Customer', '', 1, '2015-03-26 11:28:01', '2020-02-09 13:13:59'),
(20, 'Tim', 'Duncan', 'tim@example.com', '9999999', 'San Antonio, Texas, USA', '$2y$10$9OSKHLhiDdBkJTmd3VLnQeNPCtyH1IvZmcHrz4khBMHdxc8PLX5G6', 'Customer', '0X4JwsRmdif8UyyIHSOUjhZz9tva3Czj', 1, '2016-05-26 01:25:59', '2016-05-25 05:25:59'),
(21, 'Tony', 'Parker', 'tony@example.com', '8888888', 'Blk 24 A Lot 6 Ph 3\r\nPeace Village, San Luis', '$2y$10$lBJfvLyl/X5PieaztTYADOxOQeZJCqETayF.O9ld17z3hcKSJwZae', 'Customer', 'THM3xkZzXeza5ISoTyPKl6oLpVa88tYl', 1, '2016-05-26 01:29:01', '2016-06-13 05:46:33'),
(43, 'federico', 'flores', 'federicokakilalaflores@gmail.com', '09976540115', 'zone 3 ilaya st. malaban binan laguna', '$2y$10$oeNlXR71qlg8GOfYh5se7OJlxl13vNcwhkwtuLLt.fpnkNL7KSS/y', 'Customer', '9xzeOUe0lM8ZmIbmyl7VI2NAvOiYqriT', 1, '2020-01-22 22:40:26', '2020-02-09 13:14:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
