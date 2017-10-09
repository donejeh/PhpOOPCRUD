-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2016 at 01:50 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeid` varchar(6) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `oname` varchar(30) NOT NULL,
  `title` enum('Mr.','Mrs.','Mallam','Mallama','Chief','Dr.','Prof.','Hon.') NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `marital_status` enum('married','single','divorced','widowed') NOT NULL DEFAULT 'single',
  `dob` date NOT NULL,
  `stateid` int(11) NOT NULL,
  `rankid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeid`, `fname`, `lname`, `oname`, `title`, `gender`, `marital_status`, `dob`, `stateid`, `rankid`) VALUES
('p12320', 'cosc405', 'Lats', 'User', 'Mallam', 'female', 'divorced', '2000-02-02', 2, 9),
('p12324', 'Ada', 'Ejembi', 'oguche', 'Mr.', 'male', 'married', '1963-04-05', 11, 5),
('p12333', 'Benjamin ', 'Jeremiah', 'Attah', 'Mr.', 'male', 'married', '1977-02-12', 7, 10),
('p12348', 'Samuel ', 'Ade', 'King', 'Mr.', 'male', 'single', '1974-04-12', 27, 1),
('p12420', 'lizzy', 'matter', 'oguche', 'Mallama', 'female', 'widowed', '2016-01-02', 37, 6),
('p12423', 'Alu', 'Terungwa', 'Stanley', 'Mr.', 'male', 'single', '2016-02-02', 7, 1),
('p17928', 'ENALGEWU', 'INNOCENT', 'EJEH', 'Mr.', 'female', 'single', '1992-10-16', 7, 2),
('p23145', 'Yaro', 'S.A', 'Dolo', 'Mallam', 'male', 'single', '1992-02-10', 10, 1),
('p23413', 'Funmilayo', 'Ayomi', 'Bosede', 'Mrs.', 'female', 'married', '1986-08-12', 29, 8),
('p23423', 'Grace ', 'Bako', 'Adamu', 'Mrs.', 'female', 'single', '1990-01-10', 18, 2),
('p24573', 'Amina', 'Bako', 'Shehu', 'Mrs.', 'male', 'divorced', '1956-04-10', 4, 1),
('p75229', 'Don', 'ejeh', 'e', 'Mallam', 'male', 'divorced', '2005-05-12', 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `rankid` int(11) NOT NULL,
  `rankname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`rankid`, `rankname`) VALUES
(10, 'Assistant Lecturer'),
(11, 'Chancellor'),
(3, 'Chief assistant professor'),
(13, 'Deans of Faculties'),
(8, 'Examination Officer'),
(1, 'Graduate Assistant'),
(5, 'Graduate Coordinators'),
(6, 'Heads of departments'),
(4, 'Professor'),
(2, 'Programmer I'),
(12, 'Registrar'),
(7, 'Registration Officer'),
(9, 'Vice-rector');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `stateid` int(11) NOT NULL DEFAULT '0',
  `statename` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateid`, `statename`) VALUES
(1, 'Abia'),
(2, 'Adamawa'),
(3, 'Akwa Ibom'),
(4, 'Anambra'),
(5, 'Bauchi'),
(6, 'Bayelsa'),
(7, 'Benue'),
(8, 'Borno'),
(9, 'Cross River'),
(10, 'Delta'),
(11, 'Ebonyi'),
(12, 'Edo'),
(13, 'Ekiti'),
(14, 'Enugu'),
(15, 'Gombe'),
(16, 'Imo'),
(17, 'Jigawa'),
(18, 'Kaduna'),
(19, 'Kano'),
(20, 'Katsina'),
(21, 'Kebbi'),
(22, 'Kogi'),
(23, 'Kwara'),
(24, 'Lagos'),
(25, 'Nasarawa'),
(26, 'Niger'),
(27, 'Ogun'),
(28, 'Ondo'),
(29, 'Osun'),
(30, 'Oyo'),
(31, 'Plateau'),
(32, 'Rivers'),
(33, 'Sokoto'),
(34, 'Taraba'),
(35, 'Yobe'),
(36, 'Zamfara'),
(37, 'FCT'),
(38, 'Non-Nigerian');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeid`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`rankid`),
  ADD UNIQUE KEY `rankname` (`rankname`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`stateid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `rankid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
