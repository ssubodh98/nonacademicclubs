-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2017 at 07:55 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nss`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `sno` int(11) NOT NULL,
  `regno` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `clubid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`sno`, `regno`, `date`, `clubid`) VALUES
(1, 'ur14cs278', '2017-03-17', 0),
(2, 'ur14cs243', '2017-03-17', 0),
(3, 'ur14cs277', '2017-03-17', 0),
(4, 'ur14cs301', '2017-03-17', 0),
(5, 'ur14cs280', '2017-03-17', 0),
(6, 'ur14cs270', '2017-03-17', 0),
(7, 'ur14cs280', '2017-03-18', 0),
(8, 'ur14cs270', '2017-03-18', 0),
(29, '103', '2017-03-20', 0),
(30, '109', '2017-03-20', 0),
(31, '110', '2017-03-20', 0),
(32, '111', '2017-03-20', 0),
(33, '100', '2017-03-20', 0),
(34, '100', '0000-00-00', 0),
(35, '100', '2017-03-18', 0),
(36, '102', '2017-03-18', 101);

-- --------------------------------------------------------

--
-- Table structure for table `clubdetails`
--

CREATE TABLE `clubdetails` (
  `clubid` varchar(50) NOT NULL,
  `clubname` varchar(100) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `coordinator` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clubdetails`
--

INSERT INTO `clubdetails` (`clubid`, `clubname`, `description`, `coordinator`) VALUES
('101', 'Software and Networking Club', 'This club belongs to sssssubodh.', 'Mr. S Kumar'),
('102', ' Nature Club', ' Nature Club', 'Mr. S Kumar'),
('103', ' Networking Club', ' NetworkingClub', 'Mr. S Kumar'),
('104', 'Software Club', 'Software Club', 'Mr. X'),
('105', 'Singing Club', 'Singing Club', 'Mr S Subodh'),
('107', 'Jedidiya Club', 'The most famous club', 'Mr Jedi'),
('108', '255', '5115', '5115'),
('109', '151', '55', '545'),
('110', '222222', '155444', '44544'),
('111', '554', '4444', '544'),
('112', '55445', '545', 'Software and Networking Club'),
('113', 'aaa', 'aaa', 'Mr. Ashish Kumar');

-- --------------------------------------------------------

--
-- Table structure for table `coordinatordetails`
--

CREATE TABLE `coordinatordetails` (
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `clubid` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coordinatordetails`
--

INSERT INTO `coordinatordetails` (`firstname`, `middlename`, `lastname`, `username`, `clubid`, `email`, `phone`) VALUES
('Jedi', 'A', 'Singh', 'jedi', '101', 's@gmail.com', 9999999),
('Jedidiya', 'Jedi', 'Singh', 'jedidiya', '100', 's@gmail.com', 9999999),
('Chu', 'Yash', 'Jaiswal', 'sadas', '102', 'y@yy.com', 7),
('S', 'KUMAR', 'SUBODH', 'ssubodh', '103', 's.subodh98@gmail.com', 2147483647);

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE `dates` (
  `sno` int(10) NOT NULL,
  `date` date NOT NULL,
  `valid` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dates`
--

INSERT INTO `dates` (`sno`, `date`, `valid`) VALUES
(1, '2017-03-20', 1),
(2, '2017-03-21', 0),
(3, '2017-03-17', 1),
(4, '2017-03-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `regno` varchar(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` int(10) NOT NULL,
  `bloodgroup` varchar(10) NOT NULL,
  `program` varchar(50) NOT NULL,
  `year` int(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `semester` int(50) NOT NULL,
  `clubid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`regno`, `firstname`, `middlename`, `lastname`, `dob`, `gender`, `email`, `phone`, `bloodgroup`, `program`, `year`, `department`, `semester`, `clubid`) VALUES
('100', 'Shibu', 's', 'shh', '2017-02-08', 'M', 'sss@gmail.com', 99999999, 'B', 'B', 2017, 'CSE', 3, '101'),
('101', 'subodh', 's', 'shh', '2017-02-08', 'M', 'sss@gmail.com', 99999999, 'B', 'B', 2017, 'CSE', 3, '102'),
('102', 'sub', 's', 'shh', '2017-02-08', 'M', 'sss@gmail.com', 99999999, 'B', 'B', 2017, 'CSE', 3, '101'),
('103', 'Ashosh', 's', 'shh', '2017-02-08', 'M', 'sss@gmail.com', 99999999, 'B', 'B', 2017, 'CSE', 3, '101'),
('104', 'asdas', 's', 'shh', '2017-02-08', 'M', 'sss@gmail.com', 99999999, 'B', 'B', 2017, 'CSE', 3, '101'),
('105', 'kakashi', 's', 'shh', '2017-02-08', 'M', 'sss@gmail.com', 99999999, 'B', 'B', 2017, 'CSE', 3, '102'),
('106', 'karthik', 's', 'shh', '2017-02-08', 'M', 'sss@gmail.com', 99999999, 'B', 'B', 2017, 'CSE', 3, '101'),
('107', 'amal', 's', 'shh', '2017-02-08', 'M', 'sss@gmail.com', 99999999, 'B', 'B', 2017, 'CSE', 3, '101'),
('108', 'yash', 's', 'shh', '2017-02-08', 'M', 'sss@gmail.com', 99999999, 'B', 'B', 2017, 'CSE', 3, '101'),
('109', 'suraj', 's', 'shh', '2017-02-08', 'M', 'sss@gmail.com', 99999999, 'B', 'B', 2017, 'CSE', 3, '101'),
('110', 'noel', 's', 'shh', '2017-02-08', 'M', 'sss@gmail.com', 99999999, 'B', 'B', 2017, 'CSE', 3, '101'),
('111', 'allen', 's', 'shh', '2017-02-08', 'M', 'sss@gmail.com', 99999999, 'B', 'B', 2017, 'CSE', 3, '101');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `clubdetails`
--
ALTER TABLE `clubdetails`
  ADD PRIMARY KEY (`clubid`);

--
-- Indexes for table `coordinatordetails`
--
ALTER TABLE `coordinatordetails`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `dates`
--
ALTER TABLE `dates`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD PRIMARY KEY (`regno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `dates`
--
ALTER TABLE `dates`
  MODIFY `sno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
