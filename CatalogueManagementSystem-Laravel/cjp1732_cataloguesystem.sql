-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2020 at 08:09 PM
-- Server version: 5.7.32
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cjp1732_cataloguesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact-form`
--

CREATE TABLE `contact-form` (
  `Id` int(11) NOT NULL,
  `CourseId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Term` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `Id` int(11) NOT NULL,
  `DepartmentId` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`Id`, `DepartmentId`, `Name`, `Type`) VALUES
(1, 1, 'Web Data Management', 'upcoming'),
(2, 1, 'Data Mining', 'upcoming'),
(3, 1, 'Artificial Intelligence', 'planned');

-- --------------------------------------------------------

--
-- Table structure for table `course-term`
--

CREATE TABLE `course-term` (
  `Id` int(11) NOT NULL,
  `CourseId` int(11) NOT NULL,
  `ProfessorName` varchar(255) NOT NULL,
  `Term` varchar(255) NOT NULL,
  `Class` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course-term`
--

INSERT INTO `course-term` (`Id`, `CourseId`, `ProfessorName`, `Term`, `Class`) VALUES
(4, 1, 'John A', 'Spring 21', '01'),
(5, 2, 'John B', 'Spring 21', '02');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`Id`, `Name`) VALUES
(1, 'Computer Science'),
(2, 'Civil Engineering'),
(3, 'Chemical Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Course-TermId` int(11) NOT NULL,
  `Feedback` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Id`, `UserId`, `Course-TermId`, `Feedback`) VALUES
(1, 3, 4, 'asdasdas\r\n\r\nds\r\nd');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`Id`, `Name`) VALUES
(1, 'Student'),
(2, 'Staff'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `student-enrollment`
--

CREATE TABLE `student-enrollment` (
  `Id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Course-TermId` int(11) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student-enrollment`
--

INSERT INTO `student-enrollment` (`Id`, `UserId`, `Course-TermId`, `Status`) VALUES
(9, 3, 4, 'enrolled'),
(10, 3, 5, 'enrolled');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `RoleId` int(11) NOT NULL,
  `DepartmentId` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `RoleId`, `DepartmentId`, `Name`, `Email`, `Password`) VALUES
(3, 1, 1, 'trial3', 'trial3@trial3.trial3', 'trial3123'),
(5, 2, 2, 'trial5', 'trial5@trial5.trial5', 'trial5123'),
(6, 2, 1, 'john staff', 'johnstaff@johnstaff.johnstaff', 'johnstaff'),
(7, 3, 1, 'john admin', 'johnadmin@johnadmin.johnadmin', 'johnadmin'),
(8, 1, 1, 'john student', 'johnstudent@johnstudent.johnstudent', 'johnstudent'),
(9, 1, 2, 'john student2', 'johnstudent2@johnstudent2.johnstudent2', 'johnstudent2'),
(10, 1, 3, 'john admin2', 'johnadmin2@johnadmin2.johnadmin2', 'johnadmin2'),
(11, 2, 2, 'john staff2', 'johnstaff2@johnstaff2.johnstaff2', 'johnstaff2'),
(12, 1, 3, 'john student3', 'johnstudent3@johnstudent3.johnstudent3', 'johnstudent3'),
(13, 3, 3, 'john admin3', 'johnadmin3@johnadmin3.johnadmin3', 'johnadmin3'),
(14, 1, 1, 'trial1', 'trial1@trial1.trial1', 'trial123'),
(15, 3, 2, 'trial2', 'trial2@trial2.trial2', 'trial234'),
(16, 1, 1, 'test', 'igmitesting@gmail.com', 'test1234'),
(18, 2, 3, 'john staff3', 'johnstaff3@johnstaff3.johnstaff3', 'johnstaff3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact-form`
--
ALTER TABLE `contact-form`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `course-term`
--
ALTER TABLE `course-term`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `student-enrollment`
--
ALTER TABLE `student-enrollment`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact-form`
--
ALTER TABLE `contact-form`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course-term`
--
ALTER TABLE `course-term`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student-enrollment`
--
ALTER TABLE `student-enrollment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
